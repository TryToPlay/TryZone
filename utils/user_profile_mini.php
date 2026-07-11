<div id="container" onclick='loadProfile(
    `<?php /** @disregard */ echo $user_data["name"] ?>`,
    `<?php /** @disregard */ echo $user_data["pfp"] ?>`,
    `<?php /** @disregard */ echo $user_data["bio"] ?>`
)'>
    <div id="pfp">
    <img alt="profile picture" src="assets\profile-pictures\<?php /** @disregard */ echo $user_data["pfp"] ?>">
    </div>

    <div id="name">
    <h2><?php /** @disregard */ echo $user_data["name"] ?></h2>
    </div>
</div>

<style>

    #container
    {
        width: 100%;
        height: 128px;
        display: inline-block;
        overflow: auto;
        text-align: right;
    }

    #container:hover{
        background-color: lightgray;
        cursor: pointer;
    }

    #pfp{
        float: left;
    }

    #pfp img{
        height: 128px;
        width: 128px;
    }

    #name{
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 128px;
    }
</style>

<script>
    function loadProfile(name_value, pfp_value, bio_value) {
        let user_data = {
            name: name_value,
            pfp: pfp_value,
            bio: bio_value
        };

        var expires;
        var date = new Date();
        date.setTime(date.getTime() + (1 * 60 * 60 *1000));
        expires = "; expires=" + date.toString();

        document.cookie = escape("name") + "=" + escape(user_data["name"]) + expires + "; path=/";
        document.cookie = escape("pfp") + "=" + escape(user_data["pfp"]) + expires + "; path=/";
        document.cookie = escape("bio") + "=" + escape(user_data["bio"]) + expires + "; path=/";

        window.location.href = "user_profile.php";
    };
</script>