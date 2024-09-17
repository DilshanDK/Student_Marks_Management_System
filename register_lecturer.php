<script src="sweetalert2.all.min.js"></script>

<?php
// Database configuration
$servername = "localhost";
$username = "root"; // default username for MySQL
$password = ""; // default password for MySQL (empty in most cases)
$dbname = "student_marks_ms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$name = $_POST['name'];
$email = $_POST['email'];
$department = $_POST['department'];
$subject = $_POST['subject'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO lecturers (name, email, department, subject, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $department, $subject, $hashed_password);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>Swal.fire({
  title: 'Good job!',
  text: 'You clicked the button!',
  icon: 'success'
});</script>";

    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>