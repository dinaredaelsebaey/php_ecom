<?php
class User 
{ private $name ; private $email ; private $phone ; private $password ; private $cpassword ;
        public function __construct($name, $email, $phone, $password, $cpassword) { $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->cpassword = $cpassword;
    }
    public function validateAll()
    {
        if(validateName($this->name) && validateEmail($this->email) && validatePassword($this->password) &&
        validatePhoneNumber($this->phone))
        {
            return true;
        }else
        {
            return false;
        }
    }
    public function insertUserData($conn)
    {
        $name = mysqli_real_escape_string($conn, $this->name);
        $email = mysqli_real_escape_string($conn, $this->email);
        $phone = mysqli_real_escape_string($conn, $this->phone);
        $password = mysqli_real_escape_string($conn, $this->password);

        $checkEmailQuery ="SELECT email from users Where email='$email' ";
        $checkEmailQueryResult = mysqli_query($conn, $checkEmailQuery);

        if(mysqli_num_rows($checkEmailQueryResult) > 0)
        {
            $_SESSION['message']= 'email already exists.';
            header("Location: ../registerForm.php");
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
                    header("Location: ../loginForm.php");
                    exit();
                }else
                {
                    $_SESSION['message']= 'something wrong occure';
                    header("Location: ../registerForm.php");
                }
            }else
            {
                $_SESSION['message'] = "The password don't match.";
                header('location: ../RegisterForm.php ');
            }
        }
    }
}

?>