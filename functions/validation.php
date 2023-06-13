<?php
include_once "handel.php";

function validateName($name)
{
    if (!empty($name) && ctype_alpha(str_replace(' ', '', $name)))
    {
        return true;
    } else
    {
        $_SESSION['message'] = "Please enter a non-empty name without numeric characters.";
        return false;
    }
}

function validateEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
       return true;
    }else 
    {
        $_SESSION['message'] = "Please enter a valid email address.";
        return false;
    }
}
function validatePassword($password)
{
    if(empty($password))
    {
        $_SESSION['message'] = "password is required";
        return false;
    }
    else if(strlen($password)<3)
    {
        $_SESSION['message'] = "password is min 3 char";
        return false;
    }
    else
    {
        return true;
    }
}

?>