<?php
if (isset($_SESSION['loggedin']))
{
    if ($_SESSION['is_admin'] != 1)
    {
        $_SESSION['message']= 'you are not authorized to access this page.';
        header("Location: ../index.php");
    }
}
else
{
    $_SESSION['message']= 'login to continue .';
    header("Location: ../login.php");
}

?>