<?php
include_once "validation.php";

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$host = "localhost";
$username = "root";
$password = "";
$database = "php_ecom";
$conn = mysqli_connect($host,$username,$password,$database);

if(!$conn){
    die("connection failed" . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = trim(htmlspecialchars($_POST["email"]));
    $phone = trim(htmlspecialchars($_POST["phone"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    $cpassword = trim(htmlspecialchars($_POST["cpassword"]));
    
  if(validateName($name)){
        $name = trim(htmlspecialchars($name));     
        if(validateEmail($email)){
          
          //check email exists or not
          $check_email_query ="SELECT email from users Where email='$email' ";
          $check_email_query_result =mysqli_query($conn, $check_email_query);

          if(mysqli_num_rows($check_email_query_result) > 0)
          {
            $_SESSION['message']= 'email already exists.';
            header("Location: ../register.php");
          }else
          {
              if ($password == $cpassword) 
              {
                $password =password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
                $result = mysqli_query($conn, $query);
                if ($result)
                {
                  $_SESSION['message']= 'Data inserted successfully.';
                  header("Location: ../login.php");
                  exit();
                }else 
                {
                  $_SESSION['message']= 'something wrong occure';
                  header("Location: ../register.php");
                }
              }else
              {
                $_SESSION['message'] = "The password don't match.";
                header('location: ../register.php ');
              }  
          } 
      }   
  } else {
      echo $_SESSION['message'];
      header("Location: ../register.php");
      exit();
  }
        
}elseif(isset($_POST["login"]))
{
      $email = trim(htmlspecialchars($_POST["email"]));
      $password = trim(htmlspecialchars($_POST["password"]));
      //collect from database
      $login_query ="SELECT * from users Where email='$email' ";
      $login_query_result =mysqli_query($conn, $login_query);
      
      if(mysqli_num_rows($login_query_result) > 0)
      {   
        
         // Get the user's data
          $row = mysqli_fetch_array($login_query_result);
          
          $name = $row['name'];
          $email = $row['email'];
          $hashedPasswordFromDatabase = $row['password'];
          
          //Check if the hashedpassword is matches entered password
          if(password_verify($password, $hashedPasswordFromDatabase))
          {
            $_SESSION['loggedin'] =true;
            // Set session variables
            $_SESSION['email']=$email;
            $_SESSION['name']=$name;
            
            
            $_SESSION['message']= 'login successfully.';
            header("Location: ../index.php");
            exit();
          }else{
            $_SESSION['message']= 'invalid password';
            header("Location: ../login.php");
          }
      }else 
      {
          $_SESSION['message']= 'invalid email';
          header("Location: ../login.php");
       }
    
  }



mysqli_close($conn);

?>