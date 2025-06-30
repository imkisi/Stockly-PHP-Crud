<?php 
if(isset($_GET['message'])){
    if($_GET['message'] == "failed"){
        echo '<script type = "text/JavaScript">';
        echo 'alert("Incorrect username or password")';
        echo '</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/image/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css" integrity="sha384-NvKbDTEnL+A8F/AA5Tc5kmMLSJHUO868P+lDtTpJIeQdGYaUIuLr4lVGOEA1OcMy" crossorigin="anonymous">
    <title>Stockly - Login</title>
    
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
            font: 400 14px "Poppins";
        }
        body {
            height: 100svh;
            width: 100svw;
            background-color: #ffffff;
            overflow-x: hidden;
            background: linear-gradient(180deg, #ebe6e8 0%, #d8e0f4 100%);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        h3 {
            font: 400 36px "Poppins";
            color: #16171a;
            padding: 16px 0;
        }
        p {
            text-align: center;
        }
        .logo {
            width: 110.68px;
            height: 31px;
            margin-top: 30px;
        }
        .form {
            padding: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        form {
            padding-top: 48px;
        }
        .form input {
            width: 100%;
            max-width: 393px;
            border: none;
            width: auto;
        }
        .inputBx {
            width: 100%;
            padding: 14px 24px;
            margin: 4px;
            background-color: #ffffff;
            border-radius: 36px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
            gap: 20px;
        }
        .inputBx img {
            width: 18px;
            height: 18px;
            filter: invert(81%) sepia(4%) saturate(915%) hue-rotate(173deg) brightness(76%) contrast(80%);
        }
        input:focus {
            border: none;
            outline: none;
        }
        button {
            width: 100%;
            height: 50px;
            margin-top: 24px;
            border-radius: 26px;
            background: #020202;
            background-blend-mode: normal;
            color: #ffffff;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: ease .3s;
        }
        button:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }
    
    </style>
</head>

<body>
    <div class="form">
        <img src="assets/stockly.png" alt="logo" class="logo">
        <h3>Welcome Back!</h3>
        <p>Enter your username and password to access your account</p>

        <form id="login" method="post" name="login" action="login.php" class="formContent">
            <div class="inputBx">
                <input type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="inputBx">
                <input type="password" name="password" id="password" maxlength="30" placeholder="Password">
                <img src="assets/ic-eyeslash.svg" alt="" srcset="">
            </div>
            <button type="submit" name="login" id="login" value="login">
                Login
            </button>
        </form>
    </div>
</body>
</html>

