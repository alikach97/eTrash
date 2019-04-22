<?php
class Measurement{
 
    // database connection and table name
    private $conn;
    private $table_name = "measure";
 
    // object properties
    public $mid;
    public $sid;
    public $ts;
    public $fill_level;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                mid, sid, ts, fill_level
            FROM
                " . $this->table_name . " WHERE sid = '$this->sid' ORDER BY mid";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
function readOne(){
 
    // select all query
    $query = "SELECT
                mid, sid, ts, fill_level
            FROM
                " . $this->table_name . " WHERE sid = '$this->sid' ORDER BY mid DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
}