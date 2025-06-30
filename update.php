<?php 
session_start();
if (empty($_SESSION['username'])){
    header("location:index.php");
    exit;
}
include 'config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $brand = trim($_POST['brand']);
    $name = trim($_POST['name']);
    $color = trim($_POST['color']);
    $price = intval($_POST['price']);
    $stock = intval($_POST['stock']);

    // Handle file upload if a new image is uploaded
    $image = $_FILES['image']['name'] ? basename($_FILES['image']['name']) : '';
    if ($image && $_FILES['image']['error'] == 0) {
        $targetDir = "assets/image/";
        $targetFile = $targetDir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        $sql = "UPDATE item SET brand=?, name=?, color=?, price=?, stock=?, image=? WHERE item_id=?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "sssdisi", $brand, $name, $color, $price, $stock, $image, $id);
    } else {
        $sql = "UPDATE item SET brand=?, name=?, color=?, price=?, stock=? WHERE item_id=?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "sssdis", $brand, $name, $color, $price, $stock, $id);
    }

    if ($stmt && mysqli_stmt_execute($stmt)) {
        header("Location: inventory.php");
        exit;
    } else {
        echo "<script>alert('Failed to update item.');</script>";
    }
}
?>