<?php
session_start();


    if(isset($_POST['add_category_btn']))
    {
        $name = $_POST['name'] ;
        $slug = $_POST['slug'] ;
        $description = $_POST['description'] ;
        $meta_title = $_POST['meta_title'] ;
        $meta_description = $_POST['meta_description'] ;
        $meta_keywords = $_POST['meta_keywords'] ;
        $status = $_POST['status'] ;
        $popular = $_POST['popular'] ;
        $image=$_FILES['image'];
    }

?>