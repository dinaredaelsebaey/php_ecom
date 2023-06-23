<?php
session_start();
include_once "../functions/handelRegisterAndLogin.php";
include_once "validateCategory.php";

function validateAll($name,$slug,$description,$image)
{
  if (validate_name($name) && validate_slug($slug) && validate_description($description) && validate_image($image))
  {
    return true;
  } else
  {
    return false;
  }
}
    if(isset($_POST['add_category_btn']))
    {
        $name = $_POST['name'] ;
        $slug = $_POST['slug'] ;
        $description = $_POST['description'] ;
        $status = isset($_POST['status'] )? '1' : '0' ;
        $popular = isset($_POST['popular']) ? '1' : '0' ;
        $image=$_FILES['image'];
        $meta_title = $_POST['meta_title'] ;
        $meta_description = $_POST['meta_description'] ;
        $meta_keywords = $_POST['meta_keywords'] ;
        
        //extract image details
        $img_name=$image['name'];
        $img_type=$image['type'];
        $img_tmp_name=$image['tmp_name'];
        $img_size=$image['size'];
        $img_error=$image['error'];

        

          if(validateAll($name,$slug,$description,$image)){
            $database =new Database();
            $conn = $database->getConnection();

            $query = "INSERT INTO categories (`name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`)
                    VALUES ('$name', '$slug', '$description', '$status', '$popular', '$random_img_name', '$meta_title', '$meta_description', '$meta_keywords', NOW())";
            $result = mysqli_query($conn, $query);
              if($result)
              { 
                  $_SESSION['message']= 'Data inserted successfully.';
                  header("Location: addCategory.php");
                  exit();
              }else
              {
                  $_SESSION['message']= 'something wrong occure';
                  header("Location: addCategory.php");
              } 
            }else
            {
              echo $_SESSION['message'];
              header("Location: addCategory.php");
            }
        }
        

    $database ->closeConnection();
?>