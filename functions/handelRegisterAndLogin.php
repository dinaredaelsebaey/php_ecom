<?php
include_once "validateRegisterForm.php";
include_once "userData.php";
include_once "loginClass.php";
include_once(__DIR__ . '/../config/db.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


$database =new Database();
$conn = $database->getConnection();

if (isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $email = trim(htmlspecialchars($_POST["email"]));
    $phone = trim(htmlspecialchars($_POST["phone"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    $cpassword = trim(htmlspecialchars($_POST["cpassword"]));
    
    $user = new User($name,$email,$phone,$password,$cpassword);
    if($user->validateAll())
    {
      $user->insertUserData($conn);
    }else
    {
      echo $_SESSION['message'];
      header("Location: ../registerForm.php");
      exit();
    }
        
}elseif (isset($_POST["login"]))
{
      $email = trim(htmlspecialchars($_POST["email"]));
      $password = trim(htmlspecialchars($_POST["password"]));
      
      $login = new Login($email,$password);
      $login->authenticate($conn);
}

$database->closeConnection();

?>