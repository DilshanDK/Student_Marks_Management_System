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
$index_no = $_POST['index_no'];
$department = $_POST['department'];
$registered_year = $_POST['registered_year'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO `students`(`sName`, `indexNo`, `department`, `year`, `pass`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $index_no, $department, $registered_year, $hashed_password);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Unsuccessful!',
                    //     text: 'Insufficient stock for the requested quantity!'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                            window.location.href = 'login.php';
                    //     }
                    // });
                </script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();

