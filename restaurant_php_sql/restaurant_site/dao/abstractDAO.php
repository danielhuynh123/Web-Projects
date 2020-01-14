<?php

//Used to throw mysqli_sql_exceptions for database
//errors instead or printing them to the screen.
mysqli_report(MYSQLI_REPORT_STRICT);

//Database settings and mysqli initialized here
class abstractDAO {
    protected $mysqli;
	
	/* EDIT DATABASE SETTINGS HERE*/
    protected static $servername = "localhost"; //Host address or IP
    protected static $username = "root"; //Database username
    protected static $password = "admin"; //Database password
    protected static $dbname = "wp_eatery"; //Name of database
    
	//mysqli object constructor
    function __construct() {
        try{
            $this->mysqli = new mysqli(self::$servername, self::$username, 
                self::$password, self::$dbname);
        }catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
	//Gets instance of mysqli object
    public function getMysqli(){
        return $this->mysqli;
        
    }
    
}

?>
