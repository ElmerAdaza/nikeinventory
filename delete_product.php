<?php
include 'db_connection.php';

$id = $_GET['id'];

$conn = OpenCon();
$sql = "DELETE FROM tb_nikestore WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "Product deleted successfully";
    header("Location: index.php");
} else {
    echo "Error deleting product: " . mysqli_error($conn);
}

CloseCon($conn);
?>
