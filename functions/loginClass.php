<?php 
class Login
{
    private $email; private $password;
    public function __construct($email, $password) 
    {
         $this->email =$email;
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
            //$is_admin = $row['is_admin'];
            $is_admin = isset($_POST['is_admin']) ? 1 : 0;

            //Check if the hashedpassword is matches entered password
            if(password_verify($password, $hashedPasswordFromDatabase))
            {
                $_SESSION['loggedin'] =true;
                // Set session variables
                $_SESSION['email']=$email;
                $_SESSION['name']=$name;
                $_SESSION['is_admin']= $is_admin;
                //if user is admin diect to dashboard
                if($_SESSION['is_admin'] == 1)
                {
                    $_SESSION['message']= 'welcome to dashboard.';
                    header("Location: ../admin/index.php");
                }
                else
                {
                    $_SESSION['message']= 'login successfully.';
                    header("Location: ../index.php");
                    exit();
                }
            }else
            {
                $_SESSION['message']= 'invalid password';
                header("Location: ../loginForm.php");
            }
        }
        else
        {
            $_SESSION['message']= 'email is not exist';
            header("Location: ../loginForm.php");
            exit();
        }
    }
}

    ?>