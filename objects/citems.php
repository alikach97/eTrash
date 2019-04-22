<?php
class Citem{
 
    // database connection and table name
    private $conn;
    private $table_name = "CITEM";
 
    // object properties
    public $id;
    public $cid;
    public $iid;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                id ,cid, iid
            FROM
                CITEM;";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
  // used when signing in 
function readOne(){
 
    // query to read single record
    $query = "SELECT * from CITEMS where iid='$this->iid'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    return $stmt; 
}
  // used when filling up the update product form
function readTwo(){
 
    // query to read single record
    $query = "SELECT * from companies where cid='$this->cid'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    return $stmt; 
}
}
?>