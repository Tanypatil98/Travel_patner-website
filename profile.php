<?php 
	session_start();
	if (!isset($_SESSION["email"])) {
		header("location:login.php");
	}
	if(isset($_GET['logout'])){
		//session_start();
		unset($_SESSION["fname"]);
		unset($_SESSION["email"]);
		unset($_SESSION["cname"]);
		session_destroy();
		header("location:login.php");
	}
	$f=$l=$c='';
	$db=mysqli_connect('localhost','root','','user');
	$email=$_SESSION['email'];
	 $sql="SELECT * FROM users WHERE Email='$email'";
		$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_assoc($result);
			$c=$row['Cname'];
			$f=$row['Firstname'];
			$l=$row['Lastname'];
	$fname=$lname=$cname=$mob=$em='';
	$e1=$e2=$e3=$e4=$e5=$e6=$e7='';
	$error=array();
	if (isset($_POST['save'])) {
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		
		$cname=$_POST['cname'];
		$mob=$_POST['mob'];
		$em=$_POST['email'];
		$time = strtotime($_POST['dob']);
		
		if ($time) {
		  $new_date = date('Y-m-d', $time);
		  
		} else {
		   echo 'Invalid Date: ' . $_POST['dateFrom'];
		  // fix it.
		}
		if (empty($fname)) {
			array_push($error, "Please enter the firstname");
			$e1="<p style='color: red'>Please enter the firstname.</p>";
		}
		if (empty($lname)) {
			array_push($error, "Please enter the lastname");
			$e2="<p style='color: red'>Please enter the lastname.</p>";
		}
		if (empty($dob)) {
			array_push($error, "Please enter the D.O.B.");
			$e3="<p style='color: red'>Please enter the D.O.B.</p>";
		}
		if (empty($mob)) {
			array_push($error, "Please enter the mobile no.");
			$e4="<p style='color: red'>Please enter the mobile no.</p>";
		}
		if (empty($em)) {
			array_push($error, "Please enter the email");
			$e5="<p style='color: red'>Please enter the email.</p>";
		}
		if (empty($cname)) {
			array_push($error, "Please enter the company name");
			$e7="<p style='color: red'>Please enter the company name.</p>";
		}
		if (count($error) > 0) {
			$sql="INSERT INTO profile(Firstname,Lastname,Dob,Cname,Mob,Email) VALUES ('$fname','$lname','$new_date','$cname','$mob','$em')";
			mysqli_query($db,$sql);
			$e6="<p style='color: green'>Profile Update Successfully.</p>";
			$sql1="UPDATE users SET Firstname='$fname',Lastname='$lname',Email='$em',Cname='$cname'";
			mysqli_query($db,$sql1);
		}
	}
	$e8=$e9=$e10=$e11=$npass=$cpass='';
	$errors=array();
	if (isset($_POST['generate'])) {
		$npass=$_POST['newpass'];
		$cpass=$_POST['conpass'];
		if (empty($npass)) {
			array_push($errors, "Please enter the New password.");
			$e8="<p style='color: red'>Please enter the  New password.</p>";
		}
		if (empty($cpass)) {
			array_push($errors, "Please enter the Confirm password.");
			$e9="<p style='color: red'>Please enter the Confirm password.</p>";
		}
		if ($npass != $cpass) {
			array_push($errors, "Please enter the correct password.");
			$e10="<p style='color: red'>Please enter the correct password.</p>";
		}
		if (count($errors) > 0) {
			$pass=md5($npass);
			$sql="UPDATE users SET Password='$pass' WHERE Email='$em'";
			mysqli_query($db,$sql);
			$e11="<p style='color: green'>Password Update Successfully.</p>";
		}
	}
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Profile</title>
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
table{
	margin-top: 20px;
}
th{
	width: 2%;
}
.panel{
	margin: 10px 50px 20px 50px;
}
label{
	width: 30%;
}
.form{
	width: 1000px;
}
@media only screen and (max-width: 1000px) {
	.t{
					width: 120%;
				}
				.n{
					margin-top: 0px;
				}
				.panel{
					margin: inherit;
				}
				.form{
					width: 250px;
				}
}
	</style>
<body>
	<div class="tab1">
		<div class="row">
			<div class="column-331">
				<a href="/home.html"><img class="t" src="./home_files/Lakshya-logo.png"></a>
			</div>
			<div class="column-661">
				<h1><big><b>Lakshya Tours &amp; Travels</b></big></h1><b>
					<h4>Travels Company</h4>
			</b></div><b>
		</b></div><b>
	</b></div><b>
	<nav class="navbar navbar-expand-lg navbar-dark">
	  <a class="navbar-brand" href="/home.html"><img src="./home_files/Lakshya-logo.png" width="90" height="30" alt=""></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="./home.php">Home<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="./boarding.php">Boarding<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Bus
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="./bus.php">Add Bus</a>
	          <a class="dropdown-item" href="./Confirm.php">Set Seat</a>
	        </div>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="./profile.php"><?php
    $email=$_SESSION["email"];
    $db=mysqli_connect('localhost','root','','user');
    $sqll="SELECT Firstname FROM users WHERE Email='$email'";
    $result= mysqli_query($db,$sqll);
    if($row=mysqli_fetch_row($result)){
      print_r($row[0]);
    }?><span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="home.php?logout='1'">Logout<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	  </div>
	</nav>
<div class="tab">
		<div class="d-flex justify-content-center">
		    <header >
			    <h1>Profile</h1>
			</header>
		</div>
		<div class="panel panel-primary">
		  <div class="panel-heading">Profile Edit</div>
		  <div class="panel-body">
		  	<div class="form text-center">
		  		<?php echo $e6; ?>
		  	<form action="" method="post">
		  		<label>First name:</label>
		  		<input type="text" name="fname" value=<?php echo $f; ?>><?php echo $e1; ?><br>
		  		<label>Last name:</label>
		  		<input type="text" name="lname" value=<?php echo $l; ?>><?php echo $e2; ?><br>
		  		<label>Date of Birth:</label>
		  		<input type="date" name="dob"><?php echo $e3; ?><br>
		  		<label>Company Name:</label>
		  		<input type="text" name="cname" value=<?php echo $c; ?>><?php echo $e7; ?><br>
		  		<label>Mobile No.:</label>
		  		<input type="text" name="mob"><?php echo $e4; ?><br>
		  		<label>Email :</label>
		  		<input type="email" name="email" value=<?php echo $email; ?>><?php echo $e5; ?><br>
		  		<input type="submit" name="save" value="Save">
		  	</form></div>
		  </div>
		</div>
		<div class="panel panel-success">
		  <div class="panel-heading">Regenerate Password</div>
		  <div class="panel-body">
		  	<div class="form text-center">
		  		<?php echo $e11; ?>
		  	<form action="profile.php" method="post">
		  		<label>New Password:</label>
		  		<input type="password" name="newpass"><?php echo $e8; ?><br>
		  		<label>Confirm Password:</label>
		  		<input type="text" name="conpass"><?php echo $e9; ?><br>
		  		<?php echo $e10; ?>
		  		<input type="submit" name="generate"  value="Generate">
		  	</form></div>
		  </div>
		</div>
	</div>
<footer class="w3-container  w3-center w3-xlarge ">
		<div class="row">
			<div class="column">
				<a href="/lk/patner/home.php"><img class="t" src="./home_files/Lakshya-logo.png" ></a>
			</div>
			<div class="column">
			  <a class="btn n" href="#"><i class="fa fa-facebook-official"></i></a>
			  <a class="btn n" href="#"><i class="fa fa-google"></i></a>
			  <a class="btn n" href="#"><i class="fa fa-instagram"></i></a>
			  
			  <p class="w3-medium">
			  Powered by <a href="/lk/patner/home.php" target="_blank">Lakshya Travel</a>
			  </p>
			</div>
		</div>
	</footer>
<script src="./home_files/jquery.min.js.download"></script>
	
	<script src="./home_files/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="./home_files/popper.min.js.download" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="./home_files/bootstrap.min.js.download" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>