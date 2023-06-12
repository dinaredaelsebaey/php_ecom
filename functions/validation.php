<?php
include_once "handel.php";


function validateName($name) {
    if (!empty($name) && strlen($name) >= 2) {
      
        return true;
        
    } elseif(!ctype_alpha($name)){
      
      $_SESSION['message'] = "Please enter string name .";
      return false;
    }
    else {
  
        $_SESSION['message'] = "Please enter a name with more than 2 characters.";
        return false;
    }
  }
    
    
function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "The email address '$email' is not valid.";
        header('location: register.php ');
      } else {
        return true;
        
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