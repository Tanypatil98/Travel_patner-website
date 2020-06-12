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

    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" href="./home_files/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./home_files/Home.css">
    <link rel="stylesheet" href="./home_files/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
  .btn1 {
    display: inline-block;
    width: 100px;
    height: 40px;
    background: #f1f1f1;
    margin: 5px;
    border-radius: 30%;
    box-shadow: 0 5px 15px -5px #00000070;
    color: #3498db;
    overflow: hidden;
    position: relative;
}
.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
input[type='text'], input[type='number'], input[type='file'],
input[type='date'], input[type='time'] {
     width: 200px;
     border-radius: 2px;
     border: 1px solid #CCC;
     padding: 10px;
     color: #333;
     font-size: 14px;
     margin-top: 10px;
}
table{
    margin-left: 350px;
    
    width: 40%;
}
td{
    width: 40%;
}
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
                <h1>Update</h1>
            </header>
        </div>
<?php
// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
// set page header

echo "<div class='right-button-margin'>";
    echo "<a href='javascript:history.go(-1)' class='btn btn-primary pull-right'><span class='fa fa-backward'></span></a>";
echo "</div>"; 
// include database and object files
include_once 'database.php';
include_once 'product.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$product = new Product($db);

 
// set ID property of product to be edited
$product->id = $id;
 
// read the details of product to be edited
$product->busreadOne();
 

// if the form was submitted
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
    

        
 
    // update the product
    if($product->busupdate()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Product was updated.";
        echo "</div>";
        
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update product.";
        echo "</div>";
    }
    

}
?>

    <div class="w3-container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
 <table>
        <tr>
            <td>Image</td>
            <td><input type='file' name='image' value='<?php echo $product->image; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Bus_number</td>
            <td><input type='text' name='number' value='<?php echo $product->number; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Seat</td>
            <td><input type='text' name='seat' value='<?php echo $product->seat; ?>' class='form-control' /></td>
        </tr>

 
        <tr>
            <td>Date</td>
            <td><input type="date" name="date" value='<?php echo $product->date; ?>' class="form-control"></td>
        </tr>
 
        <tr>
            <td>Time </td>
            <td><input type="time" name="time" value='<?php echo $product->time; ?>' class="form-control"></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn1 btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
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