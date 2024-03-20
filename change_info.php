<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $old_password = $_POST['old_password'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    $conn = OpenCon();
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($old_password, $row['password'])) {
            // Update username if provided
            if (!empty($new_username)) {
                $sql_update_username = "UPDATE users SET username='$new_username' WHERE username='$username'";
                mysqli_query($conn, $sql_update_username);
                $_SESSION['username'] = $new_username;
            }
            // Update password if provided
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql_update_password = "UPDATE users SET password='$hashed_password' WHERE username='$username'";
                mysqli_query($conn, $sql_update_password);
            }
            $success = "You account is updated successfully";
        } else {
            $error = "Invalid old password";
        }
    } else {
        $error = "User not found";
    }
    CloseCon($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Username and Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            background-color: rgba(25, 25, 25, 0.7); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            backdrop-filter: blur(8px); 
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #FFFFFF;
        }

        form {
            position: relative; 
        }

        input[type="text"],
        input[type="password"]{
            width: calc(100% - 30px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.9); 
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

      
        .password-toggle {
            position: relative;
        }
        .toggle-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        h2{
            color: #fff;
        }
      
    </style>

</head>
<body  style="background-image: url('img/changeinfobg.jpg'); background-size: cover;">
<div class="container">
        <?php if(isset($error)) { echo "<div style='color: red;'>$error</div>"; } ?>
        <?php if(isset($success)) { echo "<div style='color: white;'>$success</div>"; } ?>
        <h2 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;">Change Username and Password</h2>   
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="new_username" placeholder="New Username"><br>
            <div class="password-toggle">
                <input type="password" name="old_password" id="old_password" placeholder="Old Password" required>
                <i id="eye-icon-old" class="fas fa-eye-slash eye-icon" onclick="togglePasswordVisibility('old_password', 'eye-icon-old')"></i>
            </div>
            <div class="password-toggle">
                <input type="password" name="new_password" id="new_password" placeholder="New Password" required>
                <i id="eye-icon-new" class="fas fa-eye-slash eye-icon" onclick="togglePasswordVisibility('new_password', 'eye-icon-new')"></i>
            </div>
            <button type="submit">Change</button>
        </form>
        <p><a href="index.php">Back</a></p>
    </div>

    <script>
        function togglePasswordVisibility(passwordFieldId, eyeIconId) {
            var passwordInput = document.getElementById(passwordFieldId);
            var eyeIcon = document.getElementById(eyeIconId);

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
