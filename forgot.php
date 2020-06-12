<?php
session_start();
$con=mysqli_connect('localhost','root','','user');
$error='';
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
  
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
   $error .="<p>Invalid email address please type a valid email address!</p>";
   }else{
   $sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
   $results = mysqli_query($con,$sel_query);
   $row = mysqli_num_rows($results);
   if ($row==""){
   $error .= "<p>No user is registered with this email address!</p>";
   }
  }
  
   if($error!=""){
   echo "<div class='error'>".$error."</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
   }else{
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5(2418*2+$email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
// Insert Temp Table
mysqli_query($con,
"INSERT INTO `forgot` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");
 
$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="'.$_SERVER['HTTP_HOST'].'/lk/patner/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
'.$_SERVER['HTTP_HOST'].'/lk/patner/reset-password.php
?key='.$key.'&email='.$email.'&action=reset</a></p>'; 
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   
$output.='<p>Thanks,</p>';
$output.='<p>Lakshaya Travels Team</p>';
$body = $output; 
$subject = "Password Recovery - Lakshyatravel.com";
 
$email_to = $email;
$fromserver = "noreply@yourwebsite.com"; 
require 'PHPMailerAutoload.php';
require 'credential.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';// Enter your host here
$mail->SMTPAuth = true;
$mail->Username = EMAIL; // Enter your email here
$mail->Password = PASS; //Enter your password here
$mail->Port = 587;
$mail->IsHTML(true);
$mail->From = "noreply@yourwebsite.com";
$mail->FromName = "Lakshya Travels";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo "<div class='error'>
<p>An email has been sent to you with instructions on how to reset your password.</p>
</div><br /><br /><br />";
$_SESSION['echo']="<p>An email has been sent to you with instructions on how to reset your password.</p>";
header("location:forgot.php");
 }
   }
}else{
?>
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
      <?php if(isset($_SESSION['echo'])){echo $_SESSION['echo'];} ?>
       <div class="d-flex justify-content-center" style="margin-bottom: 20px;">
<form method="post" action="" name="reset"><br /><br />
<label><strong>Enter Your Email Address:</strong></label><br /><br />
<input type="email" name="email" placeholder="username@email.com" />
<br /><br />
<input type="submit" value="Reset Password"/>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>
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