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
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/farmer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 <style>
  th, td {
  padding-top: 10px;
  padding-bottom: 20px;
  padding-left: 30px;
  padding-right: 40px;
}
 </style>


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
            <li><a href="edit_profile.php">Edit profile</a></li>
            <li><a href="change_password.php">Change password</a></li>
            <li><a href="sell_products.php">Sell products</a></li>
            <li><a href="your_products.php">Your products</a></li>
            <li><a >Your Orders</a></li>

        </ul> 
        
    </div>

    <div class="main_content">
      <center>
      <div class="header"><h1>Your Orders.</h1> </div> 
      </center>
      
    

      <center>
      <table border = "1" style="width:100%">
      <thead>
         <tr>
            <th>Product Name </th>
            <th>Product Type</th>
            <th>Quantity</th>
            <th>Price per units</th>
            <th>Total Price</th>
            <th>Seller phone number</th>
            <th>Seller Address</th>
            <th>Buyer Phone number</th>
            <th>Buyer Address</th>   
         </tr>
         </thead>
         <?php

      $phone=$_SESSION['phone'];
      $query = "SELECT * FROM orders WHERE seller_phone='$phone' ";
      $select = mysqli_query($con, $query);
      
      if(mysqli_num_rows($select) > 0){
        foreach($select as $product){
       ?> 
         <tr>
           
            <td><?php echo  $product['p_name']; ?></td>
            <td><?php echo  $product['farm_type']; ?></td>
            <td><?php echo  $product['qty']; ?></td>
            <td><?php echo  $product['price']; ?></td>
            <td><?php echo  $product['total_price']; ?></td>
            <td><?php echo  $product['seller_phone']; ?></td>
            <td><?php echo  $product['seller_address']; ?></td>
            <td><?php echo  $product['buyer_phone']; ?></td>
            <td><?php echo  $product['buyer_address']; ?></td>

                 
         </tr>
        <?php
          } }
        else{
            echo "<h2> No Product Found </h2>";
            }
          
       ?>    
      </table> </center>


  </div>


</body>
</html>