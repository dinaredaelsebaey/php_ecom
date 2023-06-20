<?php
session_start();
include_once "../functions/handel.php";

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
        $img_Name=$image['name'];
        $img_type=$image['type'];
        $img_tmp_name=$image['tmp_name'];
        $img_size=$image['size'];
        $img_error=$image['error'];

            //validation image file
        $extension_array = array('png','PNG', 'jpg','JPG');
        $img_ext = pathinfo($img_Name, PATHINFO_EXTENSION);
        $random_img_name = uniqid(). "." . $img_ext;

        //////store image in db//////
        move_uploaded_file($img_tmp_name,"includes/upload/$img_Name");

         // insert ti db
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
        
        $database ->closeConnection();
    }

?>