<?php
require_once('abstractDAO.php');
require_once('./model/user.php');

class userDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
	//Get users from database and add to array.
    public function getUsers(){
        $result = $this->mysqli->query('SELECT * FROM mailinglist');
        $mailinglist = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create and add new user object to array.
                $user = new User($row['_id'], $row['customerName'], $row['phoneNumber'], $row['emailAddress'], $row['referrer']);
                //store user in mailinglist array. While loop continues until all users added.
				$mailinglist[] = $user;
            }
            $result->free();
            return $mailinglist;
        }
        $result->free();
        return false;
    }
    
	//Gets user data of a single user from querying ID and then creates user object if user exists.
    public function getUser($_id){
        $query = 'SELECT * FROM mailinglist WHERE _id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $user = new User($temp['_id'], $temp['customerName'], $temp['phoneNumber'], $temp['emailAddress'], $temp['referrer']);
            $result->free();
            return $user;
        }
        $result->free();
        return false;
    }

	//Checks if email address of user already exists in database.
	//Returns row count. 0 means no matches, >0 means there is an existing email.
	public function checkUser($user){
		$query = 'SELECT * FROM mailinglist WHERE emailAddress = ?';
		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param('s', $user->getEmailAddress());
		$stmt->execute();
		$result = $stmt->get_result();
		$rowCount = mysqli_num_rows($result); //number of rows where duplicates exist
		
		return $rowCount;
	}

    public function addUser($user){

        if(!$this->mysqli->connect_errno){
            //Insert query with question marks as placeholder
            $query = 'INSERT INTO mailinglist VALUES (?,?,?,?,?)';
            $stmt = $this->mysqli->prepare($query);
			//binding parameters to our statement using pattern where i is int and s is String.
            $stmt->bind_param('issss', 
                    $user->get_id(), 
                    $user->getCustomerName(), 
                    $user->getPhoneNumber(),
					$user->getEmailAddress(),
					$user->getReferrer());

            $stmt->execute();
            
            if($stmt->error){
                return $stmt->error;
            } else {
                return $user->getCustomerName() . ' has been added to the mailing list!';
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
    
    public function deleteUser($_id){
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM mailinglist WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $_id);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function editUser($_id, $customerName, $phoneNumber, $emailAddress, $referrer){
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE mailinglist SET customerName = ?, phoneNumber = ?, emailAddress = ?, referrer = ? WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('ssi', $customerName, $phoneNumber, $emailAddress, $referrer, $_id);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return $stmt->affected_rows;
            }
        } else {
            return false;
        }
    }
}

?>
