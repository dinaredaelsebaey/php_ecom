<?php
include_once "handelCatogery.php";
function validateImage($image)
{              
    $img_name=$image['name'];
    $img_type=$image['type'];
    $img_tmp_name=$image['tmp_name'];
    $img_size=$image['size'];
    $img_error=$image['error'];
    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
     $extension_array = array('png','PNG', 'jpg','JPG');
    if( $img_size > 2000000){
        
        $_SESSION['message']= 'Image size exceeds 2MB';
        return false;
      }
      //error state
      elseif($img_error != 0){
        $_SESSION['message']= 'there is an error state';
        return false;
      }
      //type
      elseif (empty($img_name) && !in_array($img_ext, $extension_array)) {
        $_SESSION['message']= 'Image must be have extension png or jpg';
        return false;
      }else{
        
        // rename image to prevent overirde if 2 image have the same name
        $random_img_name = uniqid(). "." . $img_ext;
        return true ;
}
}

?>