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
	$bus=$seatn=$radio=$new_date=$time=$seatn1=$s='';
	$errors=array();
	 $db=mysqli_connect('localhost','root','','user');
	
	if (isset($_GET['number'])) {
		$bus=$_GET['number'];
	

		$sql="SELECT Seat FROM bus WHERE Bus_number='$bus'";
		$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_assoc($result);
			$s=$row['Seat'];
			//header('location:coice.php');
			
		//}else{
			//header('location:home.html');
		//}
		

	}
	$echo1='';
	if(isset($_GET['date'])){
		$bus2=$_GET['number'];
		$date=$_GET['date'];
		$cname=$_SESSION['cname'];
		
		$t=array();
		$ava=array();
		$sql1="SELECT * FROM bus WHERE Bus_number='$bus2' AND CDate='$date' AND Name='$cname'";
		$result1=mysqli_query($db,$sql1);
		$re=mysqli_fetch_array($result1);
		if($re > 0 ){
			$sql="SELECT Seat,Status FROM seat WHERE Bus_number='$bus2' AND CDate='$date'";
		
		$result=mysqli_query($db,$sql);
			$row3=mysqli_num_rows($result);
			
			$j=0;
			for ($i=0; $i < $row3 ; $i++) { 
			$row1=mysqli_fetch_array($result);
			if($row1['Status'] == "Not-Available"){
				$ava[$j]=$row1['Seat'];
				
				$j++;
			}else{											
			$t[$i]=$row1['Seat'];
				
			}
			}
		$ka=json_encode($t);
		$sa=json_encode($ava);
		

	}else{
		array_push($errors, "bus not Available");
		$echo1= "<div class='container'>
		 <div class='alert alert-danger'> Bus Not Available On This Date.</div>
		 </div>";
	}
	}
	if (isset($_POST['Submit'])) {
		$bus1=$_POST['number'];
		$seatn=$_POST['seatno'];
		$name=$_POST['name'];
		$cname=$_SESSION['cname'];
		$mob=$_POST['mob'];
		$se=explode(',', $seatn);
		$sea=sizeof($se);
		
		$time = strtotime($_POST['Date']);
	if ($time) {
	  $new_date = date('Y-m-d', $time);
	  
	} else {
	   echo 'Invalid Date: ' . $_POST['dateFrom'];
	  // fix it.
	}
	if(isset($_POST['seat'])){
		$radio=$_POST['seat'];
	}
	$_SESSION['radio']=$radio;
	if($radio != "Not-Available") {
	if(empty($_POST['name'])){
		array_push($errors, "from is required");
		echo "string";
	}
	if(empty($mob)){
		array_push($errors, "from is required");
		echo "string1";
	}
}
	if(empty($_POST['number'])){
		array_push($errors, "from is required");
		echo "string";
	}
	if(empty($radio)){
		array_push($errors, "from is required");
		echo "string1";
	}
	if(empty($seatn)){
		array_push($errors, "from is required");
		echo "string2";
	}
	
	if(count($errors)==0){

		
		for ($i=0; $i < $sea-1 ; $i++) { 
			$sql="INSERT INTO seat(Bus_number,Seat,Status,CDate) VALUES ('$bus1','".$se[$i]."','$radio','$new_date')";
		$result=mysqli_query($db,$sql);
		}
		if($radio != "Not-Available") {
		for ($i=0; $i < $sea-1 ; $i++) { 
			$sql1="INSERT INTO customer(Name,Mob,Seat,Bus_number,Cdate,Cname) VALUES ('$name','$mob','".$se[$i]."','$bus1','$new_date','$cname')";
		$result3=mysqli_query($db,$sql1);
		}
	}
			echo "<div class='container'>";
    echo "<div class='alert alert-sucess'>Upload Sucessfully.</div>";
    echo "</div>";
			header('location:Confirm.php');
			
		//}else{
			//header('location:home.html');
		//}
		}
		echo "<div class='container'>
		 <div class='alert alert-danger'> Bus Not Available On This Date.</div>
		 </div>";
	}

	
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Seat</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<link rel="stylesheet" href="./home_files/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="./home_files/Home.css">
	<link rel="stylesheet" href="./home_files/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
<style type="text/css">
	
	.btn1,input[type='submit']{
		-moz-user-select: none;
    -ms-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: inline-block;
    width: auto;
    text-decoration: none;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 50px 20px;
    padding: 8px 15px;
    background-color: #557b97;
    color: #fff;
    font-family: "Antique Olive",sans-serif;
    font-style: normal;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    white-space: normal;
    font-size: 10px;
    margin-left: 40px;
    margin-bottom: 20px;
	}
	.btn1,input[type='submit']:hover{
		opacity: 0.7;
	}
	.text-center{
	text-align: center !important;
}
form{
	margin-left: 100px;
}
label{
	margin-left: 10px;
}
.n{
		padding-top: inherit;
		margin-top: 50px;
	}
	table {
  border: 1px solid black;
  width: 80%;
  margin-left: 40px;
}
th{
	width: 20%;
}
td{
	padding-left: 10px;
	padding-top: 10px;
	padding-bottom: 10px;
}
.column-49 {
  float: left;
  width: 50%;
  padding: 15px;
}
.column-50 {
  
 width: 50%;
  padding: 15px;
}
.se{
	padding: 5px;
	width: 80%;
	height: 100px;
}
.no{
	cursor: no-drop;
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
				.column-49,
  .column-50 {
    width: 100%;
    
    height: 100%;
    padding-left: inherit;
  }
  .pb{
  	width: 50%;
  }
  form{
  	margin-left: 50px;
  }
  input[type='radio']{
  	margin-left: 45px;
  }
  .se{
  	width: 90%;
  	height: 50px;
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
		    <header>
			    <h1>Add Seat Details</h1>
			</header>
		</div>
		
			<form action="" method="post">
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
				<input type="date"   name="Date" class="no1"  value=<?php  if(isset($_GET['date'])){
					echo $_GET['date'];
				} ?>  >
				<label>Seat :</label>
				<input type="radio" name="seat" value="Booked">Booked
				<input type="radio" name="seat" value="Not-Available">Not-Available<br>
				<label>Seat no.:</label>
				<input type="text"    name="seatno" id="myInput" value="" class="no" multiple>
				<label id="uln">Customer Name:</label>
	    	 	<input type="text" name="name" id="uname">
	    	 	<label id="ulm">Mobile:</label>
	    	 	<input type="text" name="mob" id="umob">
				
				<input type="submit" id="book" name="Submit" value="Submit" >
			</form>
			
			<div class="sk">
				<p class="p"></p>
		<div class="container">	
		<img src="./img/icons8-blue-square-96.png" style="width: 20px;height: 20px;">
		<label style="margin-left: 10px;margin-right: 20px;">Booked</label>
		<img src="./img/icons8-green-square-96.png" style="width: 20px;height: 20px;">
		<label style="margin-left: 10px;margin-right: 20px;">Available</label>
		<img src="./img/icons8-red-square-96.png" style="width: 20px;height: 20px;">
		<label style="margin-left: 10px;margin-right: 20px;">Not Available</label>
</div>


<div class="wor"><p style="color: red;">Please Select Seat</p></div>


	
<div class="container">
<div class="row">
	<div class="column-49">
		<h2>Lowercase</h2>
		<table>
			<tr>
				<th> </th>
				<th> </th>
				<th> </th>
				<th><img class="pb" src="./img/icons8-steering-wheel-80.png"></th>
			</tr>
			<tr>
				<td><input type="button" class="se" name="" value="1"  ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="5"  ></td>
				<td><input type="button" class="se" name="" value="6"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="7"  ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="11"   ></td>
				<td><input type="button" class="se" name="" value="12"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="13"   ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="17"   ></td>
				<td><input type="button" class="se" name="" value="18"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="19"   ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="23"   ></td>
				<td><input type="button" class="se" name="" value="24"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="25"   ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="29"   ></td>
				<td><input type="button" class="se" name="" value="30"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="31"   ></td>
				<td class="s"><?php 
				
				if ($s=="38") {?>
					<input type="button" class="se" name="" value="37"   >
				<?php } ?></td>
				<td><input type="button" class="se" name="" value="35"   ></td>
				<td><input type="button" class="se" name="" value="36"   ></td>
			</tr>
			
		</table>
	</div>
	<div class="column-50">
		<h2>Uppercase</h2>
		<table>
			<tr>
				<th> </th>
				<th> </th>
				<th> </th>
				<th><img class="pb" src="./img/icons8-steering-wheel-80.png"></th>
			</tr>
			<tr>
				<td><input type="button" class="se" name="" value="2"  ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="3"  ></td>
				<td><input type="button" class="se" name="" value="4"  ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="8"  ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="9"  ></td>
				<td><input type="button" class="se" name="" value="10"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="14"   ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="15"   ></td>
				<td><input type="button" class="se" name="" value="16"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="20"   ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="21"   ></td>
				<td><input type="button" class="se" name="" value="22"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="26"   ></td>
				<td> </td>
				<td><input type="button" class="se" name="" value="27"   ></td>
				<td><input type="button" class="se" name="" value="28"   ></td>
			</tr>
			
			<tr>
				<td><input type="button" class="se" name="" value="32"   ></td>
				<td class="s"><?php if ($s=="38") {?>
					<input type="button" class="se" name="" value="38"   >
				<?php } ?> </td>
				<td><input type="button" class="se" name="" value="33"   ></td>
				<td><input type="button" class="se" name="" value="34"   ></td>
			</tr>
			
		</table>
	</div>
</div>
</div>
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
			  Powered by <a href="/lk/home.php" target="_blank">Lakshya Travel</a>
			  </p>
			</div>
		</div>
	</footer>
	
	<script src="./home_files/jquery.min.js.download"></script>
	<script src="./home_files/jquery-3.3.1.slim.min.js.download" ></script>
	<script src="./home_files/popper.min.js.download" ></script>
	<script src="./home_files/bootstrap.min.js.download" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>-->
<script type="text/javascript">
	var i = [];
	
	var total=0;
	var pri=0;
	var t = [];
$( document ).ready(function() {

            $('.se').each(function(elem) {
            	
            $(this).click(function(e) {
            	if($(this).hasClass('click')){
            		$(this).css('background-color','');
            		
            		var y=i;
            		
            		var remove_Item = $(this).val();
            		y = $.grep(y, function(value) {
					  return value != remove_Item;
					});
					$('#myInput').val('');
					$('#myInput').val(function(){
                 	return this.value + y +',';
                 	});
                 	
                 	 
					i=y;
                 	
                 	if (i=="") {
                 		$('#myInput').val('');

                 	}
            		$(this).removeClass('click');
            	}else{
            		
            		$(this).css('background-color','green');
                 i.push($(this).val());
                 var number=$(this).val();
                 
                 $('#myInput').val(function(){
                 	return this.value + number +',';
                 })
                
              	$(this).addClass('click');
                 
            	}
            }); 
          });
             
});
$("input[type='radio']").on('change', function () {
         var selectedValue = $("input[name='seat']:checked").val();
         if (selectedValue == "Not-Available") {
               $('#uname').hide();
               $('#umob').hide();
               $('#uln').hide();
               $('#ulm').hide();
           }else{
           	$('#uname').show();
               $('#umob').show();
               $('#uln').show();
               $('#ulm').show();
           }
     });
$(document).on("click", "#button", function () {
     var myBookId = $('#myInput').val();
     $(".modal-body #seat").val( myBookId );
});
<?php if (!isset($echo1)) {?>
var tan='<?php echo $ka; ?>';
 var rd='<?php echo $sa; ?>';
 
	$('.se').each(function(elem) {
	for (var i = 0; i < rd.length; i++) {
		if (rd[i] == $(this).val()) {
			$(this).prop('disabled','true');
			$(this).css('background-color','red');
			$(this).css('cursor','no-drop');
		}
	}
});


var k=jQuery.parseJSON(tan);
	
$('.se').each(function(elem) {
	for (var i = 0; i < tan.length; i++) {
		if (k[i] == $(this).val()) {
			$(this).prop('disabled','true');
			$(this).css('background-color','royalblue');
			$(this).css('cursor','no-drop');
		}
	}
});

<?php } ?>
$('.s').hide();
$('.wor').hide();
$('#my').hide();
$("#book").click(function(){
				
				var number=$('#myInput').val();
				
				if ($('#myInput').val()=='') {
					$('.wor').show();
				}else{
			    $('#my').show(); 
        }
			  });
/*$('#book').click(function(){
	var num=$('.no').val();
	var date=$('.no1').val();
	var status=$("input[name='seat']:checked").val();
	var number=$('#myInput').val();
	$.post('/Confirm.php',   // url
			   { num1:num ,
			   	 da:date,
			   	 st:status,
			   	 nu:number }, // data to be submit
			   function(data, status, jqXHR) {// success callback
						$('.p').append('status: ' + status + ', data: ' + data);
				});
			}); -->*/
$(document).on('change', 'input', function(){
    var options = $('datalist')[0].options;
    for (var i=0;i<options.length;i++){
       if (options[i].value == $(this).val()) 
         {
         	var number=$(this).val();
         	var url = "Confirm.php?number=" + encodeURIComponent(number) ;
				
            window.location.href = url;
         }
    }
});
$('input[type="date"]').change(function(){
    var num=$('#num').val();         //Date in full format alert(new Date(this.value));
    var inputDate = $(this).val();
    
    var url = "Confirm.php?number=" + encodeURIComponent(num) + "&date=" + encodeURIComponent(inputDate) ;
				
            window.location.href = url;
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
            data += "<b>Number:</b> " + queryString["number"] +"<b>Date:</b> " + queryString["date"]  ;
            
            var arr=queryString["number"].split(",");
            
        }
    });

</script>
</body>
</html>