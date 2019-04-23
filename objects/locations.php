<?php
class Location{
 
    // database connection and table name
    private $conn;
    private $table_name = "companies";
 
    // object properties
    public $sid;
    public $dill_level;
    public $lat; 
    public $lng; 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT lat, lng, sensors.sid, measure.fill_level FROM sensors INNER JOIN measure on measure.sid = sensors.sid GROUP BY measure.sid ORDER BY measure.ts";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
function readOne(){
 
    // query to read single record
    $query = "SELECT cid, name, latitude, longitude from companies where cid='$this->cid'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    return $stmt; 

}
}
?>