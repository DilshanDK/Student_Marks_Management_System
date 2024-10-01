<?php

session_start();
// echo $_SESSION['username'];

try {
    require "database_connection.php";
} catch (Exception $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

// Handle the form submission
$selectedYear = isset($_POST['year']) ? $_POST['year'] : date("Y");
$selectedSemester = isset($_POST['semester']) ? $_POST['semester'] : 1;

// Fetch student data from database
$sql = "SELECT st_id, sub_id, mark FROM attempt_marks 
        WHERE year='$selectedYear' 
        AND attempt='$selectedSemester' 
        AND st_id='{$_SESSION['username']}'";
$result = $conn->query($sql);

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

        th,
        td {
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
                <label for="year">Select Year:</label>
                <select name="year" id="year" value="<?php date("Y"); ?>">
                    <?php
                    for ($i = 2020; $i <= 2030; $i++) {
                        $selected = ($i == $selectedYear) ? "selected" : "";
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="semester">Select Semester:</label>
                <select name="semester" id="semester">
                    <option value="1" <?php if ($selectedSemester == 1)
                        echo "selected"; ?>>1</option>
                    <option value="2" <?php if ($selectedSemester == 2)
                        echo "selected"; ?>>2</option>
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
                    echo"<th style='text-align:center;'>$subName</th>";
                }
                ?>
                
                <th style='text-align:center;'>Assignment Marks</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                // Output data for each row
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

            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>