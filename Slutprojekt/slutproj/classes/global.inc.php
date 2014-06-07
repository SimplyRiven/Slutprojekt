<?php

require_once('config/config.php');

function get_pdo() {

	try {

		$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

		$dsn = 'mysql:host='. DB_HOST .';dbname='.DB_NAME.';charset=utf8mb4';
		$pdo = new PDO($dsn,  DB_USER, DB_PASS, $attr);

		return $pdo;

	} catch (PDOException $e) {

    	echo "<script type=\"text/javascript\">alert(\"Connection failed: ".$e->getMessage()."\")</script>";

	}
}

?>