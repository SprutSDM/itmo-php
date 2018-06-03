<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "root";
	$dblink = mysqli_init();
	$dbname = "press_test_2";
	if (!mysqli_real_connect($dblink, $dbhost, $dbuser, $dbpassword)) {
		echo("Connect Error: ".mysqli_connect_error());
		exit();
	}
	if (!mysqli_query($dblink, 'USE '.$dbname)) {
		echo("Error request: ".mysqli_error($dblink)."<br>");
		exit();
	}
?>
