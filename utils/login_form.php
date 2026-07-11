<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

    <label for="name"><b>Name:</b></label>
    <input type="text" required name="name" id="name" placeholder="user1234" minlength="3" maxlength="20"> <br>

    <label for="password"><b>Password:</b></label>
    <input type="password" required name="password" id="password" minlength="8" maxlength="8"> <br>
        
    <br>
    <button type="submit" name="login">Log in</button>
</form>

<style>
    label{
        cursor: pointer;
    }
    button:hover{
        cursor: pointer;
    }
</style>