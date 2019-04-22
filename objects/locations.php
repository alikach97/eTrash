<?php
class Location{
 
    // database connection and table name
    private $conn;
    private $table_name = "companies";
 
    // object properties
    public $cid;
    public $name;
    public $latitude; 
    public $longitude; 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                cid, name, latitude, longitude, address, city, country
            FROM
                companies WHERE 1;";
 
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