<?php
include 'db_connection.php';

$search = $_GET['search'];

$conn = OpenCon();
$sql = "SELECT * FROM tb_nikestore WHERE product_name LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

echo "<h2>Search Results</h2>";
echo "<table border='1'>
<tr>
<th>Product Name</th>
<th>Description</th>
<th>Price</th>
<th>Image</th>
<th>Size</th>
<th>Stock</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td><img src='" . $row['img'] . "' alt='Product Image' style='width:100px;'></td>";
    echo "<td>" . $row['product_name'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";  
    echo "<td>" . $row['size'] . "</td>";
    echo "<td>" . $row['stock'] . "</td>";
    echo "</tr>";
}
echo "</table>";

CloseCon($conn);
?>
