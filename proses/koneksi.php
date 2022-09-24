<?php
$conn = new mysqli("localhost", "root", "", "absensi");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
