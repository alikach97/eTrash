<?php
class Database{
    // specify your own database credentials
    private $host = "db761190788.hosting-data.io";
    private $db_name = "db761190788";
    private $username = "dbo761190788";
    private $password = "reda3913@R";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>