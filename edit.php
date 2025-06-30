<?php 
session_start();
if (empty($_SESSION['username'])){
    header("location:index.php");
    exit;
}
include 'config/connection.php';

$edit = mysqli_query($connect, "SELECT * FROM item WHERE item_id='$_GET[id]'");
$row = mysqli_fetch_array($edit);
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
    <title>Stockly - Update Item</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
            font: 400 14px "Poppins";
            color: #8F99A5;
        }
        body {
            height: 100svh;
            width: 100svw;
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
            padding-top: 120px;
            color: #16171a;
        }
        p, .input label {
            font: 600 14px "Poppins";
            color: #16171a;
        }
        b{
            font-weight: 600;
        }
        img {
            width: 110.68px;
            height: 31px;
        }
        .container {
            width: 100%;
            max-width: 1280px;
            align-items: start;
            overflow-y: scroll;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .container::-webkit-scrollbar {
            display: none;
        }
        .form {
            overflow: hidden;
            width: 100%;
            height: 100%;
            max-height: 550px;
            margin: 40px 0;
            padding: 45px 38px;
            border-radius: 39px;
            background: #f8f7f9;
            display: flex;
            flex-direction: row;
            gap: 24px;
        }
        .formL, .formR {
            width: 100%;
            height: 100%;
        }
        .formContent {
            width: 100%;height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 18px;
        }
        .formR .input {
            width: 100%;
            max-width: 600px;
            border: none;
            display: flex;
            flex-direction: column;
        }
        .input input {
            width: 100%;
            border: none;
            padding: 14px 24px;
            margin: 4px 0;
            background-color: #ffffff;
            border-radius: 36px;
            outline: none;
        }
        form button {
            width: 100%;
            max-width: 200px;
            padding: 14px 24px;
            border-radius: 36px;
            background-color: #020202;
            color: #ffffff;
            border: none;
            cursor: pointer;
            transition: ease .3s;
        }
        .preview {
            position: relative;
            width: 100%;
            height: 90%;
            margin-top: 12px;
            border-radius: 22px;
            border: 1px solid #8f99a5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }
        .preview img {
            width: 24px;
            height: 24px;
        }
        .preview input {
            z-index: 2;
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
        }
        .preview label {
            position: absolute;
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
        }
        .preview label img {
            z-index: 1;
            position: absolute;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 15px;
            padding: 24px;
            object-fit: cover;
            object-position: center;
        }
        .formR button {
            margin-top: 12px;
        }
    </style>
</head>
<body>
    <nav>
        <img src="assets/stockly.png" alt="logo" srcset="">
        <form action="logout.php" method="post">
        <button class="logout">
            <img src="assets/ic-logout.svg" alt="user" srcset="">
            Logout
        </button>
        </form>
    </nav>
    <div class="container">
    <h1>Item Details</h1>
        <div class="form">
            <form action="update.php" method="post" enctype="multipart/form-data" class="formContent" style="display:flex;flex-direction:row;width:100%;gap:24px;">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['item_id']); ?>">
                <div class="formL">
                    <p>Image</p>
                    JPG, PNG, GIF, SVG, WEBP<br>
                    <div class="preview">
                        <input type="file" id="fileInput" name="image">
                        <img src="assets/ic-upload.svg" alt="" srcset="">
                        <p>Choose a file or drag & drop it here</p>
                        <button type="button" id="customBrowse">Browse File</button>
                        <label for="fileInput">
                            <img id="fileImage" src="assets/image/<?php echo htmlspecialchars($row['image']); ?>" alt="">
                        </label>
                    </div>
                </div>
                <div class="formR">
                    <div class="input">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" id="brand" placeholder="Enter item brand" required value="<?php echo htmlspecialchars($row['brand']); ?>">
                    </div>
                    <div class="input">
                        <label for="name">Item Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter item name" required value="<?php echo htmlspecialchars($row['name']); ?>">
                    </div>
                    <div class="input">
                        <label for="color">Color</label>
                        <input type="text" name="color" id="color" placeholder="Enter item color" required value="<?php echo htmlspecialchars($row['color']); ?>">
                    </div>
                    <div class="input">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" placeholder="Enter price" required value="<?php echo htmlspecialchars($row['price']); ?>">
                    </div>
                    <div class="input">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" placeholder="Enter stock" required value="<?php echo htmlspecialchars($row['stock']); ?>">
                    </div>
                    <button type="submit" name="submit" value="save">Update Item</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const fileInput = document.getElementById('fileInput');
        const customBrowse = document.getElementById('customBrowse');
        const fileImage = document.getElementById('fileImage');

        customBrowse.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fileImage.src = e.target.result;
                }
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                fileImage.src = "";
            }
        });
    </script>
</body>
</html>