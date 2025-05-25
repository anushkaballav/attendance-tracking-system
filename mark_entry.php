<?php
require_once 'connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user id
$today_date = date('Y-m-d');      // Get today's date
$current_time = date('H:i:s');    // Get the current time (entry time)

// Check if the user has already marked an entry time for today
$stmt = $conn->prepare("SELECT * FROM attendance WHERE user_id = ? AND attendance_date = ?");
$stmt->bind_param("is", $user_id, $today_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update the entry time if the user already has a record for today
    $stmt = $conn->prepare("UPDATE attendance SET entry_time = ? WHERE user_id = ? AND attendance_date = ?");
    $stmt->bind_param("sis", $current_time, $user_id, $today_date);
    $stmt->execute();
    echo "Entry time marked successfully!";
} else {
    // Insert a new record with entry time if no entry exists for today
    $stmt = $conn->prepare("INSERT INTO attendance (user_id, attendance_date, entry_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $today_date, $current_time);
    $stmt->execute();
    echo "Entry time recorded successfully!";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
