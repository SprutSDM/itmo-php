<?php
	/* 
	 *	tab width = 2
	 *  php version = v7.0.28-0ubuntu0.16.04.1
	 *
	 */
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpassword = "root";
  $dblink = mysqli_init();
  $dbname = "press_test_3";
  if (!mysqli_real_connect($dblink, $dbhost, $dbuser, $dbpassword)) {
    echo("Connect Error: ".mysqli_connect_error());
    exit();
  }


	function create_table($query) {
		global $dblink;
		$data = mysqli_query($dblink, $query);
  	if (!$data) {
    	echo("Error create table: ".mysqli_error($dblink)."<br>");
    	exit();
		}
		echo('Successful create table<br>');
  }

	function insert_data($query) {
		global $dblink;
		$data = mysqli_query($dblink, $query);
  	if (!$data) {
    	echo("Error insert data: ".mysqli_error($dblink)."<br>");
    	exit();
		}
		echo('Successful insert data<br>');
  }


	$data = mysqli_query($dblink, 'create database '.$dbname);
  if (!$data) {
    echo("Error create database: ".mysqli_error($dblink));
    exit();  
	}
	echo('Success create database<br>');

	$data = mysqli_query($dblink, 'use '.$dbname);
	if (!$data) {
    echo("Error use database: ".mysqli_error($dblink)."<br>");
    exit();  
	}
	echo('Successful use database<br>');

  $query = "CREATE TABLE `press` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `ind` int(16) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`) );";
	create_table($query);

	$query = "CREATE TABLE `post` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `ind` int(16) DEFAULT NULL,
  PRIMARY KEY (`id`) );";
	create_table($query);

	$query = "CREATE TABLE `maket` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `price` int(16) DEFAULT NULL,
  `id_author` int(16) DEFAULT NULL,
  `name_np` varchar(1024) DEFAULT NULL,
  `content` text,
	`id_genre` int(16) DEFAULT NULL,
  PRIMARY KEY (`id`) );";
	create_table($query);

	$query = "CREATE TABLE `edition` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `cnt` int(16) DEFAULT NULL,
  `id_maket` int(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_maket` (`id_maket`),
  CONSTRAINT `edition_ibfk_1` FOREIGN KEY (`id_maket`) REFERENCES `maket` (`id`) );";
	create_table($query);

	$query = "CREATE TABLE `maket_press` (
  `id_press` int(16) DEFAULT NULL,
  `id_maket` int(16) DEFAULT NULL,
  `price` int(16) DEFAULT NULL,
  `time` int(16) DEFAULT NULL,
  KEY `id_press` (`id_press`),
  KEY `id_maket` (`id_maket`),
  CONSTRAINT `maket_press_ibfk_1` FOREIGN KEY (`id_press`) REFERENCES `press` (`id`),
  CONSTRAINT `maket_press_ibfk_2` FOREIGN KEY (`id_maket`) REFERENCES `maket` (`id`) );";
	create_table($query);

	$query = "CREATE TABLE `edition_post` (
  `id_post` int(16) DEFAULT NULL,
  `id_edition` int(16) DEFAULT NULL,
  `conditions` text,
  KEY `id_post` (`id_post`),
  KEY `id_edition` (`id_edition`),
  CONSTRAINT `edition_post_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  CONSTRAINT `edition_post_ibfk_2` FOREIGN KEY (`id_edition`) REFERENCES `edition` (`id`) );";
	create_table($query);
	
	$query = "CREATE TABLE `author` (
  	`id` int(16) NOT NULL AUTO_INCREMENT,
  	`name` varchar(64) DEFAULT NULL,
  	PRIMARY KEY (`id`) );";
	create_table($query);

	$query = "CREATE TABLE `genre` (
  	`id` int(16) NOT NULL AUTO_INCREMENT,
  	`type` varchar(64) DEFAULT NULL,
  	PRIMARY KEY (`id`) );";
	create_table($query);

	$query = "INSERT INTO maket (price, id_author, id_genre, name_np, content) VALUES 
	(100, 1, 1, 'Apple', 'Apple Inc. ...'),
	(150, 2, 2, 'Tesla', 'The best cars ...'),
	(140, 3, 3, 'Microsoft', 'The best lugs ...'),
	(700, 4, 1, 'America', 'USA ...'),
	(0, 5, 2, 'How to become a builder?', 'You just have to quit school'),
	(0, 6, 3, 'How to become a cleaner?', 'You just need to quit school');";
	insert_data($query);

	$query = "INSERT INTO post (ind) VALUES 
	(197022),
	(197055),
	(197034),
	(197122),
	(197044),
	(197056),
	(197045);";
	insert_data($query);

	$query = "INSERT INTO press (ind, name) VALUES 
	(197023, 'The best Press'),
	(197045, 'Press number 1'),
	(197049, 'Fast Press');";
	insert_data($query);

	$query = "INSERT INTO edition (cnt, id_maket) VALUES 
	(10, 6),
	(11, 6),
	(8, 1),
	(8, 2),
	(1000, 3),
	(100500, 5),
	(75, 4),
	(40, 3),
	(89, 2);";
	insert_data($query);

	$query = "INSERT INTO maket_press (id_press, id_maket, price, time) VALUES 
	(1, 1, 15, 100),
	(1, 2, 40, 3),
	(2, 3, 4, 70),
	(3, 4, 5, 15),
	(2, 5, 17, 13),
	(1, 6, 200, 3);";
	insert_data($query);

	$query = "INSERT INTO edition_post (id_post, id_edition, conditions) VALUES 
	(1, 1, 'abacaba'),
	(2, 2, 'abacaba'),
	(3, 3, 'acabbab'),
	(4, 4, 'bbbaaaa'),
	(5, 5, 'qwerty'),
	(4, 6, 'ytrewq'),
	(2, 7, 'qywter'),
	(3, 8, 'tttrret'),
	(4, 9, 'qwerqwer');";
	insert_data($query);

	$query = "INSERT INTO author (name) VALUES 
	('Stive Jobs'),
	('Elon Musk'),
	('Bill Gates'),
	('Donald Trump'),
	('Ashot'),
	('Ravshan');";
	insert_data($query);

	$query = "INSERT INTO genre (type) VALUES 
	('Popular science'),
	('Autobiography'),
	('Fiction');";
	insert_data($query);

	echo('Successful create database '.$dbname.'!');
?>
