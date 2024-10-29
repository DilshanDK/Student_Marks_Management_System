<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index1.php");
    exit;
}

try {
    require "database_connection.php";
    require 'vendor/autoload.php'; // Uncomment if you decide to use PhpSpreadsheet
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

use PhpOffice\PhpSpreadsheet\IOFactory;

// Initialize variables
$selectedYear = $_POST['year'] ?? '';
$selectedSemester = $_POST['semester'] ?? '';
$searchTerm = trim($_POST['search'] ?? '');
$importMessage = '';

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

// Handle Excel file upload
if (isset($_POST['upload'])) {
    $file = $_FILES['excel_file'];

    // Check for upload errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        $filePath = $file['tmp_name'];

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Read each row in the worksheet
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $data = [];

            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }

            // Assuming the Excel columns are:
            // Student ID | Name | Marks 1 | Marks 2 | Marks 3
            if (count($data) >= 5) {
                $studentId = $conn->real_escape_string($data[0]);
                $name = $conn->real_escape_string($data[1]);
                $marks1 = $conn->real_escape_string($data[2]);
                $marks2 = $conn->real_escape_string($data[3]);
                $marks3 = $conn->real_escape_string($data[4]);

                // Insert data into the database
                $insertSql = "INSERT INTO students (student_id, name, marks_1, marks_2, marks_3) VALUES ('$studentId', '$name', '$marks1', '$marks2', '$marks3') ON DUPLICATE KEY UPDATE name='$name', marks_1='$marks1', marks_2='$marks2', marks_3='$marks3'";

                if ($conn->query($insertSql) === TRUE) {
                    $importMessage = "Data imported successfully.";
                } else {
                    $importMessage = "Error importing data: " . $conn->error;
                }
            }
        }
    } else {
        $importMessage = "Error uploading file.";
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
            margin: 5px 0 0 0;
            font-size: 35px;
            cursor: pointer;

        }

        .nav-icon:hover {
            font-size: 45px;
            transition: ease-in 0.2s;

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
            border-radius: 10px;
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

        .semester-upload-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px;
        }

        .semester-select,
        .file-upload {
            flex: 1;
            margin-right: 20px;
        }

        .file-upload {
            margin-right: 0;
            /* Remove margin for last item */
        }

        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-select,
        .file-input {
            width: 80%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .btn-upload {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 65%;
            margin: 5px 50px;
            transition: background-color 0.3s;
            /* Smooth transition */
        }

        .btn-upload:hover {
            background-color: #45a049;
            /* Darker shade on hover */
        }

        .import-message {
            margin-top: 10px;
            color: #d9534f;
            /* Color for error messages */
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .semester-upload-container {
                flex-direction: column;
            }

            .semester-select,
            .file-upload {
                margin-right: 0;
                margin-bottom: 15px;
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
                <p>Lecture: <?php echo htmlspecialchars($lecName); ?></p>
                <p>Subject: <?php echo htmlspecialchars($subjectName); ?></p>
            </div>
            <form class="group" method="POST" action="">
                <button class="btn btn-logout" name="logout" type="submit">Logout</button>
            </form>

            <!-- Page Navigator Icon -->
            <span class="nav-icon" style="width:50px;" id="nav-icon">&#9776;</span>

            <!-- Popup Menu -->
            <div class="popup-menu" id="popup-menu">
                <a href="lecturer_dashboard.php">Dashboard</a>
                <a href="data_insert.php">Data Insert</a>
            </div>
        </div>
    </div>

    <div class="dashboard">
        <div style="width: 70%; height:250px;">

        </div>
        <!-- Year and Semester Selection Form -->
        <form method="POST" action="" style="display: flex;">
            <div>
                <label for="year">Select Register Year</label>
                <select class="form-select" name="year" id="year">
                    <option value="">All Years</option>
                    <?php
                    for ($year = 2020; $year <= 2040; $year++) {
                        $selected = ($selectedYear == $year) ? 'selected' : '';
                        echo "<option value='$year' $selected>$year</option>";
                    }
                    ?>
                </select>
                <label for="semester" class="form-label">Select Semester</label>
                <select class="form-select" name="semester" id="semester">
                    <option value="">Select Semester</option>
                    <?php
                    // Fetch semesters
                    $sqlSemesters = "SELECT period_id FROM `period`";
                    $resultSemesters = $conn->query($sqlSemesters);

                    if ($resultSemesters->num_rows > 0) {
                        while ($row = $resultSemesters->fetch_assoc()) {
                            $periodId = $row['period_id'];

                            // Determine the year and semester based on period_id
                            $year = floor(($periodId - 1) / 2) + 1; // Calculate year
                            $sem = ($periodId % 2 == 0) ? '2nd' : '1st'; // Determine semester
                    
                            // Format the output
                            echo "<option value='{$periodId}'>Year {$year} {$sem} Semester</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="semester-upload-container">
                <div class="file-upload">
                    <!-- Excel Upload Form -->
                    <form method="POST" enctype="multipart/form-data">
                        <label for="excel_file" class="form-label">Upload Excel File:</label>
                        <input type="file" name="excel_file" accept=".xlsx, .xls" required class="file-input">
                        <button type="submit" name="upload" class="btn-upload">Upload</button>
                    </form>

                    <?php if ($importMessage): ?>
                        <div class="import-message"><?php echo $importMessage; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('nav-icon').onclick = function () {
            var menu = document.getElementById('popup-menu');
            menu.style.display = menu.style.display === 'none' || menu.style.display === '' ? 'block' : 'none';
        };
    </script>
</body>

</html>