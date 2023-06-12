<?php
include_once "handel.php";


    
function validateName($name) {
    if (!empty($name) && ctype_alpha(str_replace(' ', '', $name))) {
        return true;
    } else {
        $_SESSION['message'] = "Please enter a non-empty name without numeric characters.";
        return false;
    }
  }
    // validation email
    
function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       return true;
      }else {
        $_SESSION['message'] = "Please enter a valid email address.";
        header("Location: ../register.php");
        exit();
      }
}

function validatePassword($password){
    if(! is_string($password)){
        return "password is not valid";
        }
    else if(empty($password)){
        return "password is required";
    }
    else if(strlen($password)<6){
        return "password is min 5 char";
    }
    else{
        return true;
    }
}

?>