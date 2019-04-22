<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/sensors.php';
include_once '../objects/measurements.php';
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$sensor = new Sensor($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->uid) 
){
$sensor->uid = $data->uid; 
$stmt = $sensor->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){ 
    $sensor_arr=array();
    $sensor_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $measurement = new Measurement($db);
        $measurement->sid = $sid; 
        $stmt2 = $measurement->readOne();
        $num2 = $stmt2->rowCount();
        if($num2>0){ 
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        extract($row2);
        $measurement_item=array(
            "sid" => $sid,
            "mid" => $mid,
            "ts" => $ts, 
            "fill_level" => $fill_level
        );
        array_push($sensor_arr["records"], $measurement_item);
    } 
}
    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    echo json_encode($sensor_arr);
}
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No sensors found.")
    );
}
}
else{ 
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Data is incomplete."));
}