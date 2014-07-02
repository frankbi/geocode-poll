<?php


	// contains database login info
	include "creds.php";
	// all functions here
	include "functions.php";

	// selection made by user
	$ans = $_POST["ans"];
	// create connection to sql
	$con = connect_to_sql();
	// returns ip and other relevant info
	$data = get_ip();
	// insert data into sql
	insert_to_sql($con, $data, $ans);
	// return data as json
	echo return_results($con);


?>