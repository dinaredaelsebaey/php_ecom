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



if(isset($_POST["submit"]))
{
    $name =trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $phone = trim(htmlspecialchars($_POST["phone"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    $cpassword = trim(htmlspecialchars($_POST["cpassword"]));

    // // validation name
    // $name=validateName($name);
    // // validation email
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $_SESSION['message'] = "The email address '$email' is not valid.";
    //     header('location: register.php ');
    //   } else {
    //     return true;
        
    //   }
    
    //check email exists or not
    $check_email_query ="SELECT email from users Where email='$email' ";
    $check_email_query_result =mysqli_query($conn, $check_email_query);

    if(mysqli_num_rows($check_email_query_result) > 0)
    {
      $_SESSION['message']= 'email already exists.';
      header("Location: ../register.php");
    }else{
      if ($password == $cpassword) 
       {
            $query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
            $result = mysqli_query($conn, $query);
            if ($result)
            {
              $_SESSION['message']= 'Data inserted successfully.';
                header("Location: ../login.php");
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
          // echo $row['password'];
          // echo $row['name'];
          // echo $row['email'];
          
          //Check if the password is correct
          if($password == $row['password'])
          {
            $_SESSION['loggedin'] =true;
            // Set session variables
            $_SESSION['email']=$email;
            $_SESSION['name']=$name;
            
            header("Location: ../index.php");
            $_SESSION['message']= 'login successfully.';
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