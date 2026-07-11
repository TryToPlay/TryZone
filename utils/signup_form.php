<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

    <label for="name"><b>Name:</b></label>
    <input type="text" required name="name" id="name" placeholder="user1234" minlength="3" maxlength="20"> <br>

    <label for="password"><b>Password:</b></label>
    <input type="password" required name="password" id="password" minlength="8" maxlength="8"> <br>

    <label for="email"><b>Email:</b></label>
    <input type="email" required name="email" id="email" placeholder="name@domain.com"> <br>
   
    <br>
    <button type="submit" name="signup">Sign up</button>
</form>

<style>
    label{
        cursor: pointer;
    }
    #button:hover{
        cursor: pointer;
    }
</style>