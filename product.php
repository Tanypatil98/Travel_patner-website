<?php
class Product{

	private $conn;
    private $table_name = "match";
    private $table_namebus = "bus";
    private $table_nameseat = "Seat";

    public $id;
    public $from;
    public $to;
    public $time;
    public $name;
    public $number;
    public $seat;
    public $image;
    public $date;
    
    public function __construct($db){
        $this->conn = $db;
    }
    function readAll($from_record_num, $records_per_page, $cna){
 
            $query = "SELECT
                        id, Start, Destin, price
                    FROM
                        `" . $this->table_name . "` WHERE Cname LIKE ?
                    ORDER BY
                        id ASC
                    LIMIT
                        {$from_record_num}, {$records_per_page}";
         
            $stmt = $this->conn->prepare( $query );
             $search_term = "%{$cna}%";
                $stmt->bindParam(1, $search_term);
            $stmt->execute();
         
            return $stmt;
        }
        // used for paging products
        public function countAll($cna){
         
            $query = "SELECT id FROM `" . $this->table_name . "` WHERE Cname LIKE ? ";
         
            $stmt = $this->conn->prepare( $query );
            $search_term = "%{$cna}%";
                $stmt->bindParam(1, $search_term);
            $stmt->execute();
         
            $num = $stmt->rowCount();
         
            return $num;
        }
        function busreadAll($from_record_num, $records_per_page, $cname){
 
            $query = "SELECT
                        id, Image, Name,  Bus_number, Seat, Cdate, Ctime
                    FROM
                        `" . $this->table_namebus . "` WHERE Name LIKE ?
                    ORDER BY
                        id ASC
                    LIMIT
                        {$from_record_num}, {$records_per_page}";
          
            $stmt = $this->conn->prepare( $query );
            $search_term = "%{$cname}%";
                $stmt->bindParam(1, $search_term);
            $stmt->execute();
         
            return $stmt;
        }
        // used for paging products
        public function buscountAll(){
         
            $query = "SELECT id FROM `" . $this->table_namebus . "`";
         
            $stmt = $this->conn->prepare( $query );
            $stmt->execute();
         
            $num = $stmt->rowCount();
         
            return $num;
        }
    public function search($search_term, $from_record_num, $records_per_page){
 
                // select query
                $query = "SELECT
                            id, Start, Destin, price
                        FROM
                           `" . $this->table_name . "` 
                        WHERE
                            Start LIKE ? OR Destin LIKE ?
                        ORDER BY
                            id ASC
                        LIMIT
                            ?, ?";
             
                // prepare query statement
                $stmt = $this->conn->prepare( $query );
             
                // bind variable values
                $search_term = "%{$search_term}%";
                $stmt->bindParam(1, $search_term);
                $stmt->bindParam(2, $search_term);
                $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
                $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
             
                // execute query
                $stmt->execute();
             
                // return values from database
                return $stmt;
            }
                     function readOne(){
 
    $query = "SELECT Start, Destin, price
        FROM `" . $this->table_name . "`
        WHERE id = ?
        LIMIT 0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->from = $row['Start'];
    $this->to = $row['Destin'];
    $this->price = $row['price'];
    
}
            public function countAll_BySearch($search_term){
             
                // select query
                $query = "SELECT
                            COUNT(*) as total_rows
                        FROM
                            `" . $this->table_name . "`  
                        WHERE
                            Start LIKE ? OR Destin LIKE ?";
             
                // prepare query statement
                $stmt = $this->conn->prepare( $query );
             
                // bind variable values
                $search_term = "%{$search_term}%";
                $stmt->bindParam(1, $search_term);
                $stmt->bindParam(2, $search_term);
             
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
             
                return $row['total_rows'];
            }
             function delete(){
         
            $query = "DELETE FROM `" . $this->table_name . "` WHERE id = ?";
             
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
         
            if($result = $stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        function update(){
         
            $query = "UPDATE
                        `" . $this->table_name . "`
                    SET
                        Start = :from,
                        Destin=:to, 
                        price = :price
                    WHERE
                        id = :id";
         
            $stmt = $this->conn->prepare($query);
         
            // posted values
           $this->from=htmlspecialchars(strip_tags($this->from));
        $this->to=htmlspecialchars(strip_tags($this->to));
       
            $this->price=htmlspecialchars(strip_tags($this->price));
           
            $this->id=htmlspecialchars(strip_tags($this->id));
         
            // bind parameters
            $stmt->bindParam(':from', $this->from);
            $stmt->bindParam(":to", $this->to);
       
            $stmt->bindParam(':price', $this->price);
            
            $stmt->bindParam(':id', $this->id);
         
            // execute the query
            if($stmt->execute()){
                return true;
            }
         
            return false;
             
        }
        public function bussearch($search_term, $from_record_num, $records_per_page){
 
                // select query
                $query = "SELECT
                            id, Image, Name,  Bus_number, Seat, Cdate, Ctime
                        FROM
                           `" . $this->table_namebus . "` 
                        WHERE
                            Start LIKE ? OR Destin LIKE ?
                        ORDER BY
                            id ASC
                        LIMIT
                            ?, ?";
             
                // prepare query statement
                $stmt = $this->conn->prepare( $query );
             
                // bind variable values
                $search_term = "%{$search_term}%";
                $stmt->bindParam(1, $search_term);
                $stmt->bindParam(2, $search_term);
                $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
                $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
             
                // execute query
                $stmt->execute();
             
                // return values from database
                return $stmt;
            }
                     function busreadOne(){
 
    $query = "SELECT Image, Name,  Bus_number, Seat, Cdate, Ctime
        FROM `" . $this->table_namebus . "`
        WHERE id = ?
        LIMIT 0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->image = $row['Image'];
    $this->name = $row['Name'];
    $this->number = $row['Bus_number'];
    $this->seat = $row['Seat'];
    $this->date = $row['Cdate'];
    $this->time = $row['Ctime'];
    
}
            public function buscountAll_BySearch($search_term){
             
                // select query
                $query = "SELECT
                            COUNT(*) as total_rows
                        FROM
                            `" . $this->table_namebus . "`  
                        WHERE
                            Start LIKE ? OR Destin LIKE ?";
             
                // prepare query statement
                $stmt = $this->conn->prepare( $query );
             
                // bind variable values
                $search_term = "%{$search_term}%";
                $stmt->bindParam(1, $search_term);
                $stmt->bindParam(2, $search_term);
             
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
             
                return $row['total_rows'];
            }
             function busdelete(){
         
            $query = "DELETE FROM `" . $this->table_namebus . "` WHERE id = ?";
             
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
         
            if($result = $stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        function busupdate(){
         
            $query = "UPDATE
                        `" . $this->table_namebus . "`
                    SET
                        Image = :image,
                        Name=:name, 
                        Bus_number = :number,
                        Seat = :seat,
                        Cdate=:date, 
                        Ctime = :time
                    WHERE
                        id = :id";
         
            $stmt = $this->conn->prepare($query);
         
            // posted values
           $this->image=htmlspecialchars(strip_tags($this->image));
        $this->name=htmlspecialchars(strip_tags($this->name));
        
           $this->number=htmlspecialchars(strip_tags($this->number));
        $this->seat=htmlspecialchars(strip_tags($this->seat));
       
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->time=htmlspecialchars(strip_tags($this->time));
           
            $this->id=htmlspecialchars(strip_tags($this->id));
         
            // bind parameters
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(":name", $this->name);
       
            $stmt->bindParam(':number', $this->number);
            $stmt->bindParam(':seat', $this->seat);
            $stmt->bindParam(":date", $this->date);
       
            $stmt->bindParam(':time', $this->time);
            
            $stmt->bindParam(':id', $this->id);
         
            // execute the query
            if($stmt->execute()){
                return true;
            }
         
            return false;
             
        }
        function create(){
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_namebus . "
                SET
                    Name=:name, Image=:image, Bus_number=:number, Seat=:seat, Cdate=:date, Ctime=:time";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->image=htmlspecialchars(strip_tags($this->image));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->number=htmlspecialchars(strip_tags($this->number));
        $this->seat=htmlspecialchars(strip_tags($this->seat));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->time=htmlspecialchars(strip_tags($this->time));
     
 
        // to get time-stamp for 'created' field
        
 
        // bind values 
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":number", $this->number);
        $stmt->bindParam(":seat", $this->seat);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":time", $this->time);
      
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
        }
?>