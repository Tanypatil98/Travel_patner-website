
<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Customer Details on Bus Number <?php echo $_GET['num']; ?></title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" href="./home_files/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="./home_files/Home.css">
    <link rel="stylesheet" href="./home_files/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 20px;
}

th, td {
  padding: 15px;
}
th{
    width: 2%;
}

    </style>
</head>
<body>
    <?php 
    session_start();
    $db=mysqli_connect('localhost','root','','user');
    if(!empty($_GET['id'])){
        $date=$_GET['id'];
        $num=$_GET['num'];
    echo "<div class='container'>";
    echo "<div class='d-flex justify-content-center'>
            <header>
                <h1>".$_SESSION['cname']." Travels </h1>
            </header>
        </div>";
    echo "</div>";
    echo "<div class='container'>";
    echo "
            <header>
                <h3>Customer Details On The Date ".$date." </h3>
            </header>
        ";
    echo "</div>";
    echo "<div class='container'>";
        echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Mobile</th>";
            echo "<th>Seat</th>";
            echo "<th>Date</th>";
            echo "<th>Bus Number</th>";
            
        echo "</tr>";
        $cn=$_SESSION['cname'];        
        
        $sql1="SELECT * FROM customer WHERE Cdate='$date' AND Bus_number='$num' AND Cname='$cn'";
        $result1=mysqli_query($db,$sql1);
        $re=mysqli_num_rows($result1);
        while ($row = mysqli_fetch_assoc($result1)){
 
           
 
            echo "<tr>";
               
                echo "<td>".$row['Name']."</td>";
                echo "<td>".$row['Mob']."</td>";
                echo "<td>".$row['Seat']."</td>";
                echo "<td>".$row['Cdate']."</td>";
                echo "<td>".$row['Bus_number']."</td>";
                
                
 
            echo "</tr>";
 
        }
       
    echo "</table>";
    echo "</div>";
        if ($re == 0) {
            echo "<div class='container'>";
    echo "<div class='alert alert-danger'>No Result found.</div>";
     echo "<div class='alert alert-danger'>Please Select Proper Date To Print Customer Details.</div>";
    echo "</div>";
        }
    }else{
        echo "<div class='container'>";
    echo "<div class='alert alert-danger'>No Result found.</div>";
     echo "<div class='alert alert-danger'>Please Select Proper Date To Print Customer Details.</div>";
    echo "</div>";
    }
?>
    <script src="./home_files/jquery.min.js.download"></script>
    <script src="./home_files/jquery-3.3.1.slim.min.js.download" ></script>
    <script src="./home_files/popper.min.js.download" ></script>
    <script src="./home_files/bootstrap.min.js.download" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>