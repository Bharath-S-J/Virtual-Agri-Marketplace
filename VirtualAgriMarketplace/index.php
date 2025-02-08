<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/homepage.css">

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body >

<?php include('message.php'); ?>

  <header>
    <h2>Virtual Agri-Marketplace</h2>

    <?php
   if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
    if($_SESSION['profile']==1){
      if($_SESSION['type']=='farmer'){
        header("Location: farmer_files/profile.php");
                exit(0);
      }else{
        header("Location: buyer_files/profile.php");
                exit(0);
      }
    }else{
      header("Location: profile_complete.php");
      exit(0);
    }
    $name=$_SESSION['name'];
   echo"logged_in as 
   $name";
   ?>

   <div class='sign-in-up' >
    <form method="POST" action="code.php">
        <button type="submit" class="login-btn" name="logout">LOG-OUT</button>
      </form>
    </div>

    <?php
   }else{
    ?>
    <div class='sign-in-up'>
      <button type='button' onclick="popup('login-popup')">LOGIN</button>
      <button type='button' onclick="popup('register-popup')">REGISTER</button>
    </div>
    
    <?php
    }
  ?>
    
  </header>
  <img src="images/homepage.jpg" width=100% height=100%>

  <div class="popup-container" id="login-popup">
    <div class="popup">
      <form method="POST" action="code.php">
        <h2>
          <span>USER LOGIN</span>
          <button type="reset" onclick="popup('login-popup')">X</button>
        </h2>
        <input type="number" placeholder="Mobile Number" required name="phone">
        <input type="password" placeholder="Password" required name="password">
        <select name="type">
          <option value="farmer">Farmer</option>
          <option value="buyer">Buyer</option>
        </select>
        <button type="submit" class="login-btn" name="login">LOGIN</button>
      </form>
    </div>
  </div>

  <div class="popup-container" id="register-popup">
    <div class="register popup">
      <form method="POST" action="code.php">
        <h2>
          <span>USER REGISTER</span>
          <button type="reset" onclick="popup('register-popup')">X</button>
        </h2>
        <input type="text" placeholder="Full Name" required name="name">
        <input type="number"  placeholder="Mobile Number" required name="phone" >
        <input type="email" placeholder="E-mail" required name="email">
        <input type="password" placeholder="Password" required name="password">
        <select name="type">
          <option value="farmer">Farmer</option>
          <option value="buyer">Buyer</option>
        </select>
        <br>
        <button type="submit" class="register-btn" name="save_user">REGISTER</button>
      </form>
    </div>
  </div>

  <?php
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
    echo"<h1 style='text-align: center; margin-top: 200px'> WELLCOME TO THIS WEBSITE - $_SESSION[name] </h1>";
  }
  ?>


  <script>
    function popup(popup_name)
    {
      get_popup=document.getElementById(popup_name);
      if(get_popup.style.display=="flex")
      {
        get_popup.style.display="none";
      }
      else
      {
        get_popup.style.display="flex";
      }
    }



  </script>

</body>
</html>