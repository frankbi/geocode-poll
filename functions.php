<?php


	// return ip address and other location info
	function get_ip() {
		// hopefully, get ip
		$ip = $_SERVER["REMOTE_ADDR"];
		// hit api, rate limit is 10K/hour
		$str = file_get_contents("http://freegeoip.net/json/{$ip}");
		// returns as associative array
		$json = json_decode($str, true);
		return $json;
	}

	// connect to db and return connection
	function connect_to_sql() {
		// bring in log-in info from creds.php
		global $host, $user, $pwd, $db;
		$c = mysqli_connect($host, $user, $pwd, $db);
		// ensure connection is made
		// or return false
		if (mysqli_connect_errno()) {
			return false;
		}
		return $c;
	}

	// given connection parameter, data, and poll ans,
	// insert into database and return nothing
	function insert_to_sql($c, $d, $a) {
		// insert query
		mysqli_query($c, "
			INSERT INTO geo_korm_07012014
				( ans, ip, country_code,
				region_code, region_name, city,
				latitude, longitude, metro_code,
				area_code )
			VALUES
				( '{$a}', '{$d["ip"]}', '{$d["country_code"]}',
				'{$d["region_code"]}', '{$d["region_name"]}', '{$d["city"]}',
				'{$d["latitude"]}', '{$d["longitude"]}', '{$d["metro_code"]}',
				'{$d["area_code"]}' );
		");
	}

	// query all distinct occurrences of selections
	function return_poll_results($c) {
		// query distinct occurrences
		$result = mysqli_query($c, "
			SELECT ans, COUNT(*) AS ans_num
			FROM geo_korm_07012014
			GROUP BY ans;
		");
		// init array to store all rows of result
		$output = array();
		// loop through results, adding each to output array
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			array_push($output, $row);
		}
		return $output;
	}


	// TODO
	// calls for functions to return geo and poll data
	// combines into one json and returns via ajax
	function return_results($c) {
		// array to be json_encoded
		$result = array();
		// push poll results to array to be returned
		array_push($result, return_poll_results($c));
		// push geo results to array to be returned
		array_push($result, return_geocode_results($c));
		return json_encode($result);
	}



?>