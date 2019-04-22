<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare product object
$user = new User($db);
 
// get posted data
if(!empty($_POST["username"]) ){
    // set product property values
    $user->username = $_POST["username"];
    // read the details of product to be edited
    $user->readTwo();
    if($user->name!=null){
    // create array
        $password = $user->password; 
        $to = $user->email; 
        $subject = "Your Recovered Password";
        $message = "Please use this password to login " . $password;
        http_response_code(200); 
         if(mail($to, $subject, $message)){
            echo json_encode(array("message" => "Email sent."));
         }else{
            echo json_encode(array("message" => "Failed to Recover your password, try again"));
         }
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "User does not exist."));
}


}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to login. Data is incomplete."));
}
?>