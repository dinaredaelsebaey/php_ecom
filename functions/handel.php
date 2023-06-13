<?php
include_once "validation.php";

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

class Database{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "php_ecom";
    private $conn ;
    public function __construct()
    {
      $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
      if(!$this->conn)
      {
        die("connection failed" . mysqli_connect_error());
      }
    }
    public function getConnecrion()
    {
      return $this->conn;
    }
    public function closeConnection()
    {
      mysqli_close($this->conn);
    }

}
class User
{
    private $name ;
    private $email ;
    private $phone ;
    private $password ;
    private $cpassword ;
    public function __construct($name, $email, $phone, $password, $cpassword)
    {
      $this->name = $name;
      $this->email = $email;
      $this->phone = $phone;
      $this->password = $password;
      $this->cpassword = $cpassword;
    }
    public function validateAll()
    {
      if(validateName($this->name) && validateEmail($this->email) && validatePassword($this->password) && validatePhoneNumber($this->phone))
      {
        return true;
      }else
      {
        return false;
      }
    }
    public function insertUserData($conn)
    {
      // $name = trim(htmlspecialchars($this->name));
      // $email = trim(htmlspecialchars($this->email));
      // $phone = trim(htmlspecialchars($this->phone));
      // $password = trim(htmlspecialchars($this->password));

      $name = mysqli_real_escape_string($conn, $this->name);
      $email = mysqli_real_escape_string($conn, $this->email);
      $phone = mysqli_real_escape_string($conn, $this->phone);
      $password = mysqli_real_escape_string($conn, $this->password);

      $check_email_query ="SELECT email from users Where email='$email' ";
      $check_email_query_result =mysqli_query($conn, $check_email_query);

          if(mysqli_num_rows($check_email_query_result) > 0)
          {
            $_SESSION['message']= 'email already exists.';
            header("Location: ../register.php");
          }else
          {
              if ($this->password == $this->cpassword)
              {
                $password =password_hash($this->cpassword, PASSWORD_BCRYPT);
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
                header('location: ../login.php ');
              }
        } 
    }
    
}

class Login
{
    private $email;
    private $password;
    public function __construct($email, $password)
    {
      $this->email = $email;
      $this->password = $password;
    }
    public function authenticate($conn)
    {
      $email = mysqli_real_escape_string($conn, $this->email);
      $password = mysqli_real_escape_string($conn, $this->password);
      
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
        }
    }
}

$database =new Database();
$conn = $database->getConnecrion();


if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = trim(htmlspecialchars($_POST["email"]));
    $phone = trim(htmlspecialchars($_POST["phone"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    $cpassword = trim(htmlspecialchars($_POST["cpassword"]));
    
    $user = new User($name,$email,$phone,$password,$cpassword);
    if($user->validateAll())
    {
      $user->insertUserData($conn);
    }else {
      echo $_SESSION['message'];
      header("Location: ../register.php");
      exit();
  }
        
}elseif(isset($_POST["login"]))
{
      $email = trim(htmlspecialchars($_POST["email"]));
      $password = trim(htmlspecialchars($_POST["password"]));
      $login = new Login($email,$password);
      $login->authenticate($conn);
}

$database->closeConnection();

?>