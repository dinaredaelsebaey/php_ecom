<?php
session_start();
include_once "../functions/handelRegisterAndLogin.php";
include_once "validateCategory.php";

$database =new Database();
$conn = $database->getConnection();

class Category
{
  private $name;
  private $slug;
  private $description;
  private $status;
  private $popular;
  private $image;
  private $meta_title;
  private $meta_description;
  private $meta_keywords;
  
  public function __construct($name,$slug,$description,$status,$popular,$image,$meta_title,$meta_description,$meta_keywords){
      $this->name = $name;
      $this->slug = $slug;
      $this->description = $description;
      $this->status = $status;
      $this->popular = $popular;
      $this->image = $image;
      $this->meta_title = $meta_title;
      $this->meta_description = $meta_description;
      $this->meta_keywords = $meta_keywords;
      
  }
  public function validateAll($image)
  {
    $valid_image = validate_image($image);
    if (validate_name($this->name) && validate_slug($this->slug) && validate_description($this->description) && $valid_image !== false)
    {
      $this->image =$valid_image;
      return true;
    } else
    {
      return false;
    }
  }
  public function insertUserData($conn)
  {
    $name = mysqli_real_escape_string($conn, $this->name);
    $slug = mysqli_real_escape_string($conn, $this->slug);
    $description = mysqli_real_escape_string($conn, $this->description);
    $status = mysqli_real_escape_string($conn, $this->status);
    $popular = mysqli_real_escape_string($conn, $this->popular);
    $image = mysqli_real_escape_string($conn, $this->image);
    $meta_title = mysqli_real_escape_string($conn, $this->meta_title);
    $meta_description = mysqli_real_escape_string($conn, $this->meta_description);
    $meta_keywords = mysqli_real_escape_string($conn, $this->meta_keywords);

    $query = "INSERT INTO categories (`name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`)
              VALUES ('$name', '$slug', '$description', '$status', '$popular', '$image', '$meta_title', '$meta_description', '$meta_keywords', NOW())";
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

  }
  public function updateCategory($conn)
  {
    $name = mysqli_real_escape_string($conn, $this->name);
    $slug = mysqli_real_escape_string($conn, $this->slug);
    $description = mysqli_real_escape_string($conn, $this->description);
    $status = isset($_POST['status']) ? boolval($_POST['status']) : false;
    $status_value = $status ? 1 : 0;
    $popular = mysqli_real_escape_string($conn, $this->popular);
    $meta_title = mysqli_real_escape_string($conn, $this->meta_title);
    $meta_description = mysqli_real_escape_string($conn, $this->meta_description);
    $meta_keywords = mysqli_real_escape_string($conn, $this->meta_keywords);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);
    $new_image = $_FILES['image'];

    if ($new_image['size'] > 0) {
      $valid_image = validate_image($new_image);
      if ($valid_image !== false) {
          $updatefileName = $valid_image;
          // delete the old image file
          if (file_exists($old_image)) {
              unlink($old_image);
          }
      }else {
          $_SESSION['message'] = 'Invalid image file.';
          header("Location: editCategory.php?id=$category_id");
          exit();
      }
    } else {
      $updatefileName = $old_image;
  }

       
  $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', status='$status_value', popular='$popular', image='$updatefileName', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords' WHERE id=$category_id";
  $result = mysqli_query($conn, $update_query);

  if ($result) {
      $_SESSION['message'] = 'Data updated successfully.';
      header("Location: allCategories.php");
      exit();
  } else {
      $_SESSION['message'] = 'Something went wrong.';
      header("Location: editCategory.php?id=$category_id");
      exit();
  }

  }
  public function deleteCategory($conn)
  {   
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $select_category_query = "SELECT * from categories WHERE id=$category_id";
    $category_query = mysqli_query($conn, $select_category_query);
    $category_data=mysqli_fetch_array($category_query);
    $image = $category_data['image'];

    $delete_query = "DELETE from categories WHERE id=$category_id";
    $result = mysqli_query($conn, $delete_query);

    if ($result)
    {
      if (file_exists("upload/".$image))
      {
        unlink("upload/".$image);
      }
      $_SESSION['message'] = 'Data deleted successfully.';
      header("Location: allCategories.php");
        exit();
    } else {
        $_SESSION['message'] = 'Something went wrong.';
        header("Location: allCategories");
        exit();
    }
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

        
      $category = new Category($name,$slug,$description,$status,$popular,$image,$meta_title,$meta_description,$meta_keywords);

      if($category->validateAll($image))
      {
        $category->insertUserData($conn);
      }else
      {
        echo $_SESSION['message'];
        header("Location: addCategory.php");
        exit();
      }

}
elseif(isset($_POST['update_category_btn']))
{
    $category_id=$_POST['category_id'];
    $name = $_POST['name'] ;
    $slug = $_POST['slug'] ;
    $description = $_POST['description'] ;
    $status = isset($_POST['status'] )? '1' : '0' ;
    $popular = isset($_POST['popular']) ? '1' : '0' ;
    $meta_title = $_POST['meta_title'] ;
    $meta_description = $_POST['meta_description'] ;
    $meta_keywords = $_POST['meta_keywords'] ;
    $new_image=$_FILES['image'];
    $old_image=$_POST['old_image'];
        
        // if($new_image !="")
        // {
        //   $updatefileName= $new_image;
        // }else{
        //   $updatefileName= $old_image;
        // }
        $category = new Category($name,$slug,$description,$status,$popular,$updatefileName,$meta_title,$meta_description,$meta_keywords);
        $category->updateCategory($conn);
}
elseif(isset($_POST['delete_category_btn']))
{
    // $category_id=$_POST['category_id'];
    $category = new Category($name,$slug,$description,$status,$popular,$image,$meta_title,$meta_description,$meta_keywords);
    $category->deleteCategory($conn);
}
$database ->closeConnection();
?>