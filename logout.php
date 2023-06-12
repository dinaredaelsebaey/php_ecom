<?php
session_start();

if(isset($_SESSION['loggedin'])){
    unset($_SESSION['loggedin']);
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    //$_SESSION['message']="logout succesfully";
    
    
}
header('Location: index.php');


?>