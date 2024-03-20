<?php
include 'db_connection.php';
$conn = OpenCon();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Check if the username already exists in the database
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists, display error message
        $error_message = "Username already exists. Please choose a different username.";
    } else {
        // Insert user data into database
        $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $insert_query)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }
    }
    CloseCon($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/download.jpg');
            background-size: cover;
            backdrop-filter: blur(8px); /* Add glass effect */
        }

        .form {
            background-color: rgba(25, 25, 25, 0.8); /* Semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add shadow */
            width: 300px;
        }

        .form h1 {
            text-align: center;
            color: white;
        }

        .form input[type="text"],
        .form input[type="password"],
        .form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .eye-icon {
            position: absolute;
            top: 43%;
            transform: translateY(-50%);
            right: 15px;
            cursor: pointer;
        }

        .form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #45a049;
        }

        .form p {
            text-align: center;
            color: white;
        }

        .form a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form a:hover {
            text-decoration: underline;
        }
        span{
            color: white;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="form">
             <!-- Display error message if it exists -->
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;">Sign In</h1>
            <!-- Sign-in form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <span>Username:</span> <input type="text" name="username" required><br>
                <span>Password:</span> <div style="position:relative;">
                <input type="password" name="password" required>
                <i id="eye-icon" class="fas fa-eye-slash eye-icon" onclick="togglePasswordVisibility()"></i>
                </div>
                <button type="submit">Sign In</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }
    </script>
</body>
</html>

