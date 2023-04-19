<?php
$servername = "localhost";
$username = "antonov";
$password = "Antikonti1";
$dbname = "links_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
