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
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Bus</title>
	
	<link rel="stylesheet" href="./home_files/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="./home_files/Home.css">
	<link rel="stylesheet" href="./home_files/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	.table-responsive {
		width: 50%;
		display: inline-table;

	}
	#iframeHolder{
		margin-left: 350px;
	}
	
	.table{
		margin-left: 40px;
	}
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
    
    margin-bottom: 20px;
	}
	.btn1,input[type='submit']:hover{
		opacity: 0.7;
	}
	.text-center{
	text-align: center !important;
}
.pagination {
    
    margin: 20px 0;
    border-radius: 4px;

    padding-left: 550px;
    list-style: none;
    border-radius: .25rem;
}
li{
	padding: 5px;
}
.n{
		padding-top: inherit;
		margin-top: 50px;
	}
input[type='text'], input[type='email'],
input[type='password'] {
     
     border-radius: 2px;
     border: 1px solid #CCC;
     padding: 10px;
     color: #333;
     font-size: 14px;
     margin-top: 10px;
}
@media only screen and (max-width: 1000px) {
	.t{
					width: 120%;
				}
				.n{
					margin-top: 0px;
				}
				.table-responsive{
					width: 80%;
					display: inline-block;
				}
				tbody{
					width: 10px;
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
			    <h1>Add Bus Details</h1>
			</header>
		</div>
		<div>
	<div class="modal " id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
    	<h4 class="modal-title">Create</h4>
    		<button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    	 <?php

include_once 'database.php';
include_once 'product.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
// pass connection to objects
$product = new Product($db);

// set page headers

 
?>
<!-- PHP post code will be here -->
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
 
    // set product property values
    
    $product->name = $_POST['name'];
    $product->number = $_POST['number'];
    $product->seat = $_POST['seat'];
    $product->date = $_POST['date'];
    $product->time = $_POST['time'];
    
    $targetDir = "upload/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     $db=mysqli_connect('localhost','root','','user');
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
     
 if(!empty($_FILES['image']['name'])){  
         $fileName = sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$product->name."','".$fileName."'),"; 
                }else{ 
                    $errorUpload .= $_FILES['image']['name'].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['image']['name'].' | '; 
            } 
        

         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $db->query("INSERT INTO image (name, image) VALUES $insertValuesSQL"); 
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
     
    // Display status message 
    echo $statusMsg;  
    $image=!empty($_FILES["image"]["name"])
        ? $fileName : "";
    $product->image = $image;
    // create the product
    if($product->create()){
        echo "<div class='alert alert-success'>Product was created.</div>";
        // try to upload the submitted file
		// uploadPhoto() method will return an error message, if any.
        
    }
 
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>
 
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
 
    	<tr>
            <td>Image</td>
            <td><input type='file' name='image' class='form-control' /></td>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' value="<?php echo $_SESSION['cname']; ?>" /></td>
        </tr>
 
        <tr>
            <td>Bus_number</td>
            <td><input type='text' name='number' class='form-control' /></td>
        </tr>

        <tr>
            <td>Seat</td>
            <td><input type='text' name='seat' class='form-control' /></td>
        </tr>

 
        <tr>
            <td>Date</td>
            <td><input type="date" name="date" class="form-control"></td>
        </tr>
 
        <tr>
            <td>Time </td>
            <td><input type="time" name="time" class="form-control"></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
            </td>
        </tr>
 
    </table>
</form>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn1 " data-dismiss="modal">Close</button>
    </div>
    </div>
      
    </div>
  </div>
	<?php $cname='';
    $email=$_SESSION["email"];
    $db=mysqli_connect('localhost','root','','user');
    $sqll="SELECT Cname FROM users WHERE Email='$email'";
    $result= mysqli_query($db,$sqll);
    if($row=mysqli_fetch_row($result)){
      $_SESSION['cname']=$row[0];
    } ?>	

			<?php
// core.php holds pagination variables
include_once 'core.php';
 
// include database and object files
include_once 'database.php';
include_once 'product.php';

 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 $cname=$_SESSION['cname'];

$product = new Product($db);
$stmt = $product->busreadAll($from_record_num, $records_per_page, $cname);
 
// specify the page where paging is used
$page_url = "bus.php?";
 
// count total rows - used for pagination
$total_rows=$product->buscountAll();

echo "<div class='container'>";
echo "<form role='search' action='bussearch.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type product name or description...' name='s' id='srch-term' required {$search_value} style='margin-bottom: 10px;' />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='fa fa-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 echo "</div>";

 echo "<div class='right-button-margin'>";
    echo "<button id='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal' style='float:right;'>";
        echo "<span class='fa fa-plus'></span> ";
    echo "</button>";
echo "</div>";
// display the products if there are any
if($total_rows>0){
 
     echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Image</th>";
            echo "<th>Name</th>";
            echo "<th>Bus_number</th>";
            echo "<th>Seat</th>";
            echo "<th>Date</th>";
            echo "<th>Time</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$Image}</td>";
                echo "<td>{$Name}</td>";
                echo "<td>{$Bus_number}</td>";
                echo "<td>{$Seat}</td>";
                echo "<td>{$Cdate}</td>";
                echo "<td>{$Ctime}</td>";
                
                echo "<td>";
                    echo "
                       
                      <a href='update.php?id={$id}' class='btn1 btn-info left-margin'>
                          <span class='fa fa-edit'></span> Edit
                      </a>
                       
                      <a delete-id='{$id}' class='btn1 btn-danger delete-object'>
                          <span class='fa fa-remove'></span> Delete
                      </a>";
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no products
else{
	echo "<div class='container'>";
    echo "<div class='alert alert-danger'>No products found.</div>";
    echo "</div>";
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
			  Powered by <a href="/lk/home.php" target="_blank">Lakshya Travel</a>
			  </p>
			</div>
		</div>
	</footer>
	
	<script src="./home_files/jquery.min.js.download"></script>
	<script src="./home_files/jquery-3.3.1.slim.min.js.download" ></script>
	<script src="./home_files/popper.min.js.download" ></script>
	<script src="./home_files/bootstrap.min.js.download" ></script>
<script type="text/javascript">
	$(document).ready(function(){
	 $('#button').click(function(){ 
        
        	if ($('#button').hasClass('click')) {

        		$('#iframeHolder').html('');
                $('#button').removeClass('click');
        	}else{
        		if(!$('#iframe').length) {
                $('#iframeHolder').html('<iframe id="iframe" src="create.php" width="700" height="450"></iframe>');

                $('#button').addClass('click');
        	}
        }
    }); 

	 
});
	
</script>
</body>
</html>