<?php
//Mailing List retrieves and displays a table of users from the database.
//Users can also be deleted here.

	require_once('./dao/userDAO.php');

	//Create array of users that are retrieved from the database.
	$users = $userDAO->getUsers();
		if($users){ //If users exist
			echo '<table border=\'1\'>';
			echo '<tr><th>ID</th><th>Name</th><th>Phone Number</th><th>Email Address</th><th>Referrer</th></tr>';
			foreach($users as $user){
				echo '<tr>';
				echo '<td>' . $user->get_id() . '</td>';
				echo '<td>' . $user->getCustomerName() . '</td	>';
				echo '<td>' . $user->getPhoneNumber() . '</td>';
				echo '<td>' . $user->getEmailAddress() . '</td>';
				echo '<td>' . $user->getReferrer() . '</td>';
				echo '</tr>';
			}
			echo '</table></br>';
		}
?>

<!-- Function takes user's input from below and appends it to a URL -->
<script>
    function sendLink()
    {
		var url = "edit_user.php?_id=" + document.getElementById("userInput").value;
		location.href = url;
		return false;
    }
</script>

<!-- User is asked to enter the ID that they want to delete. This value is passed to the above function.-->
<form method="POST" name="deleteID" id="deleteID" onSubmit="return sendLink();">
    Delete User ID: <input type="text" name="userInput" id="userInput">
    <input type="submit" value="Delete">
</form>


