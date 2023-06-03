<?php
    include_once 'php/config.php';
    session_start();

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $after_encrypt = md5($pass);



    if(!$pass){
        $update = "UPDATE users SET fname='$fname', lname='$lname', email='$email' WHERE unique_id='$id'";
        $update_result = mysqli_query($conn, $update);
        header('location:users.php');
    }
    else{
        $update = "UPDATE users SET fname='$fname', lname='$lname', email='$email',password='$after_encrypt' Where unique_id='$id' ";
        $update_result = mysqli_query($conn, $update);
        header('location:users.php');

    }



    $photo = $_FILES['photo'];
    $select_user = "SELECT * FROM users WHERE unique_id=$id";
    $select_user_res = mysqli_query($conn, $select_user);
    $after_assoc = mysqli_fetch_assoc($select_user_res);

    $after_explode = explode('.' , $photo['name']);
    $extension = end($after_explode);


    
    if(!$photo){
                

        $file_name = $id.'.'.$extension;
        $new_location = 'php/images/'.$file_name;
        move_uploaded_file($photo['tmp_name'], $new_location);

        $update = "UPDATE users SET img='$file_name' WHERE unique_id=$id";
        mysqli_query($conn, $update);
        $_SESSION['photo_success'] = 'Photo Updated';
        header("location:users.php");
      
       
    }
    else{
       
        $delete_from = 'php/images/'.$after_assoc['img'];
        unlink($delete_from); 
        
        $file_name = $id.'.'.$extension;
        $new_location = 'php/images/'.$file_name;
        move_uploaded_file($photo['tmp_name'], $new_location);

        $update = "UPDATE users SET img='$file_name' WHERE unique_id=$id";
        mysqli_query($conn, $update);
        $_SESSION['photo_success'] = 'Photo Updated';
        header("location:users.php");
    }







    // // second




    // if($after_assoc['img'] == null){
    //     if(in_array($extension, $allowed_extension)){
    //         if($photo['size'] <= 1000000){
    //             $file_name = $id.'.'.$extension;
    //             $new_location = 'php/images/'.$file_name;
    //             move_uploaded_file($photo['tmp_name'], $new_location);
    
    //             $update = "UPDATE users SET photo='$file_name' WHERE id=$id";
    //             mysqli_query($db_connect, $update);
    //             $_SESSION['photo_success'] = 'Photo Updated';
    //             header("location:users.php");
                
    //         }
    //         else{
    //             $_SESSION['size'] = 'Maximum size 1MB';
    //             header("location:users.php");
    //         }
    //     }
    //     else{
    //         $_SESSION['extension'] = 'Photo Must be type of: jpg,png,gif';
    //         header("location:users.php");
    //     }
    // }

    // else{

        
    //     $delete_from = 'php/images/'.$after_assoc['img'];
    //     unlink($delete_from);

    //     if(in_array($extension, $allowed_extension)){
    //         if($photo['size'] <= 1000000){
    //             $file_name = $id.'.'.$extension;
    //             $new_location = 'php/images/'.$file_name;
    //             move_uploaded_file($photo['tmp_name'], $new_location);
    
    //             $update = "UPDATE users SET photo='$file_name' WHERE id=$id";
    //             mysqli_query($db_connect, $update);
    //             $_SESSION['photo_success'] = 'Photo Updated';
    //             header("location:users.php");
                
    //         }
    //         else{
    //             $_SESSION['size'] = 'Maximum size 1MB';
    //             header("location:users.php");
    //         }
    //     }
    //     else{
    //         $_SESSION['extension'] = 'Photo Must be type of: jpg,png,gif';
    //         header("location:users.php");
    //     }
    // }

?>