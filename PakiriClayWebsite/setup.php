<?php
$servername = "localhost";
$serverusername = "pakiriClay_user";
$serverpassword = "!acomputer150";
$database = "pakiriclay_database";

// Create connection
$conn = new mysqli($servername, $serverusername, $serverpassword, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>