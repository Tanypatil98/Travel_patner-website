<?php
	session_start();	 
	$email=$password=$echo1=$echo2=$echo3=$fname='';
	$errors=array();
	$db=mysqli_connect('localhost','root','','user');

	if(isset($_POST['login'])){
		$email=mysqli_real_escape_string($db,$_POST['email']);
		$password=mysqli_real_escape_string($db,$_POST['password']);

	if (empty($_POST['email'])) {
		$echo1= "<div class='form'><p>Please enter Email</p></div>";
	}
	if (empty($_POST['password'])) {
		$echo2= "<div class='form'><p>Please enter Password</p></div>";
	}
	if (empty($_POST['email']) AND empty($_POST['password'])) {
		$echo3= "<div class='form'><p>Please enter Password</p></div>";
	}
}
	if (count($errors)==0) {
		$passe=md5($password);
		
		$sqll="SELECT Email,Password FROM users WHERE Email='$email' AND Password='$passe'";
		$result= mysqli_query($db,$sqll);
		
		 if(mysqli_num_rows($result)== 1){
			$_SESSION["email"]=$email;
			$_SESSION["password"]=$password;
			if(!empty($_SESSION["email"]) and !empty($_SESSION["password"])){

				header("location:home.php");
			}
		}//else{
				
				//echo "<div class='form'><p>Username and password are wrong</p></div>";
			//}
			/*if($row=mysqli_fetch_assoc($result) == 0){
				if ($email != $row1["Email"] and $passe != $row1["Password"]) {
				
				$pass=md5($password);
				$sql="INSERT INTO User(Email,Password) Values('$email','$pass')";
				mysqli_query($db,$sql);
				$_SESSION["email"]=$email;
				$_SESSION["password"]=$password;
				if(!empty($_SESSION["email"]) and !empty($_SESSION["password"])){

				header("location:home.php");
			}
			
			}
		
	}*/

}
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
			    <h1><big>Login users</big></h1>
			</header>
		</div>

	<div class="form">
	 <form action="login.php"  method="post">
	 	<div class="input-group">
	 	<label>Username:</label>
	 	<input type="email" name="email" placeholder="jon@gmail.com"><?php echo $echo1; ?><br>
	 	</div>
	 	<div class="input-group">
	 	<label>Password:</label>
	 	<input type="password" name="password"><?php echo $echo2; ?><br>
	 	</div>
	 	<input type="submit"  name="login" value="Login"><br>
	 	<?php echo $echo3; ?>
	 	<p>You not yet <a href="./registration.php" style="color: blue;">Register?</a></p>
	 	<p><a href="./forgot.php" style="color: blue;">Forgot Password</a></p>
	 </form>
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