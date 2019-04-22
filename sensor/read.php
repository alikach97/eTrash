<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/sensors.php';
 
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
// query products
$stmt = $sensor->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){ 
    // products array
    $sensor_arr=array();
    $sensor_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $sensor_item=array(
            "sid" => $sid,
            "uid" => $uid
        );
        array_push($sensor_arr["records"], $sensor_item);
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