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
}

?>