<?php
include_once "handel.php";

function validateName($name){
    if(!empty($name)){
        return true ;
    }
    else{
        echo "enter name plz";
    }

}
function validateEmail($email){
    if(empty($email)){
        return "email is required";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "The email address '$email' is not valid.";
        
      } else {
        echo "email ok ";
        
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