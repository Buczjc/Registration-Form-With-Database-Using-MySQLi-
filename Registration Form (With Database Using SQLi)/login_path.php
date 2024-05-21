<?php
session_start();
include("reg_database.php");
$showPopup = false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_user = filter_input(INPUT_POST, "user_login", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $login_pass = filter_input(INPUT_POST, "pass_login", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Fetch the user record based on the entered username
    $getInfoFromTable = "SELECT * FROM users WHERE username='$login_user'";
    $result = mysqli_query($connection, $getInfoFromTable);
    

    if (mysqli_num_rows($result) > 0) {
        // Fetch the associative array
        $row = mysqli_fetch_assoc($result);
        $hashed_password_from_db = $row['password'];
    
        // Verify the entered password against the hashed password
        if (password_verify($login_pass, $hashed_password_from_db)) {
            $_SESSION['username'] = $login_user;
                header("Location: logged.php");
                die();
        } else {
            echo "<p class='message'>WRONG PASSWORD ! !</p>";
        }
    } else {
        $showPopup = true;
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
        margin: auto;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        overflow: auto;
        background: linear-gradient(315deg, rgba(101,0,94,1) 3%, rgba(60,132,206,1) 38%, rgba(48,238,226,1) 68%, rgba(255,25,25,1) 98%);
        animation: gradient 15s ease infinite;
        background-size: 400% 400%;
        background-attachment: fixed;
    }

    .container {
        background-color: rgba(24,24,24,255);
        width: 400px;
        height: 340px;
        border-radius: 6px;
    }

    .container h2 {
        text-align: center;
        color: white;
        position: relative;
        top: 9px;
    }

    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        top: 20px;
    }

    .form input[type="text"], .form input[type="password"]{
        width: 200px;
        height: 25px;
        background-color: rgba(27,31,34,255);
        color: white;
        padding-left: 8px;
        border-color: #00ACEE;
        border-radius: 15px;
        box-shadow: none;
    }

    .form input[type="submit"] {
        line-height: 1;
        text-decoration: none;
        color: #333333;
        font-size: 12px;
        border-radius: 0px;
        width: 70px;
        height: 30px;
        font-weight: bold;
        border: 2px solid #333333;
        transition: 0.3s;
        box-shadow: 3px 3px 0px 0px rgba(51, 51, 51, 1);
        background-color: #ffffff;
    }

    .form input[type="submit"]:hover {
        box-shadow: 0 0 #333;
        color: #fff;
        background-color: #333;
    }

    .link-register-path {
        display: flex;
        justify-content: center;
        position: relative;
        top: 40px;
    }

    .link-register-path a {
        font-size: smaller;
        color: #5C5C5A;
        text-decoration: none;
    }

    .form label {
        color: white;
        position: relative;
        top: 8px;
    }

    .message {
            color: red;
            margin-top:20px;
        }

        .popup .overlay {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        background:rgba(0,0,0,0.7);
        z-index:1;
        display: none;
    }

    .popup .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%) scale(0);
        background: #fff;
        width: 450px;
        height: 220px;
        z-index: 2;
        text-align: center;
        padding: 20px;
        box-sizing: border-box;
        display:flex;
        justify-content:center;
        flex-direction:column;
    }

    .popup .close-btn {
        cursor: pointer;
        position: absolute;
        right: 20px;
        top: 20px;
        width: 30px;
        height: 30px;
        background: #222;
        color: #fff;
        font-size: 25px;
        font-weight: 600;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
    }

    .popup.active .overlay {
        display: block;
    }

    .popup.active .content {
        transition: all 300ms ease-in-out;
        transform: translate(-50%,-50%) scale(1);
    }

    @keyframes gradient {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}

.wave {
    background: rgb(255 255 255 / 25%);
    border-radius: 1000% 1000% 0 0;
    position: fixed;
    width: 200%;
    height: 12em;
    animation: wave 10s -3s linear infinite;
    transform: translate3d(0, 0, 0);
    opacity: 0.8;
    bottom: 0;
    left: 0;
    z-index: -1;
}

.wave:nth-of-type(2) {
    bottom: -1.25em;
    animation: wave 18s linear reverse infinite;
    opacity: 0.8;
}

.wave:nth-of-type(3) {
    bottom: -2.5em;
    animation: wave 20s -1s reverse infinite;
    opacity: 0.9;
}

@keyframes wave {
    2% {
        transform: translateX(1);
    }

    25% {
        transform: translateX(-25%);
    }

    50% {
        transform: translateX(-50%);
    }

    75% {
        transform: translateX(-25%);
    }

    100% {
        transform: translateX(1);
    }
}
    </style>
    <script>
    function togglePopup() {
        const popup = document.getElementById("popup-1");
        popup.classList.toggle("active");
    }

    window.onload = function() {
            <?php if ($showPopup) : ?>
                togglePopup();
            <?php endif; ?>
        };
</script>
</head>
<body>

    <div class="container">
    <h2>Login!</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <div class="form">
    <label for="user">Enter a Username</label><br>
    <input type="text" name="user_login" id="user" >
    <br>
    <label for="pass">Enter a Password</label><br>
    <input type="password" name="pass_login" id="pass">
    <br>
    <input type="submit" value="Submit">
    </form>
        </div>
    <div class="link-register-path">
        <a href="register_path.php">Sign up!</a>
    </div>
    </div>

    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
     </div>

          <!--Pop-up message for the input validation (missing username and password)-->
          <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>NO USER EXISTED</h1>
            <p>Please check if you have created an account.</p>
        </div>
     </div>
</body>
</html>

