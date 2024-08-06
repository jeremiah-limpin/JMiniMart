<?php 
	require'dbconnection.php';

	$query = "DELETE FROM cashiertable WHERE cashierID=".$_GET['cashierID'];
	$statement = $connect->prepare($query);
	$statement->execute();
	header("location:cashierTable.php");

?>