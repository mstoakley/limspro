
<?php
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "limspro";

    public $conn = '';
    public function __construct()
    {
        try {
            $this-> conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo ("Connected successfully");
        } catch (PDOException $e) {
            echo ("Connection failed: " . $e->getMessage());
        }
    }
}

?>