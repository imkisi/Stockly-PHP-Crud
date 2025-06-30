<?php 
session_start();

if (empty($_SESSION['username'])){
    header("location:index.php");
}

require 'config/connection.php';
$item = query("SELECT * FROM item");

if (isset($_POST["search"])) {
    $item = search($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css" integrity="sha384-NvKbDTEnL+A8F/AA5Tc5kmMLSJHUO868P+lDtTpJIeQdGYaUIuLr4lVGOEA1OcMy" crossorigin="anonymous">
    <title>Stockly - Inventory</title>

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
            padding: 24px 24px 0 24px;
            background-color: #ffffff;
            overflow-x: hidden;
            background: linear-gradient(180deg, #ebe6e8 0%, #d8e0f4 100%);
            display: flex;
            flex-direction: column;
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
        nav .search {
            width: 100%;
            max-width: 532px;
            padding: 14px 24px;
            background-color: #ffffff;
            border-radius: 36px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
            gap: 20px;
        }
        nav .search img {
            width: 18px;
            height: 18px;
            filter: invert(81%) sepia(4%) saturate(915%) hue-rotate(173deg) brightness(76%) contrast(80%);
        }
        nav input {
            width: 100%;
            border: none;
        }
        input:focus {
            border: none;
            outline: none;
        }
        nav .button {
            display: flex;
            flex-direction: row;
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
        .add{
            background: #0051FF !important;
        }
        button img{
            width: 18px;
            height: 18px;
        }
        button:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }
        .add:hover {
            box-shadow: 0 6px 20px rgba(0, 13, 255, 0.3);
            transform: translateY(-2px);
        }
        h1 {
            font: 400 36px "Poppins";
            padding-top: 120px;
        }
        p {
            width: 100%;
            max-width: 628px;
            height: auto;
            text-align: center;
        }
        img {
            width: 110.68px;
            height: 31px;
        }
        .item {
            width: 100%;
            max-width: 1280px;
            align-items: start;
            overflow-y: scroll;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .item::-webkit-scrollbar {
            display: none;
        }
        table {
            width: 100%;
        }
        table .title td:nth-child(1), .tableItem td:nth-child(1) {
            width: 3%;
        }
        table .title td:nth-child(2), .tableItem td:nth-child(2) {
            width: 12%;
        }
        table .title td:nth-child(3), .tableItem td:nth-child(3) {
            width: 10%;
        }
        table .title td:nth-child(4), .tableItem td:nth-child(4) {
            width: 41%;
        }
        table .title td:nth-child(5), .tableItem td:nth-child(5){
            width: 8%;
        }
        table .title td:nth-child(6), .tableItem td:nth-child(6) {
            width: 12%;
        }
        table .title td:nth-child(7), .tableItem td:nth-child(7) {
            width: 7%;
        }
        .tableContent {
            width: 100%;
            height: auto;
            margin: 40px 0;
            padding: 45px 38px;
            border-radius: 39px;
            background: #f8f7f9;
        }
        .preview {
            width: 96px;
            height: 77px;
            border-radius: 10px;
            object-fit: cover;
            object-position: center;
        }
        .title tr td {
            color: #8F99A5 !important;
        }
        .tableItem td {
            font: 600 14px "Poppins";
            padding: 12px 0;
            color: #16171A;

        }
        hr {
            margin: 22px 0;
            width: 100%;
            height: 1px;
            border: 1px dashed #8f99a5;
        }
        td button{
            padding: 8px;
            border-radius: 30px;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: ease .3s;
        }
        .btn button {
            background: #FF6363 !important;
        }
        .btn2 button {
            background: #1FB467 !important;
        }
    </style>
</head>
<body>
    <nav>
        <img src="assets/stockly.png" alt="logo" srcset="">
        <form action="" method="post" class="search">
            <img src="assets/ic-search.svg" alt="add" srcset="">
            <input type="text" name="keyword" id="keyword" placeholder="Search">
        </form>
        <div class="button">
            <form action="additem.php" method="post">
                <button class="add">
                    <img src="assets/ic-add.svg" alt="user" srcset="">
                    Add item
                </button>
            </form>
            <form action="logout.php" method="post">
                <button class="logout">
                    <img src="assets/ic-logout.svg" alt="user" srcset="">
                    Logout
                </button>
            </form>
    </div>
    </nav>

    <div class="item">
        <h1>Inventory</h1>
        <div class="tableContent">
            <table>
                <thead class="title">
                    <tr class="title">
                        <td>#</td>
                        <td>Image</td>
                        <td>Brand</td>
                        <td>Name</td>
                        <td>Color</td>
                        <td>Price</td>
                        <td>In Stock</td>
                        <td align="center" colspan="2">Action</td>
                        <td></td>
                    </tr>
                </thead>
            </table>
                    <hr>
            <table>
                <tbody>
                    <?php
                    $i = 1;
                    if (isset($item) && (is_array($item) || is_object($item))) {
                        foreach($item as $row){
                    ?>
                            <tr class="tableItem">
                                <td align="left">
                                    <?php echo $i; ?>
                                </td>
                                <td align="left">
                                    <img src="assets/image/<?php echo $row["image"]; ?>" class="preview">
                                </td>
                                <td align="left">
                                    <?php echo $row["brand"]; ?>
                                </td>
                                <td align="left">
                                    <?php echo $row["name"]; ?>
                                </td>
                                <td align="left">
                                    <?php echo $row["color"]; ?>
                                </td>
                                <td align="left">
                                    Rp
                                    <?php echo number_format($row["price"], 0, ',', '.'); ?>
                                </td>
                                <td align="left">
                                    <?php echo $row["stock"]; ?>
                                </td>
                                <td class="btn">
                                    <button onclick="window.location.href='edit.php?id=<?php echo $row['item_id']; ?>'">
                                        <img src="assets/ic-edit.svg" alt="" srcset="">
                                    </button>
                                </td>
                                <td class="btn2">
                                    <button onclick="window.location.href='delete.php?id=<?php echo $row['item_id']; ?>'">
                                        <img src="assets/ic-trash.svg" alt="" srcset="">
                                    </button>
                                </td>
                            </tr>
                    <?php
                            $i++;
                        }
                    } else {
                        echo '<tr><td colspan="8" align="center">No items found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>