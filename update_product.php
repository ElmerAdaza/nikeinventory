<?php
include 'db_connection.php';

$id = $_GET['id'];

$conn = OpenCon();
$result = mysqli_query($conn, "SELECT * FROM tb_nikestore WHERE id='$id'");
$row = mysqli_fetch_array($result);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
            box-sizing: border-box;
            background: rgb(208,153,25);
            background: linear-gradient(5deg, rgba(208,153,25,1) 0%, rgba(253,187,45,1) 100%);
        }
        .card {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .form-group label {
            font-weight: bold;
        }
       
        #description {
            font-size: 16px;
            height: 150px; 
        }
       
        .form-control {
            font-size: 16px;
            width: calc(100% - 20px); 
        }
      
        .btn {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;">Edit Product</h1>
            <form action="update_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row['product_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo $row['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="size">Size:</label>
                    <input type="number" class="form-control" id="size" name="size" value="<?php echo $row['size']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stocks:</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $row['stock']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="index.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</body>
</html>



<?php
CloseCon($conn);
?>


