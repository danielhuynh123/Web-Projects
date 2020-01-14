<?php

	class menuitem {
		private $itemName, $description, $price; //declaring three (3) private variables to be used later.
				
		function __construct($itemName, $description, $price) { //constructor that takes in the 3 private variables.
			//for these instances, we will call on the class "setters" to set "this" instance's variable.
			$this->setItemName($itemName); //ex. we call on setItemName, and pass $itemName.
			$this->setDescription($description);
			$this->setPrice($price);
		}

		function setItemName($itemName) { $this->itemName = $itemName;} //ex. setItemName takes in the $itemName we passed earlier, and sets it to this instance's $itemName.
		function getItemName(){ return $this->itemName;} //this getter simply returns "this" instance's itemName variable.
		function setDescription($description) { $this->description = $description;}
		function getDescription() { return $this->description;}
		function setPrice($price) { $this->price = $price;}
		function getPrice() { return $this->price;}		
	}
?>