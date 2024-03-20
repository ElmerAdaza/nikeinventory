<?php
include 'db_connection.php';

$id = $_POST['id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$size = $_POST['size'];
$stock = $_POST['stock'];

$conn = OpenCon();
$sql = "UPDATE tb_nikestore SET product_name='$product_name', description='$description', price='$price', size='$size', stock='$stock' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "Product updated successfully";
    header("Location: index.php");
} else {
    echo "Error updating product: " . mysqli_error($conn);
}

CloseCon($conn);
?>
