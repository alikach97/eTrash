<?php

class Sensor
{

  // database connection and table name
  private $conn;
  private $table_name = "sensors";

  // object properties
  public $sid;
  public $uid;
  public $lat;
  public $lng;

  // constructor with $db as database connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // read products
  public function read()
  {

    // select all query
    $u = $this->uid;
    $query = "SELECT sid, uid FROM " . $this->table_name . " WHERE uid = '$u'";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
  }

  public function create(){
      $uid = $this->uid;
      $lat = $this->lat;
      $lng = $this->lng;

      $query = " INSERT INTO sensors (uid, lat, lng) VALUE ($uid, $lat, $lng);";

      $stmt = $this->conn->prepare($query);

    // bind values
    $stmt->bindParam(":uid", $this->uid);
    $stmt->bindParam(":lat", $this->lat);
    $stmt->bindParam(":lng", $this->lng);

    // execute query
    if($stmt->execute()){
      return true;
    }

    return false;
  }

  public function getAllSids() {
    $query = " SELECT sid FROM sensors WHERE 1";
    $stmt = $this->conn->query($query);
    return $stmt->fetchAll();
  }
}