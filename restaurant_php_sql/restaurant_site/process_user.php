<?php
require_once('./dao/userDAO.php');
    
    if($_GET['action'] == "delete"){
        if(isset($_GET['_id']) && is_numeric($_GET['_id'])){
            $userDAO = new userDAO();
            $success = $userDAO->deleteUser($_GET['_id']);
            echo $success;
            if($success){
                header('Location:contact.php?deleted=true');
            } else {
                header('Location:contact.php?deleted=false');
            }
        }
    }
?>
