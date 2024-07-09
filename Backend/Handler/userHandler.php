<?php
	include_once "../Actions/ActionUsers.php";
	
	
	if(isset( $_POST["method"] )) {
		$id = $_POST["id"];
		$permission = $_POST["permission"];
		$actionUsers = new ActionUsers;
	    $actionUsers->changePermissions($id, $permission);
	}
?>