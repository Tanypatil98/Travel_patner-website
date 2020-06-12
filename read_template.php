<?php
// search form
echo "<div class='container'>";
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type product name or description...' name='s' id='srch-term' required {$search_value} style='margin-bottom: 10px;' />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='fa fa-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 echo "</div>";

 
// display the products if there are any
if($total_rows>0){
 
     echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Source</th>";
            echo "<th>Destination</th>";
            echo "<th>Price</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$Start}</td>";
                echo "<td>{$Destin}</td>";
                echo "<td>{$price}</td>";
                
                echo "<td>";
                    echo "
                       
                      <a href='update_product.php?id={$id}' class='btn1 btn-info left-margin'>
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
    echo "<div class='alert alert-danger'>No products found.</div>";
}
?>