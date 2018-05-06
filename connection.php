<?php
	$dbhost = "mysql";
  $dbuser = "root";
  $dbpassword = "123456";
  $dblink = mysqli_init();
  $dbname = "k1340_zak";
  if (!mysqli_real_connect($dblink, $dbhost, $dbuser, $dbpassword)) {
    echo("Connect Error: ".mysqli_connect_error());
    exit();
  }
	if (!mysqli_query($dblink, 'USE '.$dbname)) {
    echo("Error request: ".mysqli_error($dblink)."<br>");
    exit();
	}
?>
