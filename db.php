<?php
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "db7w6g82drvsnf");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>
