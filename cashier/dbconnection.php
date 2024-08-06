<?php
	try{
		//this is the connection file to the database
		$connect = new PDO('mysql:host=localhost;dbname=salesdb','root','');
    	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $error){
		echo $error->getMessage();
	}
	
?>