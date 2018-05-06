<?php
	require "index.html";
	require "connection.php";

	$url_author = $_GET["author_name"];
	$url_press = $_GET["press_name"];

	if (!isset($url_author) and !isset($url_press))
		exit();

	// Запрос к базе данных
	$query = 'SELECT name, ind, name_np, name_author, maket.price AS mp, content, time, maket_press.price 
						AS mpp FROM maket, maket_press, press 
						WHERE id_press = press.id AND id_maket = maket.id';

	if (strlen($url_author))
		$query .= " AND (name_author REGEXP '$url_author')";	
	if (strlen($url_press))
		$query .= " AND (name REGEXP '$url_press')";

	$query .= " ORDER BY name;";

	$data = mysqli_query($dblink, $query);
  if (!$data) {
    echo("Error request: ".mysqli_error($dblink)."<br>");
    exit();
	}
	
	require "print.php";
?>
