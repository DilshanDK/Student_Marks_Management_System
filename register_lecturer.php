
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
$f="$2y$10$fjecQYeJX6FMX8ptxoBfweVAYg3772jI7cHUotOFsp2";
$pass= password_verify("ati",$f);

echo $hashed_password."<br>";
echo $pass;