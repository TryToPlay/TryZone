<?php
    include("utils\\functions.php");
    $user_data = getCurrentUserData();
?>

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

<style>

    #container
    {
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