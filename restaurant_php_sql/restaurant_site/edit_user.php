<?php
require_once('./dao/userDAO.php');

//This file is called from mailing_list.php with an added URL parameter for _id.
if(isset($_GET['_id']) || is_numeric($_GET['_id'])){

    $userDAO = new userDAO(); //Creating data access object.
    $user = $userDAO->getUser($_GET['_id']); //Get user that matches the ID value from GET
	
    if($user){ //if user exists
		$customerName = $user->getCustomerName(); //Declaring and initializing variable to user's name.
		$_id = $user->get_id(); //Declaring and initializing variable to user's id.
?>
		<!-- Warning that clearly displays the customer's name and ID. Asks to confirm deletion.-->
		<script type="text/javascript">
			if (confirm("Delete \"" + "<?php echo $customerName; ?>\" " + "at" + " ID \"<?php echo $_id; ?>\"" + "? This change will be permanent.") == true){
					location.href = "process_user.php?action=delete&_id=<?php echo $user->get_id();?>"
			} else { location.href = "contact.php?deleted=cancelled" }
		</script>
<?php
	}
	else{ //all else, send user back to contact page.
	header('Location:contact.php?deleted=false');
	exit;
}

} ?>