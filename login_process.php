<?php
// Start session
session_start();


try {
    require "database_connection.php";
} catch (Exception $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}


// Get form data
$userType = $_POST['userType'];
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if ($userType === 'student') {

    try {
        $sql = "SELECT * FROM student WHERE st_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['st_pass']) {
                $_SESSION['username'] = $username;
                header("Location:student_dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid index number or user type";
        }
    } catch (Exception $e) {
        echo "invalid student table";
    }
} elseif ($userType === 'lecturer') {
    try {
        $sql = "SELECT * FROM lecture WHERE lec_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['lec_pass']) {
                $_SESSION['username'] = $username;
                header("Location:lecturer_dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid index number or user type";
        }
    } catch (Exception) {
        echo "invalid lecture table";
    }
} else {
    echo "Invalid user type.";
}
