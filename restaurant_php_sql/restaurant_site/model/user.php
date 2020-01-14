<?php
	//A User class created for inserting and retrieving data from the mailinglist table.
	class User{
		private $_id;
		private $customerName;
		private $phoneNumber;
		private $emailAddress;
		private $referrer;
		
		//Constructor with all fields. If creating a user from the contact form,
		//_id is passed to the constructor as NULL so that the database can auto-increment the ID.
		function __construct($_id, $customerName, $phoneNumber, $emailAddress, $referrer){
			$this->set_id($_id);
			$this->setCustomerName($customerName);
			$this->setPhoneNumber($phoneNumber);
			$this->setEmailAddress($emailAddress);
			$this->setReferrer($referrer);

		}
		
		//A set of setters and getters to access each variable:
		
		public function get_id(){
			return $this->_id;
		}
		
		public function set_id($_id){
			$this->_id = $_id;
		}
		
		public function getCustomerName(){
			return $this->customerName;
		}
		
		public function setCustomerName($customerName){
			$this->customerName = $customerName;
		}
		
		public function getPhoneNumber(){
			return $this->phoneNumber;
		}
		
		public function setPhoneNumber($phoneNumber){
			$this->phoneNumber = $phoneNumber;
		}

		public function getEmailAddress(){
			return $this->emailAddress;
		}
		
		public function setEmailAddress($emailAddress){
			$this->emailAddress = $emailAddress;
		}		
		
		public function getReferrer(){
			return $this->referrer;
		}
		
		public function setReferrer($referrer){
			$this->referrer = $referrer;
		}		
		
		
	}
?>