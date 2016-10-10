<?php

$conn_error = "Sorry, we're experiencing connection problems!";
$host = "localhost";
$user = "root";
$password = "";
$db = "batchdetails";

$link = mysqli_connect($host, $user, $password) or die($conn_error);
mysqli_select_db($link, $db);


?>