<?php
// get database connection
include "./config/database.php";
include "./objects/users.php";
include "./objects/measurements.php";
include "./objects/sensors.php";

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
// set product property values
//for ($i = 0; $i < 50 ; $i++) {

  $userRandom['name'] = genRanAlphaString();// random creation of $user
  $userRandom['username'] = genRanAlphaNumString();
  $userRandom['email'] = $userRandom['username'] . "@somemail.com";
  $userRandom['password'] = genRanAlphaNumString();
  $user->name = $userRandom["name"];
  $user->email = $userRandom["email"];
  $user->username = $userRandom["username"];
  $user->password = $userRandom["password"];
  $user->create();

//}

$arrUid = $user->getAllUids();
var_dump($arrUid);
$latitude = 33.8;
$longitude = 35.4;
$sensor = new Sensor($db);
for ($i =0; $i<50; $i++) {
  $sensorRandom['uid'] = $arrUid(rand(0,sizeof($arrUid)-1));
  $sensorRandom['lat'] = $latitude . genRanNumString(4);
  $sensorRandom['lng'] = $longitude . genRanNumString(4);

  var_dump($sensorRandom);
  die();
  $sensor->uid = $sensorRandom['uid'];
  $sensor->lat = $sensorRandom['lat'];
  $sensor->lng = $sensorRandom['lng'];
  $sensor->create();
}



$measure = new Measurement($db);
$measureRandom = 0; // random creation of measurement
$measure->mid = $measureRandom['mid'];
$measure->sid = $measureRandom['sid'];
$measure->ts = $measureRandom['ts'];
$measure->fill_level = $measureRandom['fill_level'];
$measure->create();


function genRanAlphaNumString($length = 7) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function genRanAlphaString($length = 7) {
  $characters = 'abcdefghijklmnopqrstuvwxyz';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function genRanNumString($length = 7) {
  $characters = '0123456789';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
