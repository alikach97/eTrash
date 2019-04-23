<?php 
header('Content-Type: text/xml');
header("Access-Control-Allow-Origin: *");
// include database and object files
include_once './config/database.php';
include_once './objects/locations.php';
// instantiate database
$database = new Database();
$db = $database->getConnection();
// initialize object
$location = new Location($db);
// query
$stmt = $location->read();
$num = $stmt->rowCount();
$locations_arr=array();
$locations_arr["records"]=array();
$xml='<?xml version="1.0" encoding="UTF-8"?>';
$xml.='<markers>';
$ind=0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $xml.='<marker ';
    $xml.='sid="' . $sid. '" ';
    $xml.='fill_level="' . $fill_level . '" ';
    $xml.='lat="' . $lat . '" ';
    $xml.='lng="' . $lng . '" ';
    $xml.='/>';
    $ind = $ind + 1;
    }
    $xml.='</markers>'; 
    print $xml;  
    ?>