<?php
    include("utils\\functions.php");
    $user_data = getCurrentUserData();
?>

<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">

    <label for="name"><b>Name:</b></label>
    <input value="<?php echo $user_data["name"] ?>" type="text" name="name" id="name" minlength="3" maxlength="20"> <br>
    
    <label for="bio"><b>Bio:</b></label>
    <textarea name= "bio" id="bio" rows="5" cols="30"><?php echo strip_tags($user_data["bio"]) ?></textarea> <br>

    <br>
    <label id="pfp_btn" for="pfp">Upload Profile Picture</label>
    <br>
    <input name="pfp" id="pfp" type="file" accept="image/png, image/jpeg, image/webp"> <br>

    <div id="pfp_display">
    <img id="pfp_image" alt="profile picture" src="assets\profile-pictures\<?php echo $user_data["pfp"]?>">
    </div>

    <br>
    <button type="submit" name="save">Save</button>
    <button type="submit" name="cancel">Cancel</button>
</form>

<style>
    label{
        cursor: pointer;
    }

    #pfp_btn{
        border: 1px solid black;
        padding: 5px;
    }

    #pfp_btn:hover{
        background-color: lightgray;
    }

    #pfp{
        opacity: 0;
    }

    #pfp_display img{
        width: 128px;
        height: 128px;
    }

    button:hover{
        cursor: pointer;
    }
</style>

<script>
    let pfpFile = document.getElementById("pfp");
    pfpFile.addEventListener("change", function() {
        let pfpImage = document.getElementById("pfp_image");
        if (this.files.length > 0) {
            let filePath = URL.createObjectURL(this.files[0]);
            console.log(filePath);
            pfpImage.src = filePath;
        }
    });
</script>

<?php
    include("utils\\database.php");
    $table = "user_accounts";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["save"])) {
            $name = array(
                "old" => $user_data["name"]
            );

            $name["new"] = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
            $bio = htmlspecialchars($_POST["bio"]);
            $pfp = $_FILES["pfp"];

            updateProfile($connection, $table, $name, $bio, $pfp);
        }

        elseif (isset($_POST["cancel"])) {
            header("Location: profile.php");
        }
    }

    mysqli_close($connection);
?>