<?php require_once('./dao/userDAO.php'); ?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Sign up for our newsletter!</h1>
        <?php
        //~~~~~~~~~~This section is for connecting to the database through userDAO. It also handles validation.~~~~~~~~~~
        try{
            $userDAO = new userDAO();
            $hasError = false; // Used as a control variable. If any errors occur, we will set it to true.
            $errorMessages = Array(); //Error messages for each field is stored in array.

			//~~~~~First stage of validation to check if values are set.~~~~~
            if(isset($_POST['customerName']) || 
                isset($_POST['phoneNumber']) ||
				isset($_POST['emailAddress']) ||
				isset($_POST['referrer'])) {
            
			//~~~~~~~~~~Second stage of validation~~~~~~~~~~
                if($_POST['customerName'] == ""){ //Checking if the posted value is empty.
                    $errorMessages['customerNameError'] = "Please enter a name."; //If empty, set error message in array.
                    $hasError = true; //Sets our control variable, hasError, to true.
                }

                if($_POST['phoneNumber'] == "" ||!preg_match("'^(([\+]([\d]{2,}))([0-9\.\-\/\s]{5,})|([0-9\.\-\/\s]{5,}))*$'",$_POST['phoneNumber'])){
                    $errorMessages['phoneNumberError'] = "Please enter a phone number.";
                    $hasError = true;
                }
				
				//BONUS* Phone Number validation using regex.
				if(!preg_match("'^(([\+]([\d]{2,}))([0-9\.\-\/\s]{5,})|([0-9\.\-\/\s]{5,}))*$'",$_POST['phoneNumber'])){
                    $errorMessages['phoneNumberError'] = "Phone number invalid. Please try again.";
                    $hasError = true;
                }
				
				if($_POST['emailAddress'] == ""){
					$errorMessages['emailAddressError'] = "Please enter an email address.";
					$hasError = true;
                }
				
				//BONUS* Email Address validation using regex.
				if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$_POST['emailAddress'])){
					$errorMessages['emailAddressError'] = "Invalid email. Please try again.";
					$hasError = true;
                }
				
				if(!isset($_POST['referrer'])){
					$errorMessages['referrerError'] = "Please select a referrer.";
					$hasError = true;
                }
				
				//Creating user object and inserting the user into our database.
				//ONLY runs hasError has not been triggered by error checking.
                if(!$hasError){
					//New object created using constructor. ID set as null so that database can auto-increment.
					$user = new User(null, $_POST['customerName'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['referrer']); 
					
					//BONUS* Email Address duplicate check using checkUser method.
					//This method executes a SELECT ALL statement WHERE the same emailAddress exists.
					//The method will return row count of the result. IF greater than 1, then email already exists.
					if($userDAO->checkUser($user) > 0){
						$errorMessages['emailAddressError'] = "Email already exists. Please try again.";
						$hasError = true; //Sets error back to true.
					}
					else{ //Only runs if the checkUser statement above returns false (0 matching emails).
						$addSuccess = $userDAO->addUser($user);
						echo '<h3>' . $addSuccess . '</h3>';
					}
                }
            }  

            //URL parameter is set if deleting a user is successful.
			//If that parameter is set, echo that it is successful.
            if(isset($_GET['deleted'])){
                if($_GET['deleted'] == 'true'){
                    echo '<h3>User Deleted</h3>';
                }
				else if($_GET['deleted'] == 'cancelled'){
                    echo '<h3>Deletion aborted - Failed to delete user.</h3>';
                }
				else if($_GET['deleted'] == 'false'){
                    echo '<h3>Could not find user to delete.</h3>';
                }
            }
        ?>
		
		<!--~~~~~~~~~~ Form that handles the fields necessary to create user object. ~~~~~~~~~~-->
        <form name="addUser" method="post" action="contact.php">
			<table>
				<tr>
					<td>Name:</td>
					<td>
					<input name="customerName" type="text" id="customerName">
					<!-- Display error if this field was unable to pass validation. -->
					<?php if(isset($errorMessages['customerNameError'])){ echo '<span style=\'color:red\'>' . $errorMessages['customerNameError'] . '</span>'; } ?>
					</td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td>
					<input type="text" name="phoneNumber" id="phoneNumber">
					<?php if(isset($errorMessages['phoneNumberError'])){ echo '<span style=\'color:red\'>' . $errorMessages['phoneNumberError'] . '</span>'; } ?>
					</td>
				</tr>
				<tr>
					<td>Email Address:</td>
					<td>
					<input type="text" name="emailAddress" id="emailAddress">
					<?php if(isset($errorMessages['emailAddressError'])){ echo '<span style=\'color:red\'>' . $errorMessages['emailAddressError'] . '</span>';} ?>
					</td>
				</tr>
				<tr>
					<!-- Value is set by checking a radio box-->
					<td>Referrer:</td>
					<td>Newspaper<input type="radio" name="referrer" id="referrer" value="newspaper">
						Radio<input type="radio" name='referrer' id='referrer' value='radio'>
						TV<input type='radio' name='referrer' id='referrer' value='TV'>
						Other<input type='radio' name='referrer' id='referrer' value='other'>
						<?php if(isset($errorMessages['referrerError'])){ echo '<span style=\'color:red\'>' . $errorMessages['referrerError'] . '</span>'; } ?>
					</td>
				</tr>
				<tr>
					<td><input type="submit" name="btnSubmit" id="btnSubmit" value="Sign up"></td>
					<td><input type="reset" name="btnReset" id="btnReset" value="Reset"></td>					
				</tr>
			</table>
		<?php
		} catch(Exception $e) {
			echo "<h3>An unexpected error occured. Please try again later.</h3>";
			echo '<p>' . $e->getMessage() . '</p>';            
		}
		?>
        </form>
    </body>
</html>
