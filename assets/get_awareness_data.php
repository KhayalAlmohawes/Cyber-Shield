<?php
require 'db_connect.php';
session_start();

$user_id = 6;

$sql = "SELECT ReportedStatus, FailureStatus FROM result WHERE MemberId = $user_id LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    header('Content-Type: application/json');
    echo json_encode(["ReportedStatus" => 0, "FailureStatus" => 0]);
}

$conn->close();
?>
