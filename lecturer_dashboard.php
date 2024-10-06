<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index1.php"); // Redirect to login page if not logged in
    exit;
}


try {
    require "database_connection.php";
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

$selectedYear = isset($_POST['year']) ? $_POST['year'] : '';
$searchTerm = isset($_POST['search']) ? trim($_POST['search']) : '';

// Extract lecture name and subject
$sqlSubId = "SELECT `sub_id` FROM `subject_lecture` WHERE `lec_id`='{$_SESSION['username']}'";
$resultSubId = $conn->query($sqlSubId);
$subId = $resultSubId->fetch_assoc()['sub_id'];



$sqlLecName = "SELECT `lec_name` FROM `lecture` WHERE `lec_id`='{$_SESSION['username']}'";
$resultLecName = $conn->query($sqlLecName);
$lecName = $resultLecName->fetch_assoc()['lec_name'];

// Fetch subject name
$sqlSubject = "SELECT `sub_name` FROM `subject` WHERE `sub_id`='$subId'";
$resultSubject = $conn->query($sqlSubject);
$subjectName = $resultSubject->fetch_assoc()['sub_name'];

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index1.php"); // Redirect to login page
    exit;
}

// Update marks
if (isset($_POST['update'])) {

    if (($_POST['mark_1'] >= 0 && !empty($_POST['mark_1'])) && ($_POST['mark_2'] >= 0 && !empty($_POST['mark_2'])) && ($_POST['mark_3'] >= 0 && !empty($_POST['mark_3']))) {
        $marksAttempt1 = $_POST['mark_1'];
        $marksAttempt2 = $_POST['mark_2'];
        $marksAttempt3 = $_POST['mark_3'];
        $studentId = $_POST['student_id'];

        $updateSql = "UPDATE `attempt_marks` 
                      SET `attempt_1`='$marksAttempt1', 
                          `attempt_2`='$marksAttempt2', 
                          `attempt_3`='$marksAttempt3' 
                      WHERE `st_id`='$studentId' 
                      AND `sub_id`='$subId'";

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
                        title: 'Not Updated!',
                        text: 'Failed to update marks.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                  </script>";
        }
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
                <p>Lecture: <?php echo $lecName; ?></p>
                <p>Subject: <?php echo htmlspecialchars($subjectName); ?></p>
            </div>
            <form class="group" method="POST" action="">
                <button class="btn btn-logout" name="logout" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="dashboard">

        <form method="POST" action="">
            <div>
                <label for="year">Select Register Year</label>
                <select style="width: 250px;" name="year" id="year">
                    <option value="">All Years</option>
                    <?php
                    for ($year = 2020; $year <= 2040; $year++) {
                        $selected = ($selectedYear == $year) ? 'selected' : '';
                        echo "<option value='$year' $selected>$year</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="search">Search Student</label>
                <input type="text" style="padding:10px 30px;" name="search" id="search"
                    value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Student Name or ID">
            </div>

            <button type="submit" class="btn btn-filter">Filter</button>
        </form>

        <!-- Display Students and Marks -->
        <table>
            <thead>
                <tr>
                    <th width="150">Student ID</th>
                    <th width="170">Student Name</th>
                    <th>First Attempt Year</th>
                    <th>First Attempt Mark</th>
                    <th>Second Attempt Year</th>
                    <th>Second Attempt Mark</th>
                    <th>Third Attempt Year</th>
                    <th>Third Attempt Mark</th>
                    <th width="115">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch students and filter by year (if selected) or search term
                $sqlStudents = "SELECT `st_id`, `st_name` FROM `student` WHERE 1";

                if ($selectedYear) {
                    $sqlStudents .= " AND `st_reg_year` = '$selectedYear'";
                }

                if ($searchTerm) {
                    $sqlStudents .= " AND (`st_id` LIKE '%$searchTerm%' OR `st_name` LIKE '%$searchTerm%')";
                }

                $resultStudents = $conn->query($sqlStudents);

                if ($resultStudents->num_rows > 0) {
                    while ($studentRow = $resultStudents->fetch_assoc()) {
                        $id = strtoupper($studentRow['st_id']);
                        $name = ucfirst($studentRow['st_name']);
                        $sqlMarks = "SELECT `attempt_1`, `fir_year`, `attempt_2`, `sec_year`, `attempt_3`, `thir_year` 
                                     FROM `attempt_marks` 
                                     WHERE `st_id`='{$studentRow['st_id']}' 
                                     AND `sub_id`='$subId'";
                        $resultMark = $conn->query($sqlMarks);

                        while ($marksRow = $resultMark->fetch_assoc()) {
                            $mark1 = $marksRow ? $marksRow['attempt_1'] : 'AB';
                            $year1 = $marksRow ? $marksRow['fir_year'] : '-';
                            $mark2 = $marksRow ? $marksRow['attempt_2'] : 'AB';
                            $year2 = $marksRow ? $marksRow['sec_year'] : '-';
                            $mark3 = $marksRow ? $marksRow['attempt_3'] : 'AB';
                            $year3 = $marksRow ? $marksRow['thir_year'] : '-';

                            echo "<tr>
                                <form method='POST' action=''>
                                    <td width='150'>$id</td>
                                    <td width='170' style='text-align:left;'>$name</td>
                                    <td>$year1</td>
                                    <td><input type='text' name='mark_1' value='$mark1'></td>
                                    <td>$year2</td>
                                    <td><input type='text' name='mark_2' value='$mark2'></td>
                                    <td>$year3</td>
                                    <td><input type='text' name='mark_3' value='$mark3'></td>
                                    <td>
                                        <input type='hidden' name='student_id' value='$id'>
                                        <button type='submit' name='update' class='btn-update'>Update</button>
                                    </td>
                                </form>
                              </tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align:center;'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>