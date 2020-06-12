<!DOCTYPE html>

<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>Login</title>
   <link rel="stylesheet" type="text/css" href="./style.css">
   <link rel="stylesheet" href="./home_files/bootstrap.min.css" >
   <link rel="stylesheet" type="text/css" href="./home_files/Home.css">
   <link rel="stylesheet" href="./home_files/w3.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <style type="text/css">
      .n{
      padding-top: inherit;
      margin-top: 50px;
   }

@media only screen and (max-width: 1000px) {
   .t{
               width: 120%;
            }
            .n{
               margin-top: 0px;
            }
}
   </style>
</head>
<body>
   <div class="tab1">
      <div class="row">
         <div class="column-331">
            <a href="/lk/index.php"><img class="t" src="./home_files/Lakshya-logo.png"></a>
         </div>
         <div class="column-661">
            <h1><big><b>Lakshya Tours &amp; Travels</b></big></h1><b>
               <h4>Travels Company</h4>
         </b></div><b>
      </b></div><b>
   </b></div><b>
   <nav class="navbar navbar-expand-lg navbar-dark">
     <a class="navbar-brand nav-link" href="/lk/home.html"><img src="./Tour packages_files/Lakshya-logo.png" width="90" height="30" alt=""></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mr-auto">
         <li class="nav-item active">
           <a class="nav-link" href="/lk/patner/home.php">Home<span class="sr-only">(current)</span></a>
         </li>
         
         <li class="nav-item active">
           <a class="nav-link" href="./login.php">Login<span class="sr-only">(current)</span></a>
         </li>
         <li class="nav-item active">
           <a class="nav-link" href="./registration.php">Signup<span class="sr-only">(current)</span></a>
         </li>
       </ul>
     </div>
   </nav>
   <div class="tab">
      <div class="d-flex justify-content-center">
          <header>
             <h1><big>Forgot Password</big></h1>
         </header>
      </div>
       <div class="d-flex justify-content-center" style="margin-bottom: 20px;">
<?php
$con=mysqli_connect('localhost','root','','user');
$error='';
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
 
  $query = mysqli_query($con,
  "SELECT * FROM `forgot` WHERE `key`='".$key."' and `email`='".$email."';"
  );
  $row = mysqli_num_rows($query);
  if ($row==""){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is 
deactivated.</p>
<p><a href="https://www.allphptricks.com/forgot-password/index.php">
Click here</a> to reset password.</p>';
 }else{
  $row = mysqli_fetch_assoc($query);
  $expDate = $row['expDate'];
  if ($expDate >= $curDate){
  ?>
  
  
  <form method="post" action="" name="update">
  <input type="hidden" name="action" value="update" />
  <br /><br />
  <label><strong>Enter New Password:</strong></label><br />
  <input type="password" name="pass1" maxlength="15" required />
  <br /><br />
  <label><strong>Re-Enter New Password:</strong></label><br />
  <input type="password" name="pass2" maxlength="15" required/>
  <br /><br />
  <input type="hidden" name="email" value="<?php echo $email;?>"/>
  <input type="submit" value="Reset Password" />
  </form>
  
<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
      }
if($error!=""){
  echo "<div class='error'>".$error."</div><br />";
  } 
} // isset email key validate end
 
 
if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
$error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
  }
  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{
$pass1 = md5($pass1);
mysqli_query($con,
"UPDATE `users` SET `password`='".$pass1."' 
WHERE `email`='".$email."';"
);
 if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
   
    
mysqli_query($con,"DELETE FROM `forgot` WHERE `email`='".$email."';");
 
echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="/login.php">
Click here</a> to Login.</p></div><br />';
   } 
}
?>
</div>
</div>
<footer class="w3-container  w3-center w3-xlarge ">
      <div class="row">
         <div class="column">
            <a href="/home.php"><img class="t" src="./home_files/Lakshya-logo.png" ></a>
         </div>
         <div class="column">
           <a class="btn n" href="#"><i class="fa fa-facebook-official"></i></a>
           <a class="btn n" href="#"><i class="fa fa-google"></i></a>
           <a class="btn n" href="#"><i class="fa fa-instagram"></i></a>
           
           <p class="w3-medium">
           Powered by <a href="/home.php" target="_blank">Lakshya Travel</a>
           </p>
         </div>
      </div>
   </footer>
   
   <script src="./home_files/jquery.min.js.download"></script>
   <script src="./home_files/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="./home_files/popper.min.js.download" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="./home_files/bootstrap.min.js.download" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>