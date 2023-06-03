<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }

$id = $_SESSION['unique_id'];
  $select = "SELECT * FROM users WHERE unique_id=$id";
  $select_result = mysqli_query($conn, $select);
  $after_assoc = mysqli_fetch_assoc($select_result);
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link rel="icon" type="image/x-icon" href="php/images/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Falyafrohu Chat App</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  
</head>




<body>
  <div class="wrapper">
    <section class="users">
      <header>
       <h3> Update Your Profile </h3>
      </header>
      
    
      <form action="profile_edit_post.php" method="post" enctype="multipart/form-data">
        <div class="mb-3 mt-4">
        <label class="label-control" >First Name</label>
        <input class="form-control" type="hidden" name="id" value="<?=$_SESSION['unique_id']?>">
        <input class="form-control" type="text" name="fname" value="<?=$after_assoc['fname']?>">
        </div>

        <div class="mb-3 mt-4">
        <label class="label-control" >Last Name</label>
        <input class="form-control" type="text" name="lname" value="<?=$after_assoc['lname']?>">
        </div>

        <div class="mb-3">
        <label class="label-control" >Email</label>
        <input class="form-control" type="email" name="email" value="<?=$after_assoc['email']?>">
        </div>

        <div class="mb-3">
        <label class="label-control" >Password</label>
        <input class="form-control" type="password" name="pass" >
        </div>


        <div class="mb-3 ">
        <label class="label-control" >Profile Photo</label>
        <input class="form-control" type="file" name="photo" value="">
        </div>
        <button class="btn btn-primary"> Update </button>
      </form>








    </section>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="javascript/users.js"></script>

</body>
</html>
