<?php
class Sensor{
 
    // database connection and table name
    private $conn;
    private $table_name = "sensors";
 
    // object properties
    public $sid;
    public $uid;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
  	$u =$this->uid; 
    $query = "SELECT
                sid, uid
            FROM
                " . $this->table_name . " WHERE uid = '$u'";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
}