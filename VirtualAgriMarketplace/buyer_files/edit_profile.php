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
        <li><a href="profile.php">Profile</a></li>   
            <li><a >Edit profile</a></li>
            <li><a href="change_password.php">Change password</a></li>
            <li><a href="buy_products.php">Buy products</a></li>
            <li><a href="see_cart.php">Your Cart</a></li>
            <li><a href="order.php">Your Orders</a></li>

        </ul> 
       
    </div>

    <div class="main_content">
      <center>
      <div class="header"><h1>Edit Profile.</h1></div> 
      </center>

      <div class="update-profile">

   <?php
      $phone=$_SESSION['phone'];
      $query = "SELECT * FROM buyer WHERE mobile='$phone' ";
      $select = mysqli_query($con, $query);
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
    ?> 

   <form  method="post"  action="../code.php " enctype="multipart/form-data">
      <?php
         if($fetch['profile_img'] == null){
            echo '<img src="../images/default-image.jpg">';
         }else{
            echo '<img src="../pro_img/'.$fetch['profile_img'].'">';
         }

      ?>
      <div class="flex">
         <div class="inputBox2">
            <span>Old User name :</span>
            <input type="text" readonly name="name" id="name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>Old Mobile number :</span>
            <input type="number" readonly name="phone" id="phone" value="<?php echo $fetch['mobile']; ?>" class="box">
            <span>Old Email :</span>
            <input type="email" readonly name="email" id="email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Old Address :</span>
            <textarea type="text" readonly name="address" id="address" class="box" > <?php echo $fetch['address']; ?> </textarea>

            <span>update your pic :</span>

            <input type="file" name="filename" accept="image/jpg, image/jpeg, image/png"
                id="filename"class="box">

         </div>

         <div class="inputBox2">
         <span>New User name :</span>
            <input type="text" require name="name"  class="box">
            <span>New Mobile number :</span>
            <input type="number" require name="phone"  class="box">
            <span>New Email :</span>
            <input type="email" require name="email"  class="box">
            <span>New Address :</span>
            <textarea type="text" require name="address" id="address" class="box" ></textarea>

            <br><br><br>
            <button style='background-color: #00B5E2;  border: none; color: white; padding: 12px 24px;text-align: center;
              text-decoration: none; display: inline-block; font-size: 16px;  border-radius: 3px;cursor: pointer;' 
              type="submit" id="update_img" name="update_img">Update</button>

          
    
         </div>
         <div class="inputBox2">
            <br><br><br>
            <button style='background-color: #00B5E2;  border: none; color: white; padding: 12px 24px;text-align: center;
              text-decoration: none; display: inline-block; font-size: 16px;  border-radius: 3px;cursor: pointer;' 
              type="submit" id="update_name" name="update_name">Update</button>

              <br><br><br>
            <button style='background-color: #00B5E2;  border: none; color: white; padding: 12px 24px;text-align: center;
              text-decoration: none; display: inline-block; font-size: 16px;  border-radius: 3px;cursor: pointer;' 
              type="submit" id='update_phone' name="update_phone">Update</button>

              <br><br><br>
            <button style='background-color: #00B5E2;  border: none; color: white; padding: 12px 24px;text-align: center;
              text-decoration: none; display: inline-block; font-size: 16px;  border-radius: 3px;cursor: pointer;' 
              type="submit" id='update_email' name="update_email">Update</button>

              <br><br><br>
            <button style='background-color: #00B5E2;  border: none; color: white; padding: 12px 24px;text-align: center;
              text-decoration: none; display: inline-block; font-size: 16px;  border-radius: 3px;cursor: pointer;' 
              type="submit" id='update_address' name="update_address">Update</button>
              <br>
    
         </div>

      </div>
   </form>

</div>

    </div>
  </div>

</body>
</html>