<?php
// get database connection
include "./config/database.php";
include "./objects/users.php";
include "./objects/measurements.php";
include "./objects/sensors.php";


$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$sensor = new Sensor($db);
// set product property values
/*
  for ($i = 0; $i < 50 ; $i++) {
  $userRandom['name'] = genRanAlphaString();// random creation of $user
  $userRandom['username'] = genRanAlphaNumString();
  $userRandom['email'] = $userRandom['username'] . "@somemail.com";
  $userRandom['password'] = genRanAlphaNumString();
  $user->name = $userRandom["name"];
  $user->email = $userRandom["email"];
  $user->username = $userRandom["username"];
  $user->password = $userRandom["password"];
  $user->create();
}
*/
$arrUid = $user->getAllUids();
$arrUid = array_column($arrUid, 'uid');
$latitude = 33.;
$longitude = 35.;
$sensor = new Sensor($db);
for ($i =5; $i<54; $i++) {
 // $sensorRandom['uid'] = $arrUid[rand(0,sizeof($arrUid)-1)];
  $sensorRandom['lat'] = $latitude . rand(871213,899144);
  $sensorRandom['lng'] = $longitude . rand(472021,535262);

  $query = "UPDATE sensors SET lat = ?, lng = ? WHERE sid = ?;";
  $db->prepare($query);
  $db->execute([$sensorRandom['lat'], $sensorRandom['lng'], $i]);

  /*
  $sensor->uid = $sensorRandom['uid'];
  $sensor->lat = (float) $sensorRandom['lat'];
  $sensor->lng = (float) $sensorRandom['lng'];
  $sensor->create();
*/
}

/*
$arrSensor = $sensor->getAllSids();
$arrSensor = array_column($arrSensor,'sid');
//var_dump($arrSensor);
$measure = new Measurement($db);
foreach ($arrSensor as $sid) {
  $measureRandom['sid'] = $sid;
  $measureRandom['fill_level'] = rand(20, 100);
  $measure->sid = (int) $measureRandom['sid'];
  $measure->fill_level = $measureRandom['fill_level'];
  var_dump($measure->create());
}
*/
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
