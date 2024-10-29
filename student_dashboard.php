<?php
session_start();

try {
    require "database_connection.php";
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Ensure the user is logged in
$studentId = $_SESSION['username'];

// Fetch the student details
$stmtStudent = $conn->prepare("SELECT `st_name` FROM `student` WHERE `st_id` = ?");
$stmtStudent->bind_param("s", $studentId);
$stmtStudent->execute();
$resultStudent = $stmtStudent->get_result();
if ($resultStudent->num_rows == 0) {
    die("Student not found.");
}
$student = $resultStudent->fetch_assoc();

// Get selected period, default to 0 (All Semesters)
$selectedPeriod = isset($_POST['period']) ? (int) $_POST['period'] : 0;

// Fetch all subjects based on selected period
if ($selectedPeriod == 0) {
    // If "All Semesters" is selected, don't filter by `per_id`
    $sqlAllSub = "SELECT sb.sub_id, sb.per_id FROM `student` st
                    JOIN `subject` sb ON sb.dep_id = st.st_dep
                    WHERE st.st_id = ?";
    $stmtAllSub = $conn->prepare($sqlAllSub);
    $stmtAllSub->bind_param("s", $studentId);
} else {
    // Filter by specific period
    $sqlAllSub = "SELECT sb.sub_id, sb.per_id FROM `student` st
                    JOIN `subject` sb ON sb.dep_id = st.st_dep
                    WHERE st.st_id = ? AND sb.per_id = ?";
    $stmtAllSub = $conn->prepare($sqlAllSub);
    $stmtAllSub->bind_param("si", $studentId, $selectedPeriod); // Bind period as integer
}

$stmtAllSub->execute();
$resultAllSub = $stmtAllSub->get_result();

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php"); // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesSt.css" type="text/css">
    <title>Student Dashboard</title>
</head>

<body>

    <!-- Header Section -->
    <div class="header">
        <div class="header-left">
            <img src="sliate.jpeg" alt="Logo">
        </div>
        <div class="header-title">Sliate Marks Dashboard</div>
        <div class="header-right">
            <div class="details">
                <p>Name: <?php echo ucfirst(htmlspecialchars($student['st_name'])); ?></p>
                <p>Index: <?php echo htmlspecialchars($studentId); ?></p>
            </div>
            <form class="group" method="POST" action="">
                <button class="btn btn-logout" name="logout" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- Dashboard Section -->
    <div class="dashboard">
        <h2>Marks Overview</h2>
        <form class="fil" method="POST" action="">
            <div>
                <label for="period">Select Semester:</label>
                <select name="period" id="period">
                    <option value="0" <?php echo ($selectedPeriod == 0) ? 'selected' : ''; ?>>All Semesters</option>
                    <option value="1" <?php echo ($selectedPeriod == 1) ? 'selected' : ''; ?>>1st Year First Semester</option>
                    <option value="2" <?php echo ($selectedPeriod == 2) ? 'selected' : ''; ?>>1st Year Second Semester</option>
                    <option value="3" <?php echo ($selectedPeriod == 3) ? 'selected' : ''; ?>>2nd Year First Semester</option>
                    <option value="4" <?php echo ($selectedPeriod == 4) ? 'selected' : ''; ?>>2nd Year Second Semester</option>
                    <option value="5" <?php echo ($selectedPeriod == 5) ? 'selected' : ''; ?>>3rd Year First Semester</option>
                    <option value="6" <?php echo ($selectedPeriod == 6) ? 'selected' : ''; ?>>3rd Year Second Semester</option>
                    <option value="7" <?php echo ($selectedPeriod == 7) ? 'selected' : ''; ?>>4th Year First Semester</option>
                    <option value="8" <?php echo ($selectedPeriod == 8) ? 'selected' : ''; ?>>4th Year Second Semester</option>
                </select>
            </div>
            <button type="submit" class="btn btn-filter">Filter</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Subject ID</th>
                    <th>First Attempt Year</th>
                    <th>First Attempt Mark</th>
                    <th>Second Attempt Year</th>
                    <th>Second Attempt Mark</th>
                    <th>Third Attempt Year</th>
                    <th>Third Attempt Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultAllSub->num_rows > 0):
                    while ($allSubRow = $resultAllSub->fetch_assoc()):
                        $sub = $allSubRow['sub_id'];

                        // Fetch marks for each subject
                        $sqlMarks = "SELECT 
                                        s.sub_name, s.sub_id,  
                                        am.attempt_1, am.fir_year, 
                                        am.attempt_2, am.sec_year, 
                                        am.attempt_3, am.thir_year
                                    FROM `attempt_marks` am
                                    JOIN `subject` s ON s.sub_id = am.sub_id
                                    WHERE am.st_id = ? AND s.sub_id = ?";
                        
                        if ($selectedPeriod != 0) {
                            $sqlMarks .= " AND s.per_id = ?";
                        }

                        $stmtMarks = $conn->prepare($sqlMarks);

                        if ($selectedPeriod != 0) {
                            $stmtMarks->bind_param("sii", $studentId, $sub, $selectedPeriod);
                        } else {
                            $stmtMarks->bind_param("si", $studentId, $sub);
                        }

                        $stmtMarks->execute();
                        $resultMarks = $stmtMarks->get_result();

                        if ($resultMarks->num_rows > 0):
                            while ($marksRow = $resultMarks->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($marksRow['sub_name']); ?></td>
                                    <td><?php echo htmlspecialchars($marksRow['sub_id']); ?></td>
                                    <td><?php echo htmlspecialchars($marksRow['fir_year']) ?: '-'; ?></td>
                                    <td><?php echo htmlspecialchars($marksRow['attempt_1']) ?: 'AB'; ?></td>
                                    <td><?php echo htmlspecialchars($marksRow['sec_year']) ?: '-'; ?></td>
                                    <td><?php echo htmlspecialchars($marksRow['attempt_2']) ?: 'AB'; ?></td>
                                    <td><?php echo htmlspecialchars($marksRow['thir_year']) ?: '-'; ?></td>
                                    <td><?php echo htmlspecialchars($marksRow['attempt_3']) ?: 'AB'; ?></td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="8"><?php echo '-'; ?></td>
                            </tr>
                        <?php endif;
                    endwhile;
                else: ?>
                    <tr>
                        <td colspan="8">No subjects found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
