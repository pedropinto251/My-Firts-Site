<?php
	include_once "../../Actions/ActionUsers.php";

	$id = $_GET["id"];
	$state = $_GET["state"];

	$actionUsers = new ActionUsers;

	$actionUsers->actionDisable($id, $state);
?>