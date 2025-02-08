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
            <li><a href="profile.php">Edit profile</a></li>
            <li><a href="edit_profile.php">Edit profile</a></li>
            <li><a href="change_password.php">Change password</a></li>
            <li><a >Buy products</a></li>
            <li><a href="see_cart.php">Your Cart</a></li>
            <li><a href="order.php">Your Orders</a></li>

        </ul> 
        
    </div>

    <div class="main_content">
      <center>
      <div class="header"><h1>Buy Products.</h1></div> 
      </center>
      
      <form action="../code.php" style="padding-top: 10px; padding-bottom: 20px; padding-left: 30px; padding-right: 40px;" method="POST">

      <h5> select product Types</h5>
      <select name="farm_type" id="farm_type" >
          <option value="0">View All products</option>
          <option value="fruit">Fruit</option>
          <option value="vegetable">Vegetable</option>
          <option value="dry_fruit">Dry Fruit</option>
        </select>
          <br>
        <button type="submit" name="change_farm_type" id="change_farm_type" class="btn btn-info btn-sm">VIEW</button>
      </form>




      <center>
      <table border = "1" style="width:100%">
      <thead>
         <tr>
            <th>Image </th>
            <th>Name</th>
            <th>Unit type</th>
            <th>Total_units</th>
            <th>Price per units</th>
            <th>View</th>
            <th>Delete</th>   
         </tr>
         </thead>
         <?php

      $p_type = $_SESSION['farm_type'];
      if($p_type=='0'){
        $query = "SELECT * FROM product";
      $select = mysqli_query($con, $query);
      
      }else{
      $query = "SELECT * FROM product WHERE product_type='$p_type' ";
      $select = mysqli_query($con, $query);
      }
      if(mysqli_num_rows($select) > 0){
        foreach($select as $product){
       ?> 

         <tr>
            <td><?php echo '<img src="../product_images/'.$product['image'].'" height="200" width="200">';?></td>
            <td><?php echo  $product['p_name']; ?></td>
            <td><?php echo  $product['unit_type']; ?></td>
            <td><?php echo  $product['total_units']; ?></td>
            <td><?php echo  $product['price']; ?></td>

                 
              <td><form  action="../code.php" method="POST">
                
                <button type="submit" name="view_product_bt" id="view_product_bt" value="<?=$product['id'];?>" class="btn btn-info btn-sm">VIEW</button>
               </form></td>
               
               <td><form  action="../code.php" method="POST">
                <p>Enter Quantity</p>
                <input type="number" id=qty name=qty min='1'>
                <button type="submit" name="add_to_cart" id="add_to_cart" value="<?=$product['id'];?>" class="btn btn-info btn-sm">Add TO Cart</button>
               </form></td>
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