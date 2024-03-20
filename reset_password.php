<?php
session_start();
include 'db_connection.php';
$conn = OpenCon();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT); // Hash the new password

    // Update user data in the database
    $sql = "UPDATE users SET password='$newPassword' WHERE username='$username'";
    if (mysqli_query($conn, $sql)) {
        echo "Password reset successfully.";
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    CloseCon($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            background-image: url('img/resetbg.jpg');
            background-size: cover;
            backdrop-filter: blur(8px); 
        }

        .form {
            background-color: rgba(25, 25, 25, 0.8); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
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
            background-color: #FF204E;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #A0153E;
        }

        .form p {
            text-align: center;
            color: white;
        }

        .form a {
            color: #FF204E;
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
            <h1>Reset Password</h1>
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="username" placeholder="Username" required><br>
                <div style="position:relative;">
                <input type="password" name="newPassword" placeholder="Password" required>
                <i id="eye-icon" class="fas fa-eye-slash eye-icon" onclick="togglePasswordVisibility()"></i>
                </div>
                <button type="submit">Reset Password</button>
                <a href="index.php">Back</a>
         </form>
        </div>
    </div>
</body>
</html>