<?php

	// return ip address and other location info
	function get_ip() {
		// hits api, gets ip address
		// rate limit is 10K/hour
		$str = file_get_contents("http://freegeoip.net/json/");
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

?>