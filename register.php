<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
    <style>
        /* Same as your current CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-group {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input,
        select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: calc(100% - 22px);
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group a {
            color: #007bff;
            text-decoration: none;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        .toggle-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .toggle-group button {
            background-color: #e9ecef;
            color: #333;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 48%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .toggle-group button.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-group">
            <h2>Register</h2>
            <div class="toggle-group">
                <button id="studentButton" class="active">Student</button>
                <button id="lecturerButton">Lecturer</button>
            </div>
            <form id="studentForm" class="form-section active" action="register_student.php" method="post">
                <label for="studentName">Name:</label>
                <input type="text" id="studentName" name="name" required>

                <label for="studentIndexNo">Index Number:</label>
                <input type="text" id="studentIndexNo" name="index_no" required>

                <label for="studentDepartment">Department:</label>
                <select id="studentDepartment" name="department" required>
                    <option value="">Select Department</option>
                    <option value="hnda">HND Accounting</option>
                    <option value="hndit">HND Information Technology</option>
                    <option value="hndm">HND Marketing</option>
                    <option value="hndba">HND Business Administration</option>
                    <option value="hndthm">HND Tourism and Hospitality Management</option>
                    <option value="hnde">HND English</option>
                </select>

                <label for="studentYear">Registered Year:</label>
                <input type="number" min="2020" max="2030" id="studentYear" name="registered_year" required>

                <label for="studentPassword">Password:</label>
                <input type="password" id="studentPassword" name="password" required>

                <button type="submit">Register as Student</button>
            </form>

            <form id="lecturerForm" class="form-section" action="register_lecturer.php" method="post">
                <label for="lecturerName">Name:</label>
                <input type="text" id="lecturerName" name="name" required>

                <label for="lecturerEmail">Email:</label>
                <input type="email" id="lecturerEmail" name="email" required>

                <label for="lecturerDepartment">Department:</label>
                <select id="lecturerDepartment" name="department" required>
                    <option value="">Select Department</option>
                    <option value="hnda">HND Accounting</option>
                    <option value="hndit">HND Information Technology</option>
                    <option value="hndm">HND Marketing</option>
                    <option value="hndba">HND Business Administration</option>
                    <option value="hndthm">HND Tourism and Hospitality Management</option>
                    <option value="hnde">HND English</option>
                </select>

                <label for="lecturerSubject">Subject:</label>
                <input type="text" id="lecturerSubject" name="subject" required>

                <label for="lecturerPassword">Password:</label>
                <input type="password" id="lecturerPassword" name="password" required>

                <button type="submit">Register as Lecturer</button>
            </form>

            <p style="text-align: center; margin-top: 10px;">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('studentButton').addEventListener('click', function () {
            document.getElementById('studentForm').classList.add('active');
            document.getElementById('lecturerForm').classList.remove('active');
            this.classList.add('active');
            document.getElementById('lecturerButton').classList.remove('active');
        });

        document.getElementById('lecturerButton').addEventListener('click', function () {
            document.getElementById('lecturerForm').classList.add('active');
            document.getElementById('studentForm').classList.remove('active');
            this.classList.add('active');
            document.getElementById('studentButton').classList.remove('active');
        });
    </script>
</body>

</html>
