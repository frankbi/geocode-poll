<?php

include "creds.php";
include "functions.php";


function return_from_sql($c) {

	$result = mysqli_query($c, "
		SELECT ans, COUNT(*) AS ans_num
		FROM geo_korm_07012014
		GROUP  BY ans;
	");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		print_r($row);
	}

}




$con = connect_to_sql();
$data = get_ip();
// insert_to_sql($con, $data, $_POST["ans"]);
insert_to_sql($con, $data, 0);

return_from_sql($con);


?>