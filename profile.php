<?php
    include("utils\\navigation_bar.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TryZone</title>
</head>
<body>
    <?php include("utils\\your_profile.php") ?>

    <br><br>

    <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <button type="submit" name="edit">Edit</button>

        <button type="submit" name="delete"
        onclick="return confirm('Are you sure you want to permanently delete your account?')">
            Delete
        </button>

        <button type="submit" name="logout"
        onclick="return confirm('Are you sure you want to log out of your account?')">
            Log out
        </button>
    </form>
</body>
</html>

<style>
    button:hover{
        cursor: pointer;
    }
</style>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["edit"])) {
            header("Location: edit_profile.php");
        }

        elseif (isset($_POST["delete"])) {
            deleteUser();
        }

        elseif (isset($_POST["logout"])) {
            deleteAllCookies();
            header("Location: index.php");
        }
    }

    include("utils\\footer.html");
?>