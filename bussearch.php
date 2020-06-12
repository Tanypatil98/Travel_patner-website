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

  <title>Search</title>
  <link rel="stylesheet" type="text/css" href="./style.css">
  <link rel="stylesheet" href="./home_files/bootstrap.min.css" >
  <link rel="stylesheet" type="text/css" href="./home_files/Home.css">
  <link rel="stylesheet" href="./home_files/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
  .table-responsive {
    width: 50%;
    display: inline-table;
  }
  .btn1{
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
  .btn1:hover{
    opacity: 0.7;
  }
  .text-center{
  text-align: center !important;
}
.pagination {
    
    padding-left: 550px;
    margin: 20px 0;
    border-radius: 4px;

    
    list-style: none;
    border-radius: .25rem;
}
ul {
    display: block;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
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
        <a href="/home.php"><img class="t" src="./home_files/Lakshya-logo.png"></a>
      </div>
      <div class="column-661">
        <h1><big><b>Lakshya Tours &amp; Travels</b></big></h1><b>
          <h4>Travels Company</h4>
      </b></div><b>
    </b></div><b>
  </b></div><b>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="/home.php"><img src="./home_files/Lakshya-logo.png" width="90" height="30" alt=""></a>
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
          <h1><big>Search Result</big></h1>
      </header>
    </div>
<?php
// core.php holds pagination variables
include_once 'core.php';
 
// include database and object files
include_once 'database.php';
include_once 'product.php';

 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);

 
// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
// query products
$stmt = $product->bussearch($search_term, $from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url="bussearch.php?s={$search_term}&";
 
// count total rows - used for pagination
$total_rows=$product->buscountAll_BySearch($search_term);
echo "<div class='right-button-margin'>";
    echo "<a href='bus.php' class='btn btn-primary pull-right'>";
        echo "<span class='fa fa-backward'></span> ";
    echo "</a>";
echo "</div>";
 
// read_template.php controls how the product list will be rendered
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
    echo "<a href='create_product.php' onclick='iframe()' class='btn btn-primary pull-right'>";
        echo "<span class='fa fa-plus'></span> Create Bus";
    echo "</a>";
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
                       
                      <a href='update_product.php?id={$id}' class='btn1 btn-info left-margin'>
                          <span class='glyphicon glyphicon-edit'></span> Edit
                      </a>
                       
                      <a delete-id='{$id}' class='btn1 btn-danger delete-object'>
                          <span class='glyphicon glyphicon-remove'></span> Delete
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
    echo "<div class='alert alert-danger'>No products found.</div>";
}
 
?>
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
        Powered by <a href="/lk/home.html" target="_blank">Lakshya Travel</a>
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