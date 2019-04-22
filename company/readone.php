<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/companies.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$company = new Company($db);
 
// get posted data

if(
    !empty($_POST["username"]) &&
    !empty($_POST["password"])
){
    // set product property values
    $company->username = $_POST["username"];
    $company->password = $_POST["password"];
    // read the details of product to be edited
    $company->readOne();
    if($company->name!=null){
    // create array
    $company_item = array(
     	"success" => '1',
        "cid" =>  $company->cid,
        "name" => $company->name,
        "email" => $company->email,
        "username" => $company->username,
        "password" => $company->password, 
        "latitude" => $company ->latitude, 
        "longitude" => $company ->longitude

    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($company_item);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Invalid username or password.", 
                          	"success" => '0'));
}


}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to login. Data is incomplete.", 
                           "success" => "0"));
}
?>