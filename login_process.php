

<?php
// Start session
session_start();

// Database connection (assuming you're using MySQL)
$host = 'localhost';
$db = 'student_marks_ms';
$user = 'root';
$pass = '';

// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db";

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

// Get form data
$userType = $_POST['userType'];
$username = $_POST['username'];
$password = $_POST['password'];

// Check if student or lecturer
if ($userType === 'student') {
    // For students: Validate email or index number
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = :username OR indexNo = :username");
    $stmt->execute(['username' => $username]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        // Set session for logged-in student
        $_SESSION['user_id'] = $student['indexNo'];
        $_SESSION['user_type'] = 'student';
        header('Location: student_dashboard.php');  // Redirect to student's page
        exit();
    } else {
        echo "Invalid email or index number.";
    }

} elseif ($userType === 'lecturer') {
    // For lecturers: Validate email and hashed password
    $stmt = $pdo->prepare("SELECT * FROM lecturers WHERE email = :username");
    $stmt->execute(['username' => $username]);
    $lecturer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($lecturer && password_verify($password, $lecturer['password'])) {
        // Set session for logged-in lecturer
        $_SESSION['user_id'] = $lecturer['id'];
        $_SESSION['user_type'] = 'lecturer';
        header('Location: lecturer_dashboard.php');  // Redirect to lecturer's page
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
