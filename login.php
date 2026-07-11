<?php
    include("utils\\database.php");
    include("utils\\header.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TryZone</title>
</head>
<body>
    <h1>Welcome to TryZone</h1>

    <p>Log in to your account</p>

        <?php include("utils\\login_form.php") ?>

    <p>Don't have an account? <a href="index.php">sign up</a></p>
</body>
</html>

<?php
    $table = "user_accounts";
    include("utils\\functions.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        login($connection, $table, $name, $password);
    }

    mysqli_close($connection);

    include("utils\\footer.html");
?>