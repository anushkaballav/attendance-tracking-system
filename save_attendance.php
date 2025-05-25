<?php
include 'connection.php'; // Ensure your database connection is included

date_default_timezone_set('Asia/Kolkata'); // Set the correct timezone for your region

$action = $_POST['action'] ?? '';
$email = $_POST['email'] ?? '';
$entry_time = $_POST['entry_time'] ?? '';
$exit_time = $_POST['exit_time'] ?? '';

if ($action === 'mark_entry' && !empty($email)) {
    // Get current time for entry
    $current_time = date('Y-m-d H:i:s');  // Current time in 'YYYY-MM-DD HH:MM:SS' format
    echo "Current Entry Time: " . $current_time; // Debugging output

    // Get user_id from email
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Insert or update entry time
        $sql = "INSERT INTO attendance (user_id, attendance_date, entry_time) 
                VALUES (?, CURDATE(), ?) 
                ON DUPLICATE KEY UPDATE entry_time = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $current_time, $current_time);
        if ($stmt->execute()) {
            // After inserting the entry time, update status to 'Present'
            $sql = "UPDATE attendance SET status = 'Present' 
                    WHERE user_id = ? AND DATE(attendance_date) = CURDATE()";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            echo "Entry time recorded successfully at " . $current_time;
        } else {
            echo "Error recording entry time.";
        }
    } else {
        echo "User not found.";
    }
}

elseif ($action === 'mark_exit' && !empty($email)) {
    // Get current time for exit
    $current_time = date('Y-m-d H:i:s');  // Current time in 'YYYY-MM-DD HH:MM:SS' format
    echo "Current Exit Time: " . $current_time; // Debugging output

    // Get user_id from email
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Insert or update exit time
        $sql = "UPDATE attendance 
                SET exit_time = ? 
                WHERE user_id = ? AND DATE(attendance_date) = CURDATE()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $current_time, $user_id);
        if ($stmt->execute()) {
            echo "Exit time recorded successfully at " . $current_time;

            // After recording both entry and exit time, set status to 'Present'
            $sql = "UPDATE attendance 
                    SET status = 'Present' 
                    WHERE user_id = ? AND DATE(attendance_date) = CURDATE()";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
        } else {
            echo "Error recording exit time.";
        }
    } else {
        echo "User not found.";
    }
}

elseif ($action === 'mark_absent' && !empty($email)) {
    // Mark user as absent
    $sql = "UPDATE attendance 
            SET status = 'Absent', exit_time = NULL 
            WHERE user_id = ? AND DATE(attendance_date) = CURDATE()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "You have been marked as absent.";
    } else {
        echo "Error marking absent.";
    }
}
?>

