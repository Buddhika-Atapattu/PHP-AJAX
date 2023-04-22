<?php
class Database{
    private $con;
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "testdb";

    public function __construct(){
        $this->con = new mysqli(
            $this->hostname,
            $this->username,
            $this->password,
            $this->db
        );

        if(!$this->con->connect_error){
            $GLOBALS['con'] = $this->con;
        }
        else{
            echo "Database connection is interrupted!";
        }
    }
}