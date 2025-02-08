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
  <link rel="stylesheet" href="css/homepage.css">
  <link rel="stylesheet" href="css/farmer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 
 <style>
		#errorMs {
			color: #a00;
		}
		.gallery img{
            width: 300px;
		}
    textarea {
    width: 400px;
    height: 80px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
    }
	</style>

</head>
    <body>
      <?php include('message.php'); ?>
      <header>
        <h2>Virtual Agri-Marketplace</h2>
    <?php
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
        $name=$_SESSION['name'];
        $type=$_SESSION['type'];
      echo"logged_in as  $name  [ $type ]";
    ?>

      <div class='sign-in-up'>
        <form method="POST" action="code.php">
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
      <div class="main_content">
        <body>
          <lable style='display: inline-block;
              margin-bottom: 8px; font-weight: bold;
              font-size: 25px;'> Complete Your Profile</lable>
          <p id="errorMs"></p>
          <form action="code.php"
              id="form" 
              method="post"
              enctype="multipart/form-data">

              <input type="file" name='filename' accept="image/jpg, image/jpeg, image/png"
                id="filename">
              <input type="submit" require name="img_submit"
                 id="img_submit" 
                 value="Upload">
                 <br><br>
              <?php
                if(isset($_SESSION['img'])){
                 ?><div class="gallery">
                      <img src="<?php echo($_SESSION['img']); ?>" id="preImg">
                   </div>
              <?php

               }else{
              ?>
                 <div class="gallery">
                    <img src="images/default-image.jpg" id="preImg">
                  </div>
                <?php
             }?>
              <br><br><br>
          </form>
          <form action="code.php" method="post" >

              <lable style='display: inline-block;
                  margin-bottom: 8px;
                font-weight: bold;'> Enter your address</lable>
                <br>
              <textarea name="address" require id="address" cols="50" rows="3"></textarea>
                <br>
             <button style='background-color: #00B5E2;
              border: none;color: white;padding: 12px 24px;text-align: center;  text-decoration: none; display: inline-block;
             font-size: 16px;border-radius: 3px;cursor: pointer;' 
             type="submit" class="login-btn" name="complete_pro">Submit</button>
          </form>
            <br>

          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </body>
      </div>
    </div>
  </body>
</html>