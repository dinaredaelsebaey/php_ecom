<?php
session_start();
include_once "../functions/handelRegisterAndLogin.php";
include_once "validateCategory.php";

$database =new Database();
$conn = $database->getConnection();

class AddCategory
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

        
      $category = new AddCategory($name,$slug,$description,$status,$popular,$image,$meta_title,$meta_description,$meta_keywords);

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

    $database ->closeConnection();
?>