<?php
    include_once 'php/config.php';
    session_start();
    $id = $_POST['id'];


    
    $photo = $_FILES['photo'];
    $after_explode = explode('.' , $photo['name']);
    $extension = end($after_explode);
    $allowed_extension = array('jpg', 'png', 'gif');

    $select_user = "SELECT * FROM users WHERE id=$id";
    $select_user_res = mysqli_query($conn, $select_user);
    $after_assoc = mysqli_fetch_assoc($select_user_res);


    if($after_assoc['img'] == null){
        if(in_array($extension, $allowed_extension)){
            if($photo['size'] <= 1000000){
                $file_name = $id.'.'.$extension;
                $new_location = 'php/images/'.$file_name;
                move_uploaded_file($photo['tmp_name'], $new_location);
    
                $update = "UPDATE users SET photo='$file_name' WHERE id=$id";
                mysqli_query($db_connect, $update);
                $_SESSION['photo_success'] = 'Photo Updated';
                header("location:users.php");
                
            }
            else{
                $_SESSION['size'] = 'Maximum size 1MB';
                header("location:users.php");
            }
        }
        else{
            $_SESSION['extension'] = 'Photo Must be type of: jpg,png,gif';
            header("location:users.php");
        }
    }

    else{

        
        $delete_from = 'php/images/'.$after_assoc['img'];
        unlink($delete_from);

        if(in_array($extension, $allowed_extension)){
            if($photo['size'] <= 1000000){
                $file_name = $id.'.'.$extension;
                $new_location = 'php/images/'.$file_name;
                move_uploaded_file($photo['tmp_name'], $new_location);
    
                $update = "UPDATE users SET photo='$file_name' WHERE id=$id";
                mysqli_query($db_connect, $update);
                $_SESSION['photo_success'] = 'Photo Updated';
                header("location:users.php");
                
            }
            else{
                $_SESSION['size'] = 'Maximum size 1MB';
                header("location:users.php");
            }
        }
        else{
            $_SESSION['extension'] = 'Photo Must be type of: jpg,png,gif';
            header("location:users.php");
        }
    }
?>