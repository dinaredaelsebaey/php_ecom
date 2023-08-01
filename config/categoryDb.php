<?php
include_once 'db.php';

$database =new Database();
$conn = $database->getConnection();

function selectCategoryId($table,$id)
{
    global $conn ;
    $sql = "SELECT * FROM $table WHERE id = $id";
    return $result = mysqli_query($conn, $sql);
}
function selectAllCategories($table)
{
    global $conn ;
    $sql = "SELECT * FROM $table";
    return $result = mysqli_query($conn, $sql);
}
function selectUserCategory($table)
{
    global $conn ;
    $sql = "SELECT * FROM $table WHERE status = '0' ";
    return $result = mysqli_query($conn, $sql);
}
$database->closeConnection();
?>