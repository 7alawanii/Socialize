<?php
if (!isset($_SESSION)) {
	session_start();
}
$link = mysqli_connect("localhost", "root", "", "socialize");

?>