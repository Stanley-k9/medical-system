<?php
class User{
 
   
    private $conn;
    private $table_name = "users";
 

    public $Name;
    public $Email;
    public $phone;
    public $ID_number;
    public $buttonS;
    
    public function __construct($db){
        $this->conn = $db;
    }
   
    function signup(){
     

        if($this->isAlreadyExist()){
            return false;
        }
       
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                Name=:Name, Email=:Email, phone=:phone, ID_number=:ID_number,  buttonS=:buttonS";
    
                
       
        $stmt = $this->conn->prepare($query);
    
       
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->ID_number=htmlspecialchars(strip_tags($this->ID_number));
        $this->buttonS=htmlspecialchars(strip_tags($this->buttonS));
    
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":ID_number", $this->ID_number);
        $stmt->bindParam(":buttonS", $this->buttonS);
      
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
    
        return false;
        
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
            ID_number='".$this->ID_number."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}