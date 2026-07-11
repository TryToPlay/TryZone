<?php
    include("utils\\navigation_bar.html");
    include("utils\\functions.php");

    $user_data = array(
        "name" => unicodeToOutputString($_COOKIE["name"]),
        "pfp" => $_COOKIE["pfp"],
        "bio" => unicodeToOutputString($_COOKIE["bio"])
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TryZone</title>
</head>
<body>
    <div id="container">
        <div id="pfp">
        <img alt="profile picture" src="assets\profile-pictures\<?php echo $user_data["pfp"] ?>">
        </div>

        <div id="name">
        <h2><?php echo $user_data["name"] ?></h2>
        </div>

        <div id="bio">
        <p><?php echo $user_data["bio"] ?></p>
        </div>
    </div>
</body>
</html>

<style>
    #container{
        width: 100%;
        height: 256px;
        display: inline-block;
        overflow: auto;
        text-align: right;
    }

    #pfp{
        float: left;
    }

    #pfp img{
        height: 256px;
        width: 256px;
    }

    #name{
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 56px;
    }

    #bio{
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
    }
</style>

<?php
    include("utils\\footer.html");
?>