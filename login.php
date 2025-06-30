<?php 
    session_start();
    include 'config/connection.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query=mysqli_query($connect, "SELECT * FROM login WHERE username='$username' AND password='$password'");
    $check=mysqli_num_rows($query);
    if($check > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status'] = $login;
        header("location:home.php");
    }else{
        header("location:index.php?message=failed!");
    }
?>
