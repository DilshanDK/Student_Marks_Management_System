<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e9ecef;
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
      max-width: 400px;
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
      width: calc(100% - 22px); /* Adjust width to account for padding */
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
  </style>
</head>

<body>
  <div class="container">
    <div id="loginForm" class="form-group">
      <h2>Login</h2>
      <form action="login_process.php" method="post">
        <label for="userType">User Type:</label>
        <select id="userType" name="userType" required>
          <option value="student">Student</option>
          <option value="lecturer">Lecturer</option>
        </select>

        <label for="username">Email/IndexNo:</label>
        <input type="text" id="username" name="username" placeholder="Enter your Email or Index Number" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your Password" required>

        <button type="submit">Login</button>

        <p style="text-align: center; margin-top: 10px;">
          Don't have an account? <a href="register.php">Register</a>
        </p>
      </form>
    </div>
  </div>
</body>

</html>
