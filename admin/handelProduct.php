<?php
session_start();
include_once "../functions/handelRegisterAndLogin.php";
include_once "validateProduct.php";

$database =new Database();
$conn = $database->getConnection();

class Product
{
  private $name;
  private $slug;
  private $small_description;
  private $description;
  private $status;
  private $original_price;
  private $selling_price;
  private $quantity;
  private $trending;
  private $image;
  private $meta_title;
  private $meta_description;
  private $meta_keywords;
  
  public function __construct($name,$slug,$description,$small_description,$status,$original_price,$selling_price,$quantity,$trending,$image,$meta_title,$meta_description,$meta_keywords){
      $this->name = $name;
      $this->slug = $slug;
      $this->description = $description;
      $this->small_description = $small_description;
      $this->status = $status;
      $this->original_price = $original_price;
      $this->selling_price = $selling_price;
      $this->quantity = $quantity;
      $this->image = $image;
      $this->trending = $trending;
      $this->meta_title = $meta_title;
      $this->meta_description = $meta_description;
      $this->meta_keywords = $meta_keywords;
      
  }
  public function validateAll($image)
  {
    $valid_image = validate_image($image);
    if (validate_name($this->name) && validate_slug($this->slug) && validate_description($this->description) &&validate_small_description($this->small_description) && $valid_image !== false)
    {
      $this->image =$valid_image;
      return true;
    } else
    {
      return false;
    }
  }
  public function insertProductData($conn)
  {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    // var_dump($category_id);
    $name = mysqli_real_escape_string($conn, $this->name);
    $slug = mysqli_real_escape_string($conn, $this->slug);
    $description = mysqli_real_escape_string($conn, $this->description);
    $small_description = mysqli_real_escape_string($conn, $this->small_description);
    $status = mysqli_real_escape_string($conn, $this->status);
    $trending = mysqli_real_escape_string($conn, $this->trending);
    $original_price = mysqli_real_escape_string($conn, $this->original_price);
    $selling_price = mysqli_real_escape_string($conn, $this->selling_price);
    $quantity = mysqli_real_escape_string($conn, $this->quantity);
    $image = mysqli_real_escape_string($conn, $this->image);
    $meta_title = mysqli_real_escape_string($conn, $this->meta_title);
    $meta_description = mysqli_real_escape_string($conn, $this->meta_description);
    $meta_keywords = mysqli_real_escape_string($conn, $this->meta_keywords);

    $query = "INSERT INTO products (`category_id`,`name`, `slug`, `description`,`small_description`, `status`,`trending`,`original_price`,`selling_price`,`quantity`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`)
              VALUES ('$category_id','$name', '$slug','$description', '$small_description','$status','$trending', '$original_price', '$selling_price','$quantity','$image', '$meta_title', '$meta_description', '$meta_keywords', NOW())";
    $result = mysqli_query($conn, $query);
    if($result)
    { 
      $_SESSION['message']= 'Data inserted successfully.';
      header("Location: addProduct.php");
      exit();
    }else
    {
      $_SESSION['message']= 'something wrong occure';
      header("Location: addProduct.php");
    } 

  }
//   public function updateCategory($conn)
//   {
    
//     $name = mysqli_real_escape_string($conn, $this->name);
//     $slug = mysqli_real_escape_string($conn, $this->slug);
//     $description = mysqli_real_escape_string($conn, $this->description);
//     $status = mysqli_real_escape_string($conn, $this->status);
//     $popular = mysqli_real_escape_string($conn, $this->popular);
//     $meta_title = mysqli_real_escape_string($conn, $this->meta_title);
//     $meta_description = mysqli_real_escape_string($conn, $this->meta_description);
//     $meta_keywords = mysqli_real_escape_string($conn, $this->meta_keywords);
//     $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
//     $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);
//     $new_image = $_FILES['image'];

//     if ($new_image['size'] > 0) {
//       $valid_image = validate_image($new_image);
//       if ($valid_image !== false) {
//           $updatefileName = $valid_image;
//           // delete the old image file
//           if (file_exists($old_image)) {
//               unlink($old_image);
//           }
//       }else {
//           $_SESSION['message'] = 'Invalid image file.';
//           header("Location: editCategory.php?id=$category_id");
//           exit();
//       }
//     } else {
//       $updatefileName = $old_image;
//   }

       
//   $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', status='$status', popular='$popular', image='$updatefileName', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords' WHERE id=$category_id";
//   $result = mysqli_query($conn, $update_query);

//   if ($result) {
//       $_SESSION['message'] = 'Data updated successfully.';
//       header("Location: allCategories.php");
//       exit();
//   } else {
//       $_SESSION['message'] = 'Something went wrong.';
//       header("Location: editCategory.php?id=$category_id");
//       exit();
//   }

//   }
//   public function deleteCategory($conn)
//   {   
//     $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
//     $select_category_query = "SELECT * from categories WHERE id=$category_id";
//     $category_query = mysqli_query($conn, $select_category_query);
//     $category_data=mysqli_fetch_array($category_query);
//     $image = $category_data['image'];

//     $delete_query = "DELETE from categories WHERE id=$category_id";
//     $result = mysqli_query($conn, $delete_query);

//     if ($result)
//     {
//       if (file_exists("upload/".$image))
//       {
//         unlink("upload/".$image);
//       }
//       $_SESSION['message'] = 'Data deleted successfully.';
//       header("Location: allCategories.php");
//         exit();
//     } else {
//         $_SESSION['message'] = 'Something went wrong.';
//         header("Location: allCategories");
//         exit();
//     }
//   }
}

if(isset($_POST['add_product_btn']))
{
        $category_id=$_POST['category_id'];
        $name = $_POST['name'] ;
        $slug = $_POST['slug'] ;
        $description = $_POST['description'] ;
        $small_description = $_POST['small_description'] ;
        $original_price = $_POST['selling_price'] ;
        $selling_price = $_POST['original_price'] ;
        $status = isset($_POST['status'] )? '1' : '0' ;
        $trending = isset($_POST['trending'] )? '1' : '0' ;
        $image=$_FILES['image'];
        $quantity = $_POST['quantity'] ;
        $meta_title = $_POST['meta_title'] ;
        $meta_description = $_POST['meta_description'] ;
        $meta_keywords = $_POST['meta_keywords'] ;

        
      $product = new Product($name,$slug,$description,$small_description,$original_price,$selling_price,$status,$trending,$image,$quantity,$meta_title,$meta_description,$meta_keywords);

      if($product->validateAll($image))
      {
        $product->insertProductData($conn);
      }else
      {
        echo $_SESSION['message'];
        header("Location: addProduct.php");
        exit();
      }

}
// elseif(isset($_POST['update_category_btn']))
// {
//     $category_id=$_POST['category_id'];
//     $name = $_POST['name'] ;
//     $slug = $_POST['slug'] ;
//     $description = $_POST['description'] ;
//     $status = isset($_POST['status'] )? '1' : '0' ;
//     $popular = isset($_POST['popular']) ? '1' : '0' ;
//     $meta_title = $_POST['meta_title'] ;
//     $meta_description = $_POST['meta_description'] ;
//     $meta_keywords = $_POST['meta_keywords'] ;
//     $new_image=$_FILES['image'];
//     $old_image=$_POST['old_image'];
        

//         $category = new Category($name,$slug,$description,$status,$trending,$popular,$updatefileName,$meta_title,$meta_description,$meta_keywords);
//         $category->updateCategory($conn);
// }
// elseif(isset($_POST['delete_category_btn']))
// {
//     // $category_id=$_POST['category_id'];
//     $category = new Product($name,$slug,$description,$status,$popular,$image,$meta_title,$meta_description,$meta_keywords);
//     $category->deleteCategory($conn);
// }
$database ->closeConnection();
?>