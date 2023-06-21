<?php
class Database{
private $host = "localhost";
private $username = "root";
private $password = "";
private $database = "php_ecom";
private $conn ;
public function __construct()
{
$this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
if(!$this->conn)
{
die("connection failed" . mysqli_connect_error());
}
}
public function getConnection()
{
return $this->conn;
}
public function closeConnection()
{
mysqli_close($this->conn);
}

}
?>