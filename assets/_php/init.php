<?php

date_default_timezone_set('America/Sao_Paulo');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'clickbus');
define('DB_CHARSET', 'utf8');

$connect = mysqli_connect("localhost", "root", "", "clickbus");

function DBConnect()
{
	$link = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($link));
	mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
	return $link;
}

include 'functions.php';
