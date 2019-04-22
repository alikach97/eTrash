<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/users.php';
 
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
// make sure data is not empty
if (
  		!empty($_POST["name"]) &&
  		!empty($_POST["email"]) &&
  		!empty($_POST["username"]) &&
  		!empty($_POST["password"])
  	){
  	print_r(data); 
    // set product property values
    $user->name = $_POST["name"];
    $user->email = $_POST["email"];
    $user->username = $_POST["username"];
    $user->password = $_POST["password"];
    // create the product
    if($user->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "User was registered."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to register user."));
    }
}
else{
  http_response_code(400);
 echo json_encode(array("message" => "Unable to register user. Data is incomplete"));
}
?>