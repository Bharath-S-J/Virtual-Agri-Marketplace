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
            <li><a href="buy_products.php">Sell products</a></li>
            <li><a href="see_cart.php">Your products</a></li>
            <li><a href="order.php">Your Orders</a></li>

        </ul> 
       
    </div>

    <div class="main_content">
      <center>
      <div class="header"><h1>Change Password.</h1></div> 
      </center>

      <div class="update-profile">

      <?php
    

    $phone=$_SESSION['phone'];
    $pid=$_SESSION['pid'];
    $query = "SELECT * FROM product WHERE id='$pid' ";
    $select = mysqli_query($con, $query);
    if(mysqli_num_rows($select) > 0){
      $fetch = mysqli_fetch_assoc($select);
     }

    ?>

   <form action="../code.php" method="post" enctype="multipart/form-data">
  <?php
   echo '<img src="../product_images/'.$fetch['image'].'">';
   ?>   
      <div class="flex">
 
      <div class="inputBox1">

      
          <span>Select product type</span>
          <input type="text"  value="<?php echo $fetch['product_type']; ?> "class="box" readonly>
         
          <span>Enter product name  :</span>
            <input type="text"  name="name" id="name" value="<?php echo $fetch['p_name']; ?> "class="box"readonly>
            <span>Unit type :</span>
            <input type="text"  value="<?php echo $fetch['unit_type']; ?> "class="box"readonly>
            
            <span>total units :</span>
            <input type="number"  name="total_q" id="total_q" value="<?php echo $fetch['total_units']; ?>" class="box" readonly>

            
            <br><br><br>
            <button style='background-color: #00B5E2;  border: none; color: white; padding: 12px 24px;text-align: center;
              text-decoration: none; display: inline-block; font-size: 16px;  border-radius: 3px;cursor: pointer;' 
              type="submit" id='back_to_buy_products' name="back_to_buy_products" onclick>BACK</button>
              <br> 

         </div>

         <div class="inputBox1">
         <span>price per units :</span>
            <input type="number"  name="price" id="price" value="<?php echo $fetch['price']; ?>" class="box" readonly>
            
          <br><br><br>
          <span>Discription :</span>
          <textarea readonly style="width:500px; height: 200px;" type="text" name="discr" id="discr" class="box"><?php echo $fetch['discription']; ?> </textarea>
          <br><br>

         </div>
      </div>
   </form>

</div>




    </div>
  </div>

</body>
</html>