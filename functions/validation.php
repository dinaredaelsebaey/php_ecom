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
    elseif(strlen($password)<3)
    {
        $_SESSION['message'] = "password is min 3 char";
        return false;
    }
    else
    {
        return true;
    }
}
function validatePhoneNumber($phoneNumber)
{
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    if (preg_match('/^[01][0-9]{10}$/', $phoneNumber)) {
        return true;
    } else {
        $_SESSION['message'] = "please enter phone number from 11 digit";
        return false;
    }
}

?>