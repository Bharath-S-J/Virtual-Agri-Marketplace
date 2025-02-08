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
        <?php

    }else{  
    header("Location: index.php");    
      }
    ?>

    <div class='sign-in-up'>
    <form method="POST" action="../code.php">
          <button type="submit" class="login-btn" name="logout">LOG-OUT</button>
      </form>
    </div>

  </header>

  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

  <div class="wrapper">
    <div class="sidebar">
    
        <ul>
            <li><a href="profile.php">Profile</a></li>   
            <li><a href="edit_profile.php">Edit profile</a></li>
            <li><a href="change_password.php">Change password</a></li>
            <li><a >Sell products</a></li>
            <li><a href="your_products.php">Your products</a></li>
            <li><a href="order.php">Your Orders</a></li>

        </ul> 
       
    </div>

    <div class="main_content">
      <center>
      <div class="header"><h1>Sell Products.</h1></div> 
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

   <form action="../code.php" method="post" enctype="multipart/form-data">
      
      <div class="flex">
         
      
      <div class="inputBox1">
          <span>Select product type</span>
        <span>
        <select name="farm_type">
          <option value="fruit">Fruit</option>
          <option value="vegetable">Vegetable</option>
          <option value="dry_fruit">dry Fruit</option>
        </select>
        </span>
         
          <span>Enter product name  :</span>
            <input type="text"  name="name" id="name" class="box">
            <span>Unit type :</span>
            <span>
            <select name="unit_type">   
            <option value="kg">kg</option>
            <option value="set">Set</option>
            <option value="unit">Units</option>
            </select>
            </span>
            
            <span>total units :</span>
            <input type="number"  name="total_q" id="total_q" class="box">

            <span>price per units :</span>
            <input type="number"  name="price" id="price" class="box">
            
            <br><br><br>
            <button style='background-color: #00B5E2;  border: none; color: white; padding: 12px 24px;text-align: center;
              text-decoration: none; display: inline-block; font-size: 16px;  border-radius: 3px;cursor: pointer;' 
              type="submit" id='add_product' name="add_product" >SUBMIT</button>
              <br> 

         </div>

         <div class="inputBox1">
          <br><br><br>
          <span>Discription :</span>
          <textarea type="text" require name="discr" id="discr" class="box" style="width:500px; height: 200px;"></textarea>
          <br><br>
          <span>upload picture :</span>
            <input type="file" name="filename" accept="image/jpg, image/jpeg, image/png"
                id="filename"class="box">
            

         </div>
      </div>
   </form>

</div>




    </div>
  </div>

</body>
</html>