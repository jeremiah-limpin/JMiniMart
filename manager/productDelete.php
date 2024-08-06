<?php 
	require'dbconnection.php';

	$query = "DELETE FROM producttable WHERE productID=".$_GET['productID'];
	$statement = $connect->prepare($query);
	$statement->execute();
	header("location:productTable.php");

?>