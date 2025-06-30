<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "stockly"; 

$connect=mysqli_connect($server, $username, $password) or die ("Connection Failed!");
mysqli_select_db($connect, $database) or die ("Database cannot found");

function query($sql){
    global $connect;
    $result = mysqli_query($connect, $sql);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function delete($id){
    global $connect;
    mysqli_query($connect, "DELETE FROM item WHERE item_id = $id");

    return mysqli_affected_rows($connect);
}

function find($keyword){
    $query = "SELECT * FROM item WHERE
    name LIKE '%$keyword%'";

    return query($query);
}

?>