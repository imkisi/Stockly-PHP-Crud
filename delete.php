<?php 
session_start();
if (empty($_SESSION['username'])){
    header("location:index.php");
}
include 'config/connection.php';
$id = $_GET['id'];
if (delete($id) > 0) {
?>

<script>
    alert("Item successfully deleted!");
    document.location.href = "inventory.php";
</script>

<?php 
    } else {
    ?>
    <script>
        alert('Failed to delete item!');
        document.location.href = 'inventory.php';
    </script>
    <?php } ?>

