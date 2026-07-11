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

    <p>Sign up for an account</p>

        <?php include("utils\\signup_form.php") ?>

    <p>Already have an account? <a href="login.php">log in</a></p>
</body>
</html>

<?php
    $table = "user_accounts";
    include("utils\\functions.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);

        signUp($connection, $table, $name, $password, $email);
    }

    mysqli_close($connection);

    include("utils\\footer.html");
?>