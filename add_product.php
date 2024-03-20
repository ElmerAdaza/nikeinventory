<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: rgb(208,153,25);
            background: linear-gradient(5deg, rgba(208,153,25,1) 0%, rgba(253,187,45,1) 100%);
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form label {
            font-weight: bold;
        }
        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        form textarea {
            height: 100px; 
            resize: none;
        }
        form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        form button[type="submit"]:hover {
            background-color: #0056b3;
        }
        form a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;">Add Product</h1>
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <div class="card p-3">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" required>
                <label for="size">Size:</label>
                <input type="number" id="size" name="size" required>
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Product</button>
            <a href="index.php" class="mt-2">Back</a>
        </form>
    </div>
</body>
</html>



<?php
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $stock = $_POST['stock'];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

  
    $conn = OpenCon();
    $sql = "INSERT INTO tb_nikestore (product_name, description, price, img, size, stock)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    

    if ($stmt === false) {
        echo "Error preparing statement";
        exit();
    }


    $stmt->bind_param("ssdssi", $product_name, $description, $price, $target_file, $size, $stock);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCon($conn);
}
?>
