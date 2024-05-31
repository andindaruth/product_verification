<?php
$servername = "localhost";
$username = "root";
$password = ""; // replace with your MySQL password
$dbname = "product_verification";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
