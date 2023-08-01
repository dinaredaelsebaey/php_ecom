<?php
include_once 'db.php';

$database =new Database();
$conn = $database->getConnection();

function getActiveCategory($table)
{
    global $conn ;
    $sql = "SELECT * FROM $table WHERE status = '1' ";
    return $result = mysqli_query($conn, $sql);
}
function getActiveCategoryId($table,$id)
{
    global $conn ;
    $sql = "SELECT * FROM $table WHERE id = '$id' AND status = '1' ";
    return $result = mysqli_query($conn, $sql);
}
function getActiveSlug($table,$slug)
{
    global $conn ;
    $sql = "SELECT * FROM $table WHERE slug = '$slug' AND status = '1' LIMIT 1";
     $result = mysqli_query($conn, $sql);
     return $result = mysqli_query($conn, $sql);
}
function getProductByCategoryId($category_id)
{
    global $conn;
    $sql = "SELECT * FROM products WHERE category_id = '$category_id' AND status = '1'";
    // echo "SQL: $sql"; // Debugging line
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return array();
    }
    // Fetch all rows and return as an array of associative arrays
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

$database->closeConnection();
?>