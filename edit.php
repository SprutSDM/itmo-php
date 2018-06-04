<?php
	require "connection.php";
	$id = $_GET["id"];
	$id_author = $_GET["id_author"];

	if (isset($id_author)) {
		$title = addslashes($_GET["title"]);
		$content = addslashes($_GET["content"]);
		$price = addslashes($_GET["price"]);
		$id_genre = $_GET["id_genre"];
		$query = "UPDATE maket SET price=$price, id_author='$id_author', id_genre='$id_genre', content='$content', name_np='$title' WHERE id=$id;";
		mysqli_query($dblink, $query);
		header("Location: list.php");
		exit();
	}

	$query = "SELECT * FROM maket WHERE id=$id;";
	$data = mysqli_fetch_array(mysqli_query($dblink, $query));
	
	$query = "SELECT id, name FROM author;";
	$data_author = mysqli_query($dblink, $query);

	$query = "SELECT id, type FROM genre;";
	$data_genre = mysqli_query($dblink, $query);

	$id_author = $data['id_author'];
	$id_genre = $data['id_genre'];
	$title = $data['name_np'];
	$title = str_replace('"', '&quot;', $title);
	$content = $data['content'];
	$price = $data['price'];
	require "edit.html";
?>
