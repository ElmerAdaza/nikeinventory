<?php
include 'db_connection.php';

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve product details from the database
    $conn = OpenCon();
    $sql = "SELECT * FROM tb_nikestore WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
         /* Custom styles */
         body {
            background: rgb(208,153,25);
            background: linear-gradient(5deg, rgba(208,153,25,1) 0%, rgba(253,187,45,1) 100%);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 800px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #ffff;
            border-top: 1px solid #ddd; 
            border-bottom: 1px solid #ddd; 
        }
        tr:nth-child(even) {
            background-color: #d1d0d0;
        }
        tr:nth-child(even) th {
            background-color: #d1d0d0;
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        button {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;">Product Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>Image</th>
                <td><img src="<?php echo $row['img']; ?>" alt="Product Image"></td>
            </tr>
            <tr>
                <th>Product Name</th>
                <td><?php echo $row['product_name']; ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?php echo $row['description']; ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?php echo $row['price']; ?></td>
            </tr>
            <tr>
                <th>Size</th>
                <td><?php echo $row['size']; ?></td>
            </tr>
            <tr>
                <th>Stocks</th>
                <td><?php echo $row['stock']; ?></td>
            </tr>
        </table>
        <a href="index.php" class="btn btn-primary">Back</a>
    </div>
</body>
</html>




<?php
    } else {
        echo "Product not found.";
    }
    CloseCon($conn);
} else {
    echo "Product ID not provided.";
}
?>
