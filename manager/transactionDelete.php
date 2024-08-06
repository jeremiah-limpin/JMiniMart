<?php 
	require'dbconnection.php';

	$query = "DELETE FROM transactiontable WHERE transactionID=".$_GET['transactionID'];
	$statement = $connect->prepare($query);
	$statement->execute();
	header("location:transactionTable.php");

?>