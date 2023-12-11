<?php
$servername = "localhost";
$username = "chuser";
$password = "";
$dbname = "ChristmasWebServer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
