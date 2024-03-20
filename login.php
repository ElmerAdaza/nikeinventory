<?php
session_start();
include 'db_connection.php';

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$conn = OpenCon();

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials from the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "User not found.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(25, 25, 25, 0.7); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            backdrop-filter: blur(8px); /* Apply backdrop filter for glass effect */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #FFFFFF;
        }

        form {
            position: relative; /* Position relative for containing the absolute positioned eye icon */
        }

        input[type="text"],
        input[type="password"]{
            width: calc(100% - 30px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
        }

        .eye-icon {
            position: absolute;
            top: 43%;
            transform: translateY(-50%);
            right: 15px;
            cursor: pointer;
        }

        button[type="submit"] {
            width: 97%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color:#FFFFFF;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        span{
            color: #FFFFFF;

        }
    </style>
</head>
<body style="background-image: url('img/NikeBg1.jpg'); background-size: cover;">

    <div class="container">
    <?php if(isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
        <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;">Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <div style="position:relative;">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <!-- Eye icon for toggling password visibility -->
                <i id="eye-icon" class="fas fa-eye-slash eye-icon" onclick="togglePasswordVisibility()"></i>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>New user? <a href="signin.php">Sign up here</a></p>
        <!-- Forgot password link with username parameter -->
        <p><a href="reset_password.php">Forgot password? </a></p>     
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
