<?php
  	$dbhost = "localhost";
  	$dbuser = "root";
  	$dbpassword = "root";
  	$dblink = mysqli_init();
  	$dbname = "press_test_3";
  	if (!mysqli_real_connect($dblink, $dbhost, $dbuser, $dbpassword)) {
    	echo("Connect Error: ".mysqli_connect_error());
    	exit();
  	}

	function use_database() {
		global $dblink, $dbname;
		if (!mysqli_query($dblink, 'USE '.$dbname)) {
			echo("Error request: ".mysqli_error($dblink)."<br>");
			exit();
		}
		return 0;		
	}
?>
