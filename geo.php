<?php


	// contains database login info
	include "creds.php";
	// all functions here
	include "functions.php";






	// query all distinct occurrences of each region_name
	function return_geocode_results($c) {

		$represented = mysqli_query($c, "
			SELECT region_name, COUNT(*)
			FROM geo_korm_07012014
			WHERE ans = "0"
			GROUP BY region_name
		");


		// query distinct occurrences
		$result = mysqli_query($c, "
			SELECT region_name, COUNT(*) AS region_name_count
			FROM geo_korm_07012014
			GROUP BY region_name; 
		");
		// init array to store all rows of result
		$output = array();
		// loop through results, adding each to output array
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($output, $row);
		}
		return $output;







	}












	// selection made by user
	// $ans = $_POST["ans"];
	$ans = "0";

	// create connection to sql
	$con = connect_to_sql();


	// returns ip and other relevant info
	$data = get_ip();


	// insert data into sql
	//insert_to_sql($con, $data, $ans);


	// return data as json
	// echo return_results($con);


?>