<?php 
session_start();
if (empty($_SESSION['username'])) {
    header("location:index.php");
}
include "config/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = trim($_POST['brand'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $color = trim($_POST['color'] ?? '');
    $price = intval($_POST['price'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);

    // Validate required fields
    if (
        $brand === '' ||
        $name === '' ||
        $color === '' ||
        $price <= 0 ||
        $stock < 0 ||
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] != 0
    ) {
        // Show error page below
    } else {
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            // Show error page below
        } else {
            // Handle file upload
            $targetDir = "assets/image/";
            $image = basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $image;
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                // Show error page below
            } else {
                // Insert into database
                $sql = "INSERT INTO item (brand, name, color, price, stock, image) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($connect, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssdis", $brand, $name, $color, $price, $stock, $image);
                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: inventory.php");
                        exit;
                    }
                }
                // If insert fails, show error page below
            }
        }
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
    <title>Stockly - Error</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
            font: 400 14px "Poppins";
            color: #16171a;
            gap: 16px;
        }
        body {
            height: 100svh;
            width: 100svw;
            background-color: #ffffff;
            overflow-x: hidden;
            background: linear-gradient(180deg, #ebe6e8 0%, #d8e0f4 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        nav {
            width: 100svw;
            height: 70px;
            position: fixed;
            top: 0;
            padding: 0 24px 0 24px;
            background: rgba(255,255,255,0.18);
            background-blend-mode: normal;
            backdrop-filter: blur(12px);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav button{
            padding: 14px 19px;
            border-radius: 30px;
            background: #020202;
            border: none;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: ease .3s;
        }
        
        nav button img{
            width: 18px;
            height: 18px;
        }
        nav button:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }
        h1 {
            font: 400 36px "Poppins";
        }
        p {
            width: 100%;
            max-width: 628px;
            height: auto;
            text-align: center;
        }
        b{
            font-weight: 600;
        }
        img {
            width: 110.68px;
            height: 31px;
        }
        .actionMenu {
            padding-top: 60px;
            display: flex;
            flex-direction: row;
            gap: 30px;
        }
        .actionMenu button {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }
        .actionMenu img {
            width: 340px;
            height: 233px;
            transition: ease .3s;
        }
        .actionMenu form:hover > button img {
            filter: drop-shadow(0 6px 20px rgba(0, 0, 0, 0.2));
            transform: translateY(-8px);
        }
    </style>
</head>
<body>
    <nav>
        <img src="assets/image/stockly.png" alt="logo" srcset="">
        <form action="logout.php" method="post">
        <button class="logout">
            <img src="assets/image/ic-logout.svg" alt="user" srcset="">
            Logout
        </button>
        </form>
    </nav>

    <h1>Oops! Error Occurred</h1>
    <p>Seems like the data entered is incomplete or missing</p>
    <div class="actionMenu">
        <form action="additem.php" method="post">
            <button>
                <img src="assets/editItem.png" alt="add" srcset="">
                <p>Go back</p>
            </button>
        </form>
    </div>
</body>
</html>