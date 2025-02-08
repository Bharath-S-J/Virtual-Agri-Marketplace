<?php
session_start();
require 'dbcon.php';


if(isset($_POST['buy_orders'])){
    $buy_phone=$_SESSION['phone'];
    $query = "SELECT * FROM cart where mobile=$buy_phone";
    $fetch1 = mysqli_query($con, $query);
    $flag=0;

      if(mysqli_num_rows($fetch1) > 0){
        foreach($fetch1 as $cart_item){
            $p_id=$cart_item['p_id'];
            $query = "SELECT * FROM product where id=$p_id";
            $query_run = mysqli_query($con, $query);
            $fetch2=mysqli_fetch_assoc($query_run);

            $total_units=$fetch2['total_units'];
            $qty=$cart_item['qty'];
            if($total_units>=$qty){
                $seller_phone=$fetch2['mobile'];
                $buyer_phone=$buy_phone;
                $total_price=$qty*$fetch2['price'];

                $query = "SELECT * FROM farmer where mobile=$seller_phone";
                $query_run = mysqli_query($con, $query);
                $fetch3=mysqli_fetch_assoc($query_run);
                $seller_address= $fetch3['address'];

                $query = "SELECT * FROM buyer where mobile=$buyer_phone";
                $query_run = mysqli_query($con, $query);
                $fetch4=mysqli_fetch_assoc($query_run);
                $buyer_address= $fetch4['address'];
                
                $p_name=$fetch2['p_name'];
                $price=$fetch2['price'];
                $farm_type=$fetch2['product_type'];
                
                $query = "INSERT INTO orders (seller_phone,buyer_phone,p_id,p_name,qty,price,total_price,seller_address,buyer_address,farm_type) 
                VALUES ('$seller_phone','$buyer_phone','$p_id','$p_name','$qty','$price','$total_price','$seller_address','$buyer_address','$farm_type')";
                $query_run = mysqli_query($con, $query);

                
                $query = "UPDATE product SET  total_units=total_units-'$qty' WHERE id='$p_id' ";
                $queryrun=mysqli_query($con, $query);

                $cart_id=$cart_item['id'];
                $query = "DELETE FROM cart WHERE id='$cart_id' ";
                $query_run = mysqli_query($con, $query);

                $flag=1;
                

            }else{
                echo "<script> alert('available quantity is less than the order quantity');
                </script>";
            }
            
        }
      }
      if($flag==0){
      echo "<script> alert('No product in your cart');
      document.location.href = 'buyer_files/see_cart.php' 
      </script>";
      exit(0);
      }else{
        echo "<script> alert('Orders executed successfully');
      document.location.href = 'buyer_files/see_cart.php' 
      </script>";
      exit(0);
      }

}

if(isset($_POST['remove_from_cart'])){
    $cart_id = mysqli_real_escape_string($con, $_POST['remove_from_cart']);
    $query = "DELETE FROM cart WHERE id='$cart_id' ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
    echo "<script> alert('product deleted successfull');
    document.location.href = 'buyer_files/see_cart.php' 
    </script>";
    exit(0);
    }

}

if(isset($_POST['back_to_cart'])){
    echo "<script>document.location.href = 'buyer_files/see_cart.php' 
    </script>";
    exit(0);
}

if(isset($_POST['view_product_from_cart'])){
    $pid=mysqli_real_escape_string($con, $_POST['view_product_from_cart']);
    $_SESSION['pid']=$pid;
    echo "<script>document.location.href = 'buyer_files/view_product_from_cart.php' 
    </script>";
    exit(0);
}

if(isset($_POST['add_to_cart'])){
    $qty = mysqli_real_escape_string($con, $_POST['qty']);
    $pid=mysqli_real_escape_string($con, $_POST['add_to_cart']);

    if($qty==null){
    echo "<script> alert('Enter the quantity');
    document.location.href = 'buyer_files/buy_products.php' 
    </script>";
    exit(0);
    }else{
       
      $query = "SELECT * FROM product WHERE id='$pid' ";
      $select = mysqli_query($con, $query);
      if(mysqli_num_rows($select) > 0){
         $fetch1 = mysqli_fetch_assoc($select);
      }
        $phone=$_SESSION['phone'];
        $price=$fetch1['price'];
        $p_name=$fetch1['p_name'];
        $p_image=$fetch1['image'];
        $query = "INSERT INTO cart (p_id,mobile,qty,price,p_name,image) VALUES ('$pid','$phone','$qty','$price','$p_name','$p_image')";
        $query_run = mysqli_query($con, $query);

        echo "<script> alert('Added to cart');
    document.location.href = 'buyer_files/buy_products.php' 
    </script>";
    exit(0);
    }
}

if(isset($_POST['change_farm_type'])){
    $product_type = mysqli_real_escape_string($con, $_POST['farm_type']);
    $_SESSION['farm_type']=$product_type;
    echo "<script>
    document.location.href = 'buyer_files/buy_products.php' 
    </script>";
    exit(0);
}

if(isset($_POST['back_to_buy_products'])){
    echo "<script>document.location.href = 'buyer_files/buy_products.php' 
    </script>";
    exit(0);
}

if(isset($_POST['delete_product'])){
    $product_id = mysqli_real_escape_string($con, $_POST['delete_product']);
    $query = "DELETE FROM product WHERE id='$product_id' ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
    echo "<script> alert('product deleted successfull');
    document.location.href = 'farmer_files/your_products.php' 
    </script>";
    exit(0);
    }
}

if(isset($_POST['back_to_your_products'])){
    echo "<script>document.location.href = 'farmer_files/your_products.php' 
    </script>";
    exit(0);
}

if(isset($_POST['view_product_bt'])){
    $pid=mysqli_real_escape_string($con, $_POST['view_product_bt']);
    $_SESSION['pid']=$pid;
    $type=$_SESSION['type'];
    if($type=='farmer'){
    echo "<script>document.location.href = 'farmer_files/view_product.php' 
    </script>";
    exit(0);
    }else{
        echo "<script>document.location.href = 'buyer_files/view_product.php' 
        </script>";
        exit(0);
    }
}

if(isset($_POST['add_product'])){
    $product_type = mysqli_real_escape_string($con, $_POST['farm_type']);
    $p_name = mysqli_real_escape_string($con, $_POST['name']);
    $unit_type = mysqli_real_escape_string($con, $_POST['unit_type']);
    $total_units = mysqli_real_escape_string($con, $_POST['total_q']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $discription = mysqli_real_escape_string($con, $_POST['discr']);

    if($_FILES["filename"]["error"] == 4){
        echo"<script> alert('Image Does Not Exist');
        document.location.href = 'farmer_files/sell_products.php' </script>";
        exit(0);
      }else{
          $fileName = $_FILES["filename"]["name"];
          $fileSize = $_FILES["filename"]["size"];
          $tmpName = $_FILES["filename"]["tmp_name"];
    
           if($p_name==null||$total_units==null||$price==null||$discription==null){
              echo"<script>
                alert('Enter all the details');
               document.location.href = 'farmer_files/sell_products.php'
              </script>";
              exit(0);
           } else{
               $newImageName = uniqid();
                $newImageName .= '.png';
                move_uploaded_file($tmpName, 'product_images/' . $newImageName);

                $phone=$_SESSION['phone'];
                $query = "INSERT INTO product (mobile,product_type,p_name,unit_type,total_units,price,discription,image) VALUES ('$phone','$product_type','$p_name','$unit_type','$total_units','$price','$discription','$newImageName')";
                $query_run = mysqli_query($con, $query);
               
                echo"<script>
                alert('product uploded successfull');
               document.location.href = 'farmer_files/sell_products.php'
              </script>";
              exit(0);
  
             
              }
      }
       

}

if(isset($_POST['update_password'])){

    $old_password = mysqli_real_escape_string($con, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $conform_password = mysqli_real_escape_string($con, $_POST['conform_password']);

    $type=$_SESSION['type'];
    $phone=$_SESSION['phone'];
    $length=strlen($new_password);

    if( ($new_password!=$conform_password) || ($length < 6  )){

        if($_SESSION['type']=='farmer'){
            echo"<script>
          alert('Conform Password Not matched or it is less than 6 characters');
          document.location.href = './farmer_files/change_password.php'
            </script>";
            exit(0);
        }else {
            echo"<script>
            alert('Conform Password Not matched or it is less than 6 characters');
            document.location.href = './buyer_files/change_password.php'
              </script>";
              exit(0);
        }
    }else if($type=='farmer'){

        $query = "SELECT * FROM farmer where mobile=$phone";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run)==1){
            $result=mysqli_fetch_assoc($query_run);

            if(password_verify($old_password,$result['password'])){
                $encpassword=password_hash($new_password,PASSWORD_BCRYPT);
                $query = "UPDATE farmer SET  password='$encpassword', pass='$new_password' WHERE mobile='$phone' ";
                mysqli_query($con, $query);
          
                echo"<script>
              alert('Password Updated Sucessfull');
              document.location.href = './farmer_files/change_password.php'
                </script>";
                exit(0);
            }else{
                echo"<script>
              alert('Old password is Incorect');
              document.location.href = './farmer_files/change_password.php'
                </script>";
                exit(0);  
        }}
    }else{

        $query = "SELECT * FROM buyer where mobile=$phone";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run)==1){
            $result=mysqli_fetch_assoc($query_run);

            if(password_verify($old_password,$result['password'])){
                $encpassword=password_hash($new_password,PASSWORD_BCRYPT);
                $query = "UPDATE buyer SET  password='$encpassword', pass='$new_password' WHERE mobile='$phone' ";
                mysqli_query($con, $query);
                
                echo"<script>
                alert('Password Updated Sucessfull');
                document.location.href = './buyer_files/change_password.php'
                  </script>";
                  exit(0);
            
            } else{
                echo"<script>
                alert('Old password is Incorect');
                document.location.href = './buyer_files/change_password.php'
                  </script>";
                  exit(0);
            }
        }
    }

    
}

if(isset($_POST["update_img"])){
   
    if($_FILES["filename"]["error"] == 4){

        if($_SESSION['type']=='farmer'){
                        echo"<script>
                      alert('Image Does not Exits');
                      document.location.href = './farmer_files/edit_profile.php'
                        </script>";
                        exit(0);
                    }else {
                        echo"<script>
                        alert('Image Does not Exits');
                        document.location.href = './buyer_files/edit_profile.php'
                          </script>";
                          exit(0);
                    }

      }else{
          $fileName = $_FILES["filename"]["name"];
          $fileSize = $_FILES["filename"]["size"];
          $tmpName = $_FILES["filename"]["tmp_name"];
    
           if($fileSize > 1000000){
            if($_SESSION['type']=='farmer'){
                echo"<script>
              alert('Image size is More');
              document.location.href = './farmer_files/edit_profile.php'
                </script>";
                exit(0);
            }else {
                echo"<script>
                alert('Image size is More');
                document.location.href = './buyer_files/edit_profile.php'
                  </script>";
                  exit(0);
            }
           } else{
               $newImageName = uniqid();
                $newImageName .= '.png';
    
              move_uploaded_file($tmpName, 'pro_img/' . $newImageName);
  
              if($_SESSION['type']=='farmer'){
                   $phone = $_SESSION['phone'];
                  $query = "UPDATE farmer SET  profile_img='$newImageName' WHERE mobile='$phone' ";
                  $queryrun=mysqli_query($con, $query);
  
              }else {
                  $phone=$_SESSION['phone'];
                  $sql = "update buyer set  profile_img = '$newImageName' where mobile = '$phone'";
                  mysqli_query($con, $sql);
              }
  
              if($_SESSION['type']=='farmer'){
                echo"<script>
              alert('Image Upload Compleated');
              document.location.href = './farmer_files/edit_profile.php'
                </script>";
                exit(0);
            }else {
                echo"<script>
                alert('Image Upload Compleated');
                document.location.href = './buyer_files/edit_profile.php'
                  </script>";
                  exit(0);
            }
            
              }
      }
} 

if(isset($_POST["update_address"])){

    $value = mysqli_real_escape_string($con, $_POST['address']);
    if(strlen($value)==0){

        if($_SESSION['type']=='farmer'){
            echo"<script>
          alert('Please enter the New Address');
          document.location.href = './farmer_files/edit_profile.php'
            </script>";
            exit(0);
        }else {
            echo"<script>
            alert('Please enter the New Address');
            document.location.href = './buyer_files/edit_profile.php'
              </script>";
              exit(0);
        }

    }else{
        if($_SESSION['type']=='farmer'){
            $phone = $_SESSION['phone'];
           $query = "UPDATE farmer SET  address='$value' WHERE mobile='$phone' ";
           $queryrun=mysqli_query($con, $query);
        }else {
            $phone=$_SESSION['phone'];
                $sql = "UPDATE buyer SET  address='$value' where mobile = '$phone'";
                mysqli_query($con, $sql);
        }
    }

    if($_SESSION['type']=='farmer'){
        echo"<script>
      alert('Address Update Sucessfull');
      document.location.href = './farmer_files/edit_profile.php'
        </script>";
        exit(0);
    }else {
        echo"<script>
        alert('Address Update Sucessfull');
        document.location.href = './buyer_files/edit_profile.php'
          </script>";
          exit(0);
    }

}

if(isset($_POST["update_email"])){

    $value = mysqli_real_escape_string($con, $_POST['email']);
    if(strlen($value)==0){

        if($_SESSION['type']=='farmer'){
            echo"<script>
          alert('Please enter the New Email');
          document.location.href = './farmer_files/edit_profile.php'
            </script>";
            exit(0);
        }else {
            echo"<script>
            alert('Please enter the New Email');
            document.location.href = './buyer_files/edit_profile.php'
              </script>";
              exit(0);
        }

    }else{
        if($_SESSION['type']=='farmer'){
            $phone = $_SESSION['phone'];
           $query = "UPDATE farmer SET  email='$value' WHERE mobile='$phone' ";
           $queryrun=mysqli_query($con, $query);
        }else {
            $phone=$_SESSION['phone'];
                $sql = "UPDATE buyer SET  email='$value' where mobile = '$phone'";
                mysqli_query($con, $sql);
        }
    }

    if($_SESSION['type']=='farmer'){
        echo"<script>
      alert('Email Update Sucessfull');
      document.location.href = './farmer_files/edit_profile.php'
        </script>";
        exit(0);
    }else {
        echo"<script>
        alert('Email Update Sucessfull');
        document.location.href = './buyer_files/edit_profile.php'
          </script>";
          exit(0);
    }

}

if(isset($_POST["update_phone"])){
    $Nphone = mysqli_real_escape_string($con, $_POST['phone']);
    $type=$_SESSION['type'];

    if(strlen($Nphone)==10){
        
        if($type=='farmer'){
    
            $query = "SELECT * FROM farmer where mobile=$Nphone";
            $query_run = mysqli_query($con, $query);
    
            if(mysqli_num_rows($query_run) == 0){
                $phone = $_SESSION['phone'];
                $query = "UPDATE farmer SET  mobile='$Nphone' WHERE mobile= '$phone' ";
                $queryrun=mysqli_query($con, $query);

                $_SESSION['phone']=$Nphone;
                if($_SESSION['type']=='farmer'){
                    echo"<script>
                  alert('Mobile number Update Sucessfull');
                  document.location.href = './farmer_files/edit_profile.php'
                    </script>";
                    exit(0);
            }else{
                echo"<script>
                alert('Mobile number Already registered');
                document.location.href = './buyer_files/edit_profile.php'
                  </script>";
                  exit(0);
            }
        }else{
            
            $query = "SELECT * FROM buyer where mobile=$Nphone";
            $query_run = mysqli_query($con, $query);
    
            if(mysqli_num_rows($query_run) == 0){
                $phone = $_SESSION['phone'];
                $query = "UPDATE buyer SET  mobile='$Nphone' WHERE mobile= '$phone' ";
                $queryrun=mysqli_query($con, $query);
                $_SESSION['phone']=$Nphone;
                if($_SESSION['type']=='farmer'){
                    echo"<script>
                  alert('Mobile number Update Sucessfull');
                  document.location.href = './farmer_files/edit_profile.php'
                    </script>";
                    exit(0);
            }else{
                echo"<script>
                alert('Mobile number Already registered');
                document.location.href = './buyer_files/edit_profile.php'
                  </script>";
                  exit(0);
            }
        }
    }
    
    }}if($_SESSION['type']=='farmer'){
    echo"<script>
      alert('Enter Mobile number ');
      document.location.href = './farmer_files/edit_profile.php'
        </script>";
        exit(0);
    }else{
    echo"<script>
    alert('Enter Mobile number ');
    document.location.href = './buyer_files/edit_profile.php'
      </script>";
      exit(0);

  }
}

if(isset($_POST["update_name"])){
    $value = mysqli_real_escape_string($con, $_POST['name']);
    if(strlen($value)==0){

        if($_SESSION['type']=='farmer'){
            echo"<script>
          alert('Please enter the New User Name');
          document.location.href = './farmer_files/edit_profile.php'
            </script>";
            exit(0);
        }else {
            echo"<script>
            alert('Please enter the New User Name');
            document.location.href = './buyer_files/edit_profile.php'
              </script>";
              exit(0);
        }

    }else{
        if($_SESSION['type']=='farmer'){
            $phone = $_SESSION['phone'];
           $query = "UPDATE farmer SET  name='$value' WHERE mobile='$phone' ";
           $queryrun=mysqli_query($con, $query);
        }else {
            $phone=$_SESSION['phone'];
                $sql = "UPDATE buyer SET  name='$value' where mobile = '$phone'";
                mysqli_query($con, $sql);
        }
    }

    if($_SESSION['type']=='farmer'){
        echo"<script>
      alert('User Name Update Sucessfull');
      document.location.href = './farmer_files/edit_profile.php'
        </script>";
        exit(0);
    }else {
        echo"<script>
        alert('User Name Update Sucessfull');
        document.location.href = './buyer_files/edit_profile.php'
          </script>";
          exit(0);
    }

    
}

if(isset($_POST["img_submit"])){

    if($_FILES["filename"]["error"] == 4){
      echo"<script> alert('Image Does Not Exist');
      document.location.href = 'profile_complete.php' </script>";
      exit(0);
    }else{
        $fileName = $_FILES["filename"]["name"];
        $fileSize = $_FILES["filename"]["size"];
        $tmpName = $_FILES["filename"]["tmp_name"];
  
         if($fileSize > 1000000){
            echo"<script>
              alert('Image Size Is Too Large');
             document.location.href = 'profile_complete.php'
            </script>";
            exit(0);
         } else{
             $newImageName = uniqid();
              $newImageName .= '.png';
  
            move_uploaded_file($tmpName, 'pro_img/' . $newImageName);

            if($_SESSION['type']=='farmer'){
                 $phone = $_SESSION['phone'];
                $query = "UPDATE farmer SET  profile_img='$newImageName' WHERE mobile='$phone' ";
                $queryrun=mysqli_query($con, $query);

            }else {
                $phone=$_SESSION['phone'];
                $sql = "update buyer set  profile_img = '$newImageName' where mobile = '$phone'";
                mysqli_query($con, $sql);
            }

            $_SESSION['img']="pro_img/".$newImageName;
            header("Location: profile_complete.php");
            exit(0);
            }
    }
}

if(isset($_POST['complete_pro'])){
    $address = mysqli_real_escape_string($con, $_POST['address']);
    if(strlen($address)==0){
        echo"<script>
          alert('Please enter the address');
          document.location.href = 'profile_complete.php'
            </script>";
            exit(0);
    }else{
        if($_SESSION['type']=='farmer'){
            $phone = $_SESSION['phone'];
           $query = "UPDATE farmer SET  address='$address', profile=1 WHERE mobile='$phone' ";
           $queryrun=mysqli_query($con, $query);
        }else {
            $phone=$_SESSION['phone'];
                $sql = "UPDATE buyer SET  address='$address', profile=1 where mobile = '$phone'";
                mysqli_query($con, $sql);
        }
    }

    $_SESSION['profile']='1';
    echo" <script>
          alert('Your profile Compleated');
          document.location.href = 'index.php'
        </script> ";
        exit(0);

}

if(isset($_POST['logout'])){
    $_SESSION['logged_in'] = false;
	session_unset();
	session_destroy();
    header("Location: index.php");
                exit(0);

}

if(isset($_POST['login'])){
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $type = mysqli_real_escape_string($con, $_POST['type']);

    if($type=='farmer'){

        $query = "SELECT * FROM farmer where mobile=$phone";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run)==1){
            $result=mysqli_fetch_assoc($query_run);

            if(password_verify($password,$result['password'])){
                $_SESSION['message'] = "Your Login Success";
                $_SESSION['logged_in']=true;
                $_SESSION['name']=$result['name'];
                $_SESSION['phone']=$phone;
                $_SESSION['type']=$type;
                $_SESSION['profile']=$result['profile'];
                header("Location: index.php");
                exit(0);

                
            }else{
            $_SESSION['message'] = "Your Details are Incorrect";
        header("Location: index.php");
               }   exit(0);
    }
    else
    {
        $_SESSION['message'] = "Your Details are Incorrect";
        header("Location: index.php");
        exit(0);
    }
    
    }else{

        $query = "SELECT * FROM buyer where mobile=$phone";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run)==1){
            $result=mysqli_fetch_assoc($query_run);

            if(password_verify($password,$result['password'])){
                $_SESSION['message'] = "Your Login Success";
                $_SESSION['logged_in']=true;
                $_SESSION['name']=$result['name'];
                $_SESSION['phone']=$phone;
                $_SESSION['type']=$type;
                $_SESSION['profile']=$result['profile'];
                $_SESSION['farm_type']="0";

                header("Location: index.php");
                exit(0);

                
            }else{
                $_SESSION['message'] = "Your Details are Incorrect";
            header("Location: index.php");
                   } 
            }
            else
            {
                $_SESSION['message'] = "Your Details are Incorrect";
                header("Location: index.php");
                exit(0);
            }
 }
}

if(isset($_POST['save_user'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $type = mysqli_real_escape_string($con, $_POST['type']);

    if(strlen($phone)==10){

    if($type=='farmer'){

        $query = "SELECT * FROM farmer where mobile=$phone";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) == 0){
            $password=password_hash($pass,PASSWORD_BCRYPT);
            $query = "INSERT INTO farmer (name,email,mobile,password,pass) VALUES ('$name','$email','$phone','$password','$pass')";
            $query_run = mysqli_query($con, $query);
            $_SESSION['message'] = "Your registration Successfully";
            header("Location: index.php");
            exit(0);
            }
            else
            {
                $_SESSION['message'] = "Your Mobile Number already exits";
                header("Location: index.php");
                exit(0);
            }
    }else{

        $query = "SELECT * FROM buyer where mobile=$phone";
        $query_run = mysqli_query($con, $query);
        if(mysqli_num_rows($query_run) == 0)
        {
            $password=password_hash($pass,PASSWORD_BCRYPT);
            $query = "INSERT INTO buyer (name,email,mobile,password,pass) VALUES ('$name','$email','$phone','$password','$pass')";
            $query_run = mysqli_query($con, $query);
            $_SESSION['message'] = "Your registration Successfully";
            header("Location: index.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Your Mobile Number already exits";
            header("Location: index.php");
            exit(0);
        }
    }
 }
}

?>
