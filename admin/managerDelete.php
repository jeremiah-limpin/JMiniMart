<?php 
	require'dbconnection.php';

	$query = "DELETE FROM managertable WHERE managerID=".$_GET['managerID'];
	$statement = $connect->prepare($query);
	$statement->execute();
	header("location:managerTable.php");

?>