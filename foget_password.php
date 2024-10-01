<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "marks";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generate a unique token
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expiration (1 hour)

    // Check if email exists in student or lecture table
    $sqlStudent = "SELECT * FROM student WHERE st_email = '$email'";
    $resultStudent = $conn->query($sqlStudent);

    $sqlLecture = "SELECT * FROM lecture WHERE lec_email = '$email'";
    $resultLecture = $conn->query($sqlLecture);

    if ($resultStudent->num_rows > 0) {
        // If it's a student
        $row = $resultStudent->fetch_assoc();
        $userType = 'student';
        $userId = $row['st_id'];
    } elseif ($resultLecture->num_rows > 0) {
        // If it's a lecturer
        $row = $resultLecture->fetch_assoc();
        $userType = 'lecture';
        $userId = $row['lec_id'];
    } else {
        echo "Email not found!";
        exit();
    }

    // Insert the token into the reset_password table (you can create this table)
    $sqlToken = "INSERT INTO password_resets (email, token, expires_at) VALUES ('$email', '$token', '$expiry')";
    $conn->query($sqlToken);

    // Send reset link via email
    $resetLink = "http://yourwebsite.com/reset_password.php?token=$token";

    // Note: Mail sending logic is simplified, adjust as per your mail server configuration
    $subject = "Password Reset Request";
    $message = "Click the link below to reset your password: $resetLink";
    $headers = "From: noreply@yourwebsite.com";

    if (mail($email, $subject, $message, $headers)) {
        echo "Password reset link has been sent to your email.";
    } else {
        echo "Failed to send reset email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="POST" action="">
        <label for="email">Enter your email address:</label><br>
        <input type="email" name="email" id="email" required><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
