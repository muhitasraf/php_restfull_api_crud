<?php 
class Students{
    private $conn;
    private $table_name = "students";

    public $id = "";
    public $name = "";
    public $age = "";
    public $address = "";
    public $department = "";


    public function __construct($db){
        $this->conn = $db;
    }

    public function getStudentsData(){
        $query = "SELECT id,name, age, address, department FROM ". $this->table_name ."";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }
    public function getSingleStudent(){
        $query = "SELECT id,name, age, address, department FROM ". $this->table_name ." WHERE  id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $dataRow['name'] ?? null;
        $this->age = $dataRow['age'] ?? null;
        $this->address = $dataRow['address'] ?? null;
        $this->department = $dataRow['department'] ?? null;
    }

    public function createStudent(){
        $query = "INSERT INTO ". $this->table_name ." 
                    SET
                        name = :name,  
                        age = :age, 
                        address = :address,
                        department = :department";
        
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->department=htmlspecialchars(strip_tags($this->department));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":department", $this->department);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function updateStudent(){
        $query = "UPDATE ". $this->table_name ." 
                    SET
                        name = :name,  
                        age = :age, 
                        address = :address,
                        department = :department
                    WHERE 
                        id = :id";
        
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->department=htmlspecialchars(strip_tags($this->department));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function deleteStudent(){
        $query = "DELETE FROM ". $this->table_name ." WHERE  id = ? ";
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;

    }
}

?>