<?php
session_start();
require '../dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="../css/profile.css">
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/farmer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 

</head>
<body>

  <header>
    <h2>Virtual Agri-Marketplace</h2>

    <?php
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
        $name=$_SESSION['name'];
        $type=$_SESSION['type'];
      echo"logged_in as  $name  [ $type ]";
    ?>

    <div class='sign-in-up'>
    <form method="POST" action="../code.php">
          <button type="submit" class="login-btn" name="logout">LOG-OUT</button>
      </form>
    </div>
    <?php

    }else{
    header("Location: index.php");
    }
    ?>
  </header>

  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

  <div class="wrapper">
    <div class="sidebar">
    
        <ul>
            <li><a >Profile</a></li>   
            <li><a href="edit_profile.php">Edit profile</a></li>
            <li><a href="change_password.php">Change password</a></li>
            <li><a href="sell_products.php">Sell products</a></li>
            <li><a href="your_products.php">Your products</a></li>
            <li><a href="order.php">Your Orders</a></li>

        </ul> 
       
    </div>

    <div class="main_content">
      <center>
      <div class="header"><h1>Your Profile.</h1></div> 
      </center>

      <div class="update-profile">

   <?php
      $phone=$_SESSION['phone'];
      $query = "SELECT * FROM farmer WHERE mobile='$phone' ";
      $select = mysqli_query($con, $query);
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
    ?> 

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['profile_img'] == null){
            echo '<img src="../images/default-image.jpg">';
         }else{
            echo '<img src="../pro_img/'.$fetch['profile_img'].'">';
         }

      ?>
      <div class="flex">
         <div class="inputBox1">
            <span>User name :</span>
            <input type="text" readonly name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>Mobile number :</span>
            <input type="email" readonly name="update_email" value="<?php echo $fetch['mobile']; ?>" class="box">
            <span>Email :</span>
            <input type="email" readonly name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Address :</span>
            <textarea type="email" readonly name="update_email" class="box" > <?php echo $fetch['address']; ?> </textarea>

         </div>
      </div>
   </form>

</div>




    </div>
  </div>

</body>
</html>