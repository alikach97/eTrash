<?php
class Item{
 
    // database connection and table name
    private $conn;
    private $table_name = "ITEMS";
 
    // object properties
    public $iid;
    public $name;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                iid, name 
            FROM
                ITEMS;";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
function readOne(){
 
    // query to read single record
    $query = "SELECT * from ITEMS where iid='$this->iid'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->name = $row['name'];
}
  // used when filling up the update product form
function readTwo(){
 
    // query to read single record
    $query = "SELECT * from ITEMS where name='$this->name'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->iid = $row['iid']; 
}
}