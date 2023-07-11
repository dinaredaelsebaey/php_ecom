<?php
include_once 'db.php';

$database =new Database();
$conn = $database->getConnection();

function selectAllProducts($table){
    global $conn ;
    $sql = "SELECT * FROM $table";
    return $result = mysqli_query($conn, $sql);
    
}
function selectProductId($table,$id)
{
    global $conn ;
    $sql = "SELECT * FROM $table WHERE id = $id";
    return $result = mysqli_query($conn, $sql);
}
$database->closeConnection();
?>