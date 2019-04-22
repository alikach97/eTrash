<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/measurements.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$measurement = new Measurement($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->sid) 
){
// query products
  $measurement->sid = $data->sid;
$stmt = $measurement->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){ 
    // products array
    $measurement_arr=array();
    $measurement_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $measurement_item=array(
            "mid" => $mid,
            "sid" => $sid,
            "ts" => $ts, 
            "fill_level" => $fill_level
        );
        array_push($measurement_arr["records"], $measurement_item);
    } 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($measurement_arr);
}
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No measurements found.")
    );
}
}
else{ 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Data is incomplete."));
}