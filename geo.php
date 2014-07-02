<?php

	include "creds.php";
	include "functions.php";


	function return_poll_results($c) {

		$result = mysqli_query($c, "
			SELECT ans, COUNT(*) AS ans_num
			FROM geo_korm_07012014
			GROUP BY ans;
		");

		$json = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($json, $row);
		}

		return json_encode($json);

	}

	function return_geocode_results($c) {

		$result = mysqli_query($c, "
			SELECT region_name, COUNT(*) AS region_name_count
			FROM geo_korm_07012014
			GROUP BY region_name; 
		");

		$json = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($json, $row);
		}

		return json_encode($json);

	}




	$con = connect_to_sql();
	$data = get_ip();
	insert_to_sql($con, $data, $_POST["ans"]);
	
	// insert_to_sql($con, $data, 0);

	// echo return_poll_results($con);

	echo return_geocode_results($con);


?>