<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/Students.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Students($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->name = $data->name;
    $item->age = $data->age;
    $item->address = $data->address;
    $item->department = $data->department;
    
    if($item->createStudent()){
        echo 'Student created successfully.';
    } else{
        echo 'Could not created Student.';
    }
?>