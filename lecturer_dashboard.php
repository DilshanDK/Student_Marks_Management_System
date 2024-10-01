<?php
session_start();
try {
    require "database_connection.php";
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

$selectedYear = isset($_POST['year']) ? $_POST['year'] : date("Y");
$searchTerm = isset($_POST['search']) ? trim($_POST['search']) : '';

$sqll = "SELECT `sub_id` FROM `subject_lecture` WHERE `lec_id`='{$_SESSION['username']}'";
$resultl = $conn->query($sqll);
$rowl = $resultl->fetch_assoc();
$sub = $rowl['sub_id'];

// Fetch subject name
$sqlSubject = "SELECT `sub_name` FROM `subject` WHERE `sub_id`='$sub'";
$resultSubject = $conn->query($sqlSubject);
$subjectName = $resultSubject->fetch_assoc()['sub_name'];

if (isset($_POST['update'])) {
    $marksAttempt1 = $_POST['mark_1'];
    $marksAttempt2 = $_POST['mark_2'];
    $marksAttempt3 = $_POST['mark_3'];
    $studentId = $_POST['student_id'];

    $updateSql = "UPDATE `attempt_marks` 
                  SET `attempt_1`='$marksAttempt1', 
                      `attempt_2`='$marksAttempt2', 
                      `attempt_3`='$marksAttempt3' 
                  WHERE `st_id`='$studentId' 
                  AND `sub_id`='$sub' 
                  AND `year`='$selectedYear'";
    
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

// Search or fetch all students
$sql = "SELECT `st_id`, `st_name` FROM `student` WHERE SUBSTRING(`st_id`, 8, 4) = '$selectedYear'";
if ($searchTerm) {
    $sql .= " AND (`st_id` LIKE '%$searchTerm%' OR `st_name` LIKE '%$searchTerm%')";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture Dashboard</title>
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- Google Fonts (for improved typography) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
       body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            transition: background-color 0.3s ease-in-out;
        }

        .dashboard {
            max-width: 1200px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            color: #34495e;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5rem;
            color: #2980b9;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            gap: 20px;
        }

        form div {
            flex: 1;
        }

        label {
            font-weight: 500;
            font-size: 1rem;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: border-color 0.3s ease-in-out;
        }

        select:focus, input[type="text"]:focus {
            border-color: #2980b9;
            box-shadow: 0 0 5px rgba(41, 128, 185, 0.3);
        }

        button {
            background-color: #27ae60;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            font-size: 1rem;
            width: 100%;
        }

        button:hover {
            background-color: #2ecc71;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            font-size: 1rem;
        }

        th {
            background-color: #ecf0f1;
            color: #34495e;
            text-transform: uppercase;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.2s;
        }

        td input[type="text"] {
            width: 80px;
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        td:last-child {
            text-align: center;
        }

        tbody {
            display: block;
            max-height: 400px;
            overflow-y: auto;
        }

        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        @media (max-width: 768px) {
            form {
                flex-direction: column;
                gap: 20px;
            }

            button {
                width: 100%;
            }

            table, thead, tbody tr {
                display: block;
            }

            tbody tr {
                margin-bottom: 20px;
            }

            tbody tr td {
                display: block;
                width: 100%;
                padding: 10px;
            }

            tbody tr td input[type="text"] {
                width: 100%;
            }

            tbody tr td:last-child {
                text-align: right;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h1>Lecture Dashboard</h1>
        <h2><?php echo htmlspecialchars($subjectName); ?></h2>

        <!-- Year and Search Form -->
        <form method="POST" action="">
            <div>
                <label for="year">Select Year:</label>
                <select name="year" id="year">
                    <?php
                    for ($i = 2020; $i <= 2030; $i++) {
                        $selected = ($i == $selectedYear) ? "selected" : "";
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="search">Search Student (ID/Name):</label>
                <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Enter Student ID or Name">
            </div>
            <div>
                <button type="submit">Filter</button>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Attempt 1</th>
                    <th>Attempt 2</th>
                    <th>Attempt 3</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($rows = $result->fetch_assoc()) {
                        $id = strtoupper($rows['st_id']);
                        $name = ucfirst($rows['st_name']);
                        
                        // Fetch marks for all attempts
                        $sqlMarks = "SELECT `attempt_1`, `attempt_2`, `attempt_3` FROM `attempt_marks` 
                                     WHERE `st_id`='{$rows['st_id']}' 
                                     AND `sub_id`='$sub' 
                                     ";
                        $resultMarks = $conn->query($sqlMarks);
                        $marks = $resultMarks->fetch_assoc();
                        
                        $mark1 = $marks ? $marks['attempt_1'] : 'AB';
                        $mark2 = $marks ? $marks['attempt_2'] : 'AB';
                        $mark3 = $marks ? $marks['attempt_3'] : 'AB';

                        echo "<tr>
                                <form method='POST' action=''>
                                    <td>$id</td>
                                    <td>$name</td>
                                    <td><input type='text' name='mark_1' value='$mark1' size='5'></td>
                                    <td><input type='text' name='mark_2' value='$mark2' size='5'></td>
                                    <td><input type='text' name='mark_3' value='$mark3' size='5'></td>
                                    <td>
                                        <input type='hidden' name='student_id' value='$id'>
                                        <button type='submit' name='update'>Update</button>
                                    </td>
                                </form>
                             </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No data found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
