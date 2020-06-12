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
	$email=$_SESSION['email'];
	 $db=mysqli_connect('localhost','root','','user');
	 $sql="SELECT Cname FROM users WHERE Email='$email'";
		$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_assoc($result);
			$_SESSION['cname']=$row['Cname'];
			$cn=$row['Cname'];
			$echo1='';

	if(isset($_GET['date'])){
		$time = strtotime($_GET['date']);
		$num = $_GET['number'];
	if ($time) {
	  $new_date = date('Y-m-d', $time);
	  
	} else {
	   echo 'Invalid Date: ' . $_POST['dateFrom'];
	  // fix it.
	}
	$sql1="SELECT * FROM bus WHERE Bus_number='$num' AND CDate='$new_date' AND Name='$cn'";
		$result1=mysqli_query($db,$sql1);
		$re=mysqli_fetch_array($result1);
		
		if($re == 0 ){
			
		
		
		$echo1= "<div class='container'>
		 <div class='alert alert-danger'> Bus Not Available On This Date.</div>
		 </div>";
	}
		
	}
 
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Home</title>
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
			    <h1>Welcome to User <?php
    $email=$_SESSION["email"];
    $db=mysqli_connect('localhost','root','','user');
    $sqll="SELECT Firstname FROM users WHERE Email='$email'";
    $result= mysqli_query($db,$sqll);
    if($row=mysqli_fetch_row($result)){
      print_r($row[0]);
    }?></h1>
			</header>
		</div>
		<div class="d-flex text-center" style="margin-top: 20px;">
		    <header>
			    <h3>Customer List</h3>
			</header>
		</div>
		<div class="container">
			<?php echo $echo1; ?>
	<label>Bus no.:</label>
				<input type="text" name="number" list="brow" id="num" value=<?php 
				if (isset($_GET['number'])) {
				echo $_GET['number']; } ?> >
					<?php
					$email=$_SESSION['email'];
	 $db=mysqli_connect('localhost','root','','user');
	 $sql="SELECT Cname FROM users WHERE Email='$email'";
		$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_assoc($result);
			$_SESSION['cname']=$row['Cname'];
													$cname=$_SESSION['cname'];
													$db=mysqli_connect('localhost','root','','user');
													$sql="SELECT DISTINCT Bus_number FROM `bus` WHERE Name='$cname'";
													$result=mysqli_query($db,$sql);
													$re=mysqli_num_rows($result);
													$t=array();
													$a=array();
													for ($i=0; $i <$re ; $i++) { 
														$row=mysqli_fetch_array($result);
														
														$t[$i]=$row['Bus_number'];
													}
													
													foreach ($t as $key => $value) {
															$a[$key]= $value;
														}	
														?>
						    				
													
													<!-- On keyup calls the function everytime a key is released -->
														<datalist id="brow"> 
													<?php for ($i=0; $i < $re ; $i++) { ?>
														
													
														<option  value=<?php echo $a[$i]; ?>></option>
														<?php } ?>
														<!-- This data list will be edited through javascript     -->
														</datalist>
	<label>Date :</label>
	<input type="date" name="Date" value=<?php 
	if(isset($_GET['date'])){
	echo $new_date;} ?> >
<input type="button" name="print" class="print" value="Print" id="getUser">
</div>
		<div class="container">
<?php
	 echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Mobile</th>";
            echo "<th>Seat</th>";
            echo "<th>Date</th>";
            echo "<th>Bus Number</th>";
            
        echo "</tr>";
        $n=$b=$s=$d=$t=$l='';
        $db=mysqli_connect('localhost','root','','user');
 		$sql1="SELECT * FROM customer WHERE Cname='$cn'";
 		$result1=mysqli_query($db,$sql1);
 		$re=mysqli_num_rows($result1);
        while ($row = mysqli_fetch_assoc($result1)){
 
           $n=$row['Name'];
           $b=$row['Bus_number'];
           $s=$row['Seat'];
           $d=$row['Cdate'];
           $t=$row['Mob'];
 
            echo "<tr>";
               
                echo "<td>".$row['Name']."</td>";
                echo "<td>".$row['Mob']."</td>";
                echo "<td>".$row['Seat']."</td>";
                echo "<td>".$row['Cdate']."</td>";
                echo "<td>".$row['Bus_number']."</td>";
                
                
 
            echo "</tr>";
 
        }
        $l=$b;
        $_SESSION["bus"]=$b;
         $_SESSION["date"]=$d;
 		$_SESSION["seat"]=$s;
    echo "</table>";
 		if ($re == 0) {
 			echo "<div class='container'>";
    echo "<div class='alert alert-danger'>No Result found.</div>";
    echo "</div>";
 		}
?>
</div>


<div id="userInfo" style="display: none;"></div>
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
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script type="text/javascript">
	
	$(document).ready(function(){
    $('#getUser').on('click',function(){
    	<?php if(isset($_GET['date'])) { ?>
        var userID = '<?php echo $new_date; ?>';
        var num = '<?php echo $num; ?>';
        $('#userInfo').load('getData.php?id='+userID+'&num='+num,function(){
            var printContent = document.getElementById('userInfo');
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
        <?php } ?>
    });
});
	$('input[type="date"]').change(function(){
    var num=$('#num').val();         //Date in full format alert(new Date(this.value));
    var inputDate = $(this).val();
    
    var url = "home.php?number=" + encodeURIComponent(num) + "&date=" + encodeURIComponent(inputDate) ;
				
            window.location.href = url;
});
	$(document).on('change', 'input', function(){
    var options = $('datalist')[0].options;
    for (var i=0;i<options.length;i++){
       if (options[i].value == $(this).val()) 
         {
         	var number=$(this).val();
         	var url = "home.php?number=" + encodeURIComponent(number) ;
				
            window.location.href = url;
         }
    }
});
	var queryString = new Array();
    $(function () {
        if (queryString.length == 0) {
            if (window.location.search.split('?').length > 1) {
                var params = window.location.search.split('?')[1].split('&');
               
                for (var i = 0; i < params.length; i++) {
                    var key = params[i].split('=')[0];
                    var value = decodeURIComponent(params[i].split('=')[1]);
                    queryString[key] = value;
                }
            }
        }
        $('.s').show();
        if (queryString["number"] != null ) {
            var data = "<u>Values from QueryString</u><br /><br />";
            data += "<b>Number:</b> " + queryString["number"] + "<b>Date:</b> " + queryString["date"] ;
            
            var arr=queryString["number"].split(",");
            
        }
    });
    var request;
if(window.XMLHttpRequest){
    request = new XMLHttpRequest();
}else{
    request = new ActiveXObject("Microsoft.XMLHTTP");
}
request.open('GET', 'home.php', true);
request.send();

</script>
</body>
</html>