<?php
class Company{
 
    // database connection and table name
    private $conn;
    private $table_name = "companies";
 
    // object properties
    public $cid;
    public $name;
    public $email;
    public $username;
    public $password;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function read(){
 
    // select all query
    $query = "SELECT
                cid, name, email, username, password, latitude, longitude
            FROM
                companies;";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
  // used when signing in 
function readOne(){
 
    // query to read single record
    $query = "SELECT * from companies where username='$this->username' AND password = '$this->password'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->cid = $row['cid']; 
    $this->name = $row['name'];
    $this->email = $row['email'];
    $this->latitude = $row['latitude']; 
    $this->longitude = $row['longitude'];
}
  // used when filling up the update product form
function readTwo(){
 
    // query to read single record
    $query = "SELECT * from companies where username='$this->username'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->cid = $row['cid']; 
    $this->name = $row['name'];
    $this->email = $row['email'];
    $this->password = $row['password'];
    $this->latitude = $row['latitude'];
    $this->longitude = $row['longitude']; 
}
}