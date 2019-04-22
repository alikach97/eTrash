<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/citems.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$citem = new Citem($db);
 if(
    !empty($_POST["iid"]) 
){
    // set product property values
    $citem->iid = $_POST["iid"];
    // read the details of product to be edited
    $stmt = $citem->readOne();
    $num = $stmt->rowCount();
    if($num>0){ 
    // products array
    $citem_arr=array();
    $citem_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $citem_item=array(
            "id" => $id,
            "cid" => $cid,
            "iid" => $iid
        );
        array_push($citem_arr["records"], $citem_item);
    } 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($citem_arr);
}
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No companies found.")
    );
}
}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to find companies. Data is incomplete.", 
                           "success" => "0"));
}
?>
