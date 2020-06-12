<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="./home_files/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="./home_files/Home.css">
	<link rel="stylesheet" href="./home_files/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		.n{
		padding-top: inherit;
		margin-top: 50px;
	}
	.form{
		width: 400px;
	}
	label{
		width: 150px;
	}
@media only screen and (max-width: 1000px) {
	.t{
					width: 120%;
				}
				.n{
					margin-top: 0px;
				}
				label{
					width: auto;
				}
}
	</style>
</head>
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
	  <a class="navbar-brand nav-link" href="/home.html"><img src="./Tour packages_files/Lakshya-logo.png" width="90" height="30" alt=""></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="/home.php">Home<span class="sr-only">(current)</span></a>
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
			    <h1><big>Register users</big></h1>
			</header>
		</div>
<?php
	session_start();
	$email=$password=$fname=$lname=$passwordc='';
	$echo1=$echo2=$echo3=$echo4=$echo5=$echo6='';
	$er='';
	$errors=array();

	$db=mysqli_connect('localhost','root','','user');

	if(isset($_POST['submit'])){
		$fname=mysqli_real_escape_string($db,$_POST['fname']);
		$lname=mysqli_real_escape_string($db,$_POST['lname']);
		$email=mysqli_real_escape_string($db,$_POST['email']);
		$cname=mysqli_real_escape_string($db,$_POST['cname']);
		$password=mysqli_real_escape_string($db,$_POST['password']);
		$passwordc=mysqli_real_escape_string($db,$_POST['passwordc']);

	if (empty($_POST['fname'])) {
		$echo1= "<div class='form'><p>Please enter Firstname</p></div>";
	}
	if (empty($_POST['lname'])) {
		$echo2= "<div class='form'><p>Please enter Lastname</p></div>";
	}
	if (empty($_POST['email'])) {
		$echo3= "<div class='form'><p>Please enter email</p></div>";
	}
	if (empty($_POST['cname'])) {
		$echo1= "<div class='form'><p>Please enter Company Name</p></div>";
	}
	if (empty($_POST['password'])) {
		$echo4= "<div class='form'><p>Please enter Password</p></div>";
	}
	if ($password != $passwordc) {
		$echo5= "<div class='form'><p>Password does not match</p></div>";
	}
	

	
	if (count($errors)==0) {
		$sqll="SELECT Email FROM users WHERE Email='$email'";
		$result= mysqli_query($db,$sqll);
		if(mysqli_num_rows($result)== 1){
				echo "<div class='form'><p>Please used another name & email</p></div>";
			

		}else{
			$cn=ucwords($cname);
			$pass=md5($password);
			$sql="INSERT INTO users(Firstname,Lastname,Email,Cname,Password) Values('$fname','$lname','$email','$cname','$pass')";
			mysqli_query($db,$sql);
			$_SESSION["email"]=$email;
			$_SESSION["fname"]=$fname;
			$_SESSION["cname"]=$cn;
			header('location:home.php');												
		}
	}
}

?>
	<div class="form">
	 
	 <form action="registration.php" name="myform" method="post">
	 	<label>Firstname:</label>
	 	<input type="text" name="fname" placeholder="Jhon" >
	 	<?php echo $echo1; ?><br>
	 	<label>Lastname:</label>
	 	<input type="text" name="lname" placeholder="Decosta"><?php echo $echo2; ?><br>
	 	<label>Email:</label>
	 	<input type="email" name="email" placeholder="ab@gmail.com" ><?php echo $echo3; ?><br>
	 	<label>Company Name:</label>
	 	<input type="text" name="cname"><br>
	 	<label>Password:</label>
	 	<input type="password" name="password" ><?php echo $echo4; ?><br>
	 	<label>Confirm Password:</label>
	 	<input type="password" name="passwordc" ><?php echo $echo5; ?><br>
	 	<input type="submit" name="submit" value="Register">
	 	<p>If already register  <a href="./login.php" style="color: blue;">login</a></p>
	 </form>
	</div>
</div>
<footer class="w3-container  w3-center w3-xlarge ">
		<div class="row">
			<div class="column">
				<a href="/home.html"><img class="t" src="./home_files/Lakshya-logo.png" ></a>
			</div>
			<div class="column">
			  <a class="btn n" href="#"><i class="fa fa-facebook-official"></i></a>
			  <a class="btn n" href="#"><i class="fa fa-google"></i></a>
			  <a class="btn n" href="#"><i class="fa fa-instagram"></i></a>
			 
			  <p class="w3-medium">
			  Powered by <a href="/home.html" target="_blank">Lakshya Travel</a>
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