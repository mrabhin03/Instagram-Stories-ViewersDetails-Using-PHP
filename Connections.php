<?php 
$server_name='localhost';
$user='root';
$password='';
$database='instastories';

$conn = new mysqli($server_name, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>