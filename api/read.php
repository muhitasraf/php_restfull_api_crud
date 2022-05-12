<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../config/database.php';
    include_once '../class/Students.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Students($db);
    $stmt = $items->getStudentsData();
    $itemCount = $stmt->rowCount();
    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $studentsArray = array();
        $studentsArray["body"] = array();
        $studentsArray["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "age" => $age,
                "address" => $address,
                "department" => $department
            );
            array_push($studentsArray["body"], $e);
        }
        echo json_encode($studentsArray);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>