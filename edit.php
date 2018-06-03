<?php
	require "connection.php";
	$id = $_GET["id"];
	$author = $_GET["author"];

	if (isset($author)) {
		$title = $_GET["title"];
		$content = $_GET["content"];
		$price = $_GET["price"];
		$query = "UPDATE maket SET price=$price, name_author='$author', content='$content', name_np='$title' WHERE id=$id;";
		mysqli_query($dblink, $query);
		header("Location: list (copy).php");
		exit();
	}

	$query = "SELECT price, name_author, name_np, content FROM maket WHERE id=$id;";
	$data = mysqli_fetch_array(mysqli_query($dblink, $query));

	$author = $data['name_author'];
	$title = $data['name_np'];
	$content = $data['content'];
	$price = $data['price'];
	require "edit.html";
?>
