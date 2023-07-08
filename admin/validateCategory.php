<?php
include_once "handelCatogery.php";
function validate_name($name)
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

function validate_slug($slug)
{
    if (!empty($slug) && preg_match('/^[a-z0-9\-]+$/', $slug))
    {
        return true;
    } else
    {
        $_SESSION['message'] = "Please enter a non-empty slug with lowercase alphanumeric characters and hyphens only.";
        return false;
    }
}

function validate_description($description)
{
    if (!empty($description) && strlen($description) >= 10)
    {
        return true;
    } else
    {
        $_SESSION['message'] = "Please enter a non-empty description with at least 10 characters.";
        return false;
    }
}

function validate_image($image)
{
    //extract image details
    $img_name = $image['name'];
    $img_type = $image['type'];
    $img_tmp_name = $image['tmp_name'];
    $img_size = $image['size'];
    $img_error = $image['error'];
    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $extension_array = array('png', 'PNG', 'jpg', 'JPG');

    if ($img_error != 0)
    {
        $_SESSION['message'] = 'There was an error uploading the image.';
        return false;
        
    } elseif ($img_size > 2000000)
    {
        $_SESSION['message'] = 'Image size exceeds 2MB';
        return false;
        
    } elseif (!in_array($img_ext, $extension_array))
    {
        $_SESSION['message'] = 'Invalid file type. Image must be in PNG or JPG format.';
        return false;
        
    } else
    {
        //rename image to prevent override if 2 images have the same name
        $random_img_name = uniqid() . "." . $img_ext;
        //move image from temp to upload folder
        move_uploaded_file($img_tmp_name, "upload/$random_img_name");
        return $random_img_name;
    }
}


?>