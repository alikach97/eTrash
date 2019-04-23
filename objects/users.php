<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $uid;
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
                uid, name, email, username, password
            FROM
                users;";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
  function create(){
    $n = $this->name; 
    $e = $this->email;
    $u = $this->username; 
    $p=$this->password;
    
    // query to insert record
    $query = "INSERT INTO users (name,email,username,password) values ('$n', '$e', '$u', '$p'); ";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->password=htmlspecialchars(strip_tags($this->password));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":password", $this->password);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;

}
  // used when signing in 
function readOne(){
 
    // query to read single record
    $query = "SELECT * from users where username='$this->username' AND password = '$this->password'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->uid = $row['uid']; 
    $this->name = $row['name'];
    $this->email = $row['email'];
}
  // used when filling up the update product form
function readTwo(){
 
    // query to read single record
    $query = "SELECT * from users where username='$this->username'";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query ); 
    // execute query
    $stmt->execute();
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->uid = $row['uid']; 
    $this->name = $row['name'];
    $this->email = $row['email'];
    $this->password = $row['password']; 
}

public function getAllUids() {
      $query = " SELECT uid FROM users WHERE 1";
      $stmt = $this->conn->query($query);
      return $stmt->fetch();
}
}