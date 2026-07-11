<?php
    function handleMySql(mysqli $connection, string $query, bool $return) {
        try {
            if ($return) {
                return mysqli_query($connection, $query);
            } else {
                mysqli_query($connection, $query);
            }
        } catch (mysqli_sql_exception) {
            echo "Problem in query:<br>";
            // echo $query . "<br>";
        }
    }

    function signUp(mysqli $connection, string $table,
                    string $name, string $password, string $email) {

        $isNewUser = isNewUser($connection, $table, $name, $email);

        if ($isNewUser) {
            addNewUser($connection, $table, $name, $password, $email);
            header("Location: login.php");
        }
    }

    function isNewUser(mysqli $connection, string $table, string $name, string $email) {
    
        $users = selectAllUsers($connection, $table);
        while ($user = mysqli_fetch_assoc($users)) {

            if ($user["email"] == $email) {
                echo "Email is already registered" . "<br>";
                echo "Log in to your account" . "<br>";
                return false;
            } elseif ($user["name"] == $name) {
                echo "Name is taken" . "<br>";
                return false;
            }
        }

        return true;
    }

    function selectAllUsers(mysqli $connection, string $table) {
        
        $select_query = "SELECT * FROM {$table}";
        $users = handleMySql($connection, $select_query, true);

        return $users;
    }

    function addNewUser(mysqli $connection, string $table,
                        string $name, string $password, string $email) {
        
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO {$table}
                        (name, password, email) VALUES 
                        ('$name', '$hash', '$email')";
                    
        handleMySql($connection, $insert_query, false);
    }

    function login(mysqli $connection, string $table,
                    string $name, string $password) {

        $isUserFound = isUserFound($connection, $table,
                                    $name, $password);

        if (! $isUserFound) {
            echo "Name not found" . "<br>";
            echo "Sign up for an account" . "<br>";
        }
    }

    function isUserFound(mysqli $connection, string $table,
                        string $name, string $password) {

        $select_query = "SELECT * FROM {$table}";
    
        $users = handleMySql($connection, $select_query, true);
    
        while ($user = mysqli_fetch_assoc($users)) {

            if ($user["name"] == $name) {
                verifyPassword($user, $password);
                return true;
            }
        }

        return false;
    }

    function verifyPassword(array $user, string $password) {

        if (password_verify($password, $user["password"])) {

            $sessionID = $user["reg_date"]. $user["name"] .(string) $user["id"];
            session_id($sessionID);

            session_start();
            $_SESSION["userID"] = $user["id"];
            setcookie("sessionID", session_id(), time() + 60 * 60 * 3, "/");
            session_write_close();

            header("Location: home.php");
        } else {
            echo "Incorrect password" . "<br>";
        }
    }

    function getCurrentUserData() {
        include("utils\\database.php");

        $table = "user_accounts";

        $userID = getCurrentUserID();
        $user_data = getUserDataByID($connection, $table, $userID);

        mysqli_close($connection);

        return $user_data;
    }

    function getCurrentUserID() {
        if (isset($_COOKIE["sessionID"])) {
            $sessionID = $_COOKIE["sessionID"];
        } else {
            header("Location: index.php");
            return;
        }
        session_id($sessionID);

        session_start();
        $userID = $_SESSION["userID"];
        session_write_close();

        return $userID;
    }

    function getUserDataByID(mysqli $connection, string $table, int $id) {

        $select_query = "SELECT * FROM {$table} WHERE id = {$id}";

        $users = handleMySql($connection, $select_query, true);
        $user = mysqli_fetch_assoc($users);

        $user_data = array(
            "name" => $user["name"],
            "bio" => nl2br($user["bio"]),
            "pfp" => $user["pfp"]
        );

        return $user_data;
    }

    function updateProfile(mysqli $connection, string $table,
                            array $name, string $bio, array $pfp) {

        $isNameTaken = false;
        if ($name["old"] != $name["new"]) {
            $isNameTaken = isNameTaken($connection, $table, $name["new"]);
        }

        if (!$isNameTaken) {
            if ($pfp["error"] == 0) {
                uploadPfp($connection, $table, $name, $pfp);
            }

            saveChanges($connection, $table, $name["new"], $bio);

            header("Location: profile.php");
        }
    }

    function isNameTaken(mysqli $connection, string $table, string $name) {

        $users = selectAllUsers($connection, $table);
        while ($user = mysqli_fetch_assoc($users)) {

            if ($user["name"] == $name) {
                echo "Name is taken" . "<br>";
                return True;
            }
        }

        return False;
    }

    function uploadPfp(mysqli $connection, string $table,
                        array $name, array $pfp) {
        
        deletePfp($connection, $table);

        $tempPath = $pfp["tmp_name"];
        $fileName = $name["new"] . "." . pathinfo($pfp["name"], PATHINFO_EXTENSION);
        $savePath = realpath(dirname(__FILE__, 2)) . "\\assets\\profile-pictures\\" . $fileName;

        move_uploaded_file($tempPath, $savePath);

        $userID = getCurrentUserID();
        $update_query = "UPDATE {$table} SET
                        pfp = '$fileName'
                        WHERE id = {$userID}";
                    
        handleMySql($connection, $update_query, false);
        
    }

    function saveChanges(mysqli $connection, string $table,
                        string $name, string $bio) {

        $userID = getCurrentUserID();

        $update_query = "UPDATE {$table} SET
                        name = '$name',
                        bio = '$bio'
                        WHERE id = {$userID}";
                    
        handleMySql($connection, $update_query, false);
    }

    function deletePfp(mysqli $connection, string $table) {

        $userID = getCurrentUserID();
        $select_query = "SELECT pfp FROM {$table}
                        WHERE id = {$userID}";
        
        $users = handleMySql($connection, $select_query, true);
        $user = mysqli_fetch_assoc($users);
        $fileName = $user["pfp"];
        if ($fileName != "default.png") {
            $deletePath = realpath(dirname(__FILE__, 2)) . "\\assets\\profile-pictures\\" . $fileName;
            unlink($deletePath);
        }
    }

    function deleteUser() {
        include("utils\\database.php");
        $table = "user_accounts";
        $userID = getCurrentUserID();

        deletePfp($connection, $table);

        $delete_query = "DELETE FROM {$table}
                        WHERE id = {$userID}";

        handleMySql($connection, $delete_query, false);
        mysqli_close($connection);

        deleteAllCookies();

        header("Location: index.php");
    }

    function deleteCookie(string $name, string $path) {
        if (isset($_COOKIE[$name])) {
            setcookie($name, "", time() - 60 * 60, $path);
            unset($_COOKIE[$name]);
            return true;
        }
        return false;
    }

    function deleteAllCookies() {
        deleteCookie("sessionID", "/");
        deleteCookie("PHPSESSID", "/");
        deleteCookie("name", "/");
        deleteCookie("pfp", "/");
        deleteCookie("bio", "/");
    }

    function displayUserProfiles(array $users_data) {
        foreach ($users_data as $user_data) {
            include("user_profile_mini.php");
            echo "<br><br>";
        }
    }

    function unicodeToOutputString(string $input) {
        $valid_unicode = str_replace("%u", "\u", $input);
        $output = transliterator_transliterate("Hex-Any/Java", $valid_unicode);

        return $output;
    }
?>