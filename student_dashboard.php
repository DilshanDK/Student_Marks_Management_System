<?php
session_start();

try {
    require "database_connection.php";
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle the form submission
$selectedYear = isset($_POST['registered_year']) ? $_POST['registered_year'] : date("Y");
$selectedAttempt = isset($_POST['attempt']) ? $_POST['attempt'] : 1;
$selectedSemester = isset($_POST['semester']) ? $_POST['semester'] : 1;

// Fetch student data to get department ID
$username = $_SESSION['username'];
$sql = "SELECT * FROM student WHERE st_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$department_id = substr($username, 4, 2);
echo $department_id;


// Fetch available semesters for the department
$semesters_sql = "SELECT semester_id, semester_name FROM semesters WHERE department_id = ?";
$stmt = $conn->prepare($semesters_sql);
$stmt->bind_param("i", $department_id);
$stmt->execute();
$semesters_result = $stmt->get_result();

// Fetch student data from database based on filters
$sql = "SELECT st_id, sub_id, mark FROM attempt_marks 
        WHERE year = ? AND attempt = ? AND st_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $selectedYear, $selectedAttempt, $username);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .dashboard {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .borderless td {
            border: none;
        }
        select {
            padding: 5px;
            font-size: 16px;
        }
        button {
            padding: 5px 20px;
            font-size: 16px;
            font-weight: bold;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h1>Student Dashboard</h1>

        <!-- Year and Semester Selection Form -->
        <form method="POST" action="">
            <div>
                <label for="registered_year">Select Registered Year:</label>
                <select name="registered_year" id="registered_year">
                    <?php
                    for ($i = 2020; $i <= 2030; $i++) {
                        $selected = ($i == $selectedYear) ? "selected" : "";
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="attempt">Select Attempt:</label>
                <select name="attempt" id="attempt">
                    <option value="1" <?php if ($selectedAttempt == 1) echo "selected"; ?>>1</option>
                    <option value="2" <?php if ($selectedAttempt == 2) echo "selected"; ?>>2</option>
                    <option value="3" <?php if ($selectedAttempt == 3) echo "selected"; ?>>3</option>
                </select>
            </div>
            <div>
                <label for="semester">Select Semester:</label>
                <select name="semester" id="semester">
                    <?php while ($semester = $semesters_result->fetch_assoc()) : ?>
                        <option value="<?php echo $semester['semester_id']; ?>" <?php if ($semester['semester_id'] == $selectedSemester) echo "selected"; ?>>
                            <?php echo $semester['semester_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <button type="submit">Filter</button>
            </div>
        </form>

        <table class="borderless">
            <tr>
                <th>Student ID</th>
                <?php
                $sql = "SELECT sub_name FROM subject";
                $subResult = $conn->query($sql);
                while ($subRow = $subResult->fetch_assoc()) {
                    $subName = $subRow['sub_name'];
                    echo "<th style='text-align:center;'>$subName</th>";
                }
                ?>
                <th style='text-align:center;'>Assignment Marks</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = strtoupper($row['st_id']);
                    $mark = ucfirst($row['mark']);
                    $sub = $row['sub_id'];
                    $sql = "SELECT sub_name FROM subject WHERE sub_id='$sub'";
                    $subResult = $conn->query($sql);
                    while ($subRow = $subResult->fetch_assoc()) {
                        echo "<tr>
                            <td>$id</td>
                            <td style='text-align:center;'>$mark</td>
                        </tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>No data found</td></tr>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>
