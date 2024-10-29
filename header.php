<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index1.php");
    exit;
}

try {
    require "database_connection.php";
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

$selectedYear = $_POST['year'] ?? '';
$searchTerm = trim($_POST['search'] ?? '');

// Fetch lecture and subject information
$sqlSubId = "SELECT `sub_id` FROM `subject_lecture` WHERE `lec_id`='{$_SESSION['username']}'";
$subId = $conn->query($sqlSubId)->fetch_assoc()['sub_id'];

$sqlSubject = "SELECT sub_name FROM subject WHERE sub_id='$subId'";
$subjectName = $conn->query($sqlSubject)->fetch_assoc()['sub_name'];

$sqlLecName = "SELECT `lec_name` FROM `lecture` WHERE `lec_id`='{$_SESSION['username']}'";
$lecName = $conn->query($sqlLecName)->fetch_assoc()['lec_name'];

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Update marks logic
if (isset($_POST['update'])) {
    $marksAttempt1 = $_POST['mark_1'];
    $marksAttempt2 = $_POST['mark_2'];
    $marksAttempt3 = $_POST['mark_3'];
    $studentId = $_POST['student_id'];

    if (
        ($marksAttempt1 <= 100 || $marksAttempt1 === '') &&
        ($marksAttempt2 <= 100 || $marksAttempt2 === '') &&
        ($marksAttempt3 <= 100 || $marksAttempt3 === '')
    ) {
        $updateSql = "UPDATE `attempt_marks` 
                      SET `attempt_1`='$marksAttempt1', 
                          `attempt_2`='$marksAttempt2', 
                          `attempt_3`='$marksAttempt3' 
                      WHERE `st_id`='$studentId' AND `sub_id`='$subId'";

        if ($conn->query($updateSql) === TRUE) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Marks updated successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update marks.',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>";
        }
    } else {
        echo "<script>alert('Invalid marks. Please enter marks between 0 and 100.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Lecture Dashboard</title>
    <style>
        .header-right {
            position: relative;
        }

        .nav-icon {
            font-size: 25px;
            cursor: pointer;
        }

        .popup-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 200px;
            z-index: 10;
        }

        .popup-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .popup-menu a:hover {
            background-color: #f0f0f0;
        }
    </style>

</head>

<body>
    <div class="header">
        <div class="header-left">
            <img src="sliate.jpeg" alt="Logo">
        </div>
        <div class="header-title">Sliate Marks Dashboard</div>
        <div class="header-right">
            <div class="details">
                <p>Lecture: <?php echo $lecName; ?></p>
                <p>Subject: <?php echo htmlspecialchars($subjectName); ?></p>
            </div>
            <form class="group" method="POST" action="">
                <button class="btn btn-logout" name="logout" type="submit">Logout</button>
            </form>

            <!-- Page Navigator Icon -->
            <span class="nav-icon" id="nav-icon">&#9776;</span>

            <!-- Popup Menu -->
            <div class="popup-menu" id="popup-menu">
                <a href="lecturer_dashboard.php">Dashboard</a>
                <a href="data_insert.php">Data Insert</a>
                <!-- <a href="marks.php">Marks</a>
                <a href="reports.php">Reports</a> -->
            </div>
        </div>
    </div>

   
    <script>
        // Toggle popup menu visibility
        const navIcon = document.getElementById('nav-icon');
        const popupMenu = document.getElementById('popup-menu');

        navIcon.addEventListener('click', () => {
            popupMenu.style.display = popupMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Close popup if clicked outside
        document.addEventListener('click', (event) => {
            if (!popupMenu.contains(event.target) && event.target !== navIcon) {
                popupMenu.style.display = 'none';
            }
        });
    </script>
</body>

</html>