<?php
include_once 'db.php';

$database =new Database();
$conn = $database->getConnection();

function selectId($conn,$id){
    $sql = "SELECT * FROM categories WHERE id = $id";
    return $result = mysqli_query($conn, $sql);
    
}
$database->closeConnection();
?>