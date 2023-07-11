<?php
include_once 'db.php';

$database =new Database();
$conn = $database->getConnection();

function selectAllProducts($table){
    global $conn ;
    $sql = "SELECT * FROM $table";
    return $result = mysqli_query($conn, $sql);
    
}
$database->closeConnection();
?>