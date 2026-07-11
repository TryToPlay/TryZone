<?php
    include("utils\\navigation_bar.html");
    include("utils\\database.php");
    include("utils\\functions.php");
    $table = "user_accounts";

    $userID = getCurrentUserID();
    $select_query = "SELECT id FROM {$table}
                    WHERE id != {$userID}";

    $users = handleMySql($connection, $select_query, true);
    $users_data = array();
    while ($user = mysqli_fetch_assoc($users)) {
        array_push($users_data,
                    getUserDataByID($connection, $table, $user["id"]));
    }

    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TryZone</title>
</head>
<body>
    <?php displayUserProfiles($users_data); ?>
</body>
</html>

<?php
    include("utils\\footer.html");
?>