
<?php

try {
    require "database_connection.php";
 } catch (Exception $e) {
     // Handle connection error
     die("Connection failed: " . $e->getMessage());
 }

// Retrieve and sanitize form data

$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
echo $hashed_password;
// Execute the statement
// if ($stmt->execute()) {
//     echo "<script>
//                     // Swal.fire({
//                     //     icon: 'error',
//                     //     title: 'Unsuccessful!',
//                     //     text: 'Insufficient stock for the requested quantity!'
//                     // }).then((result) => {
//                     //     if (result.isConfirmed) {
//                             window.location.href = 'login.php';
//                     //     }
//                     // });
//                 </script>";
// } else {
//     echo "Error: " . $stmt->error;
// }

// // Close connections
// $stmt->close();
// $conn->close();

