<?php
include 'db_connection.php';
$conn = OpenCon();

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<?php
$search = "";
if(isset($_GET['search'])) {
    $search = $_GET['search'];
}

if (!empty($search)) {
    $sql = "SELECT * FROM tb_nikestore 
            WHERE product_name LIKE '%$search%' 
            OR description LIKE '%$search%' 
            OR price LIKE '%$search%' 
            OR size LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM tb_nikestore";
}

$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nike Shoe Store Inventory</title>  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <style>
   
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
            box-sizing: border-box;
            background: rgb(208,153,25);
            background: linear-gradient(5deg, rgba(208,153,25,1) 0%, rgba(253,187,45,1) 100%);
        }
         
        .container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        .left {
            flex: 1; 
            align-items: center;
            margin-left: 0;
        }
        .right {
            display: flex;
            align-items: center;
        }
        .right form,
        .right a {
            margin-left: 10px; 
        }

        h1 {
            text-align: center;
            padding-bottom: 30px;
            padding-top: 50px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;
            font-style: italic;
        }
        p {
            text-transform: capitalize; 
        }
        .logonike{
            position: relative;
            left: 12em;
            top: 50px;
            width: 900px; 
           height: auto;
        }
    
        h2 {
            margin-top: 20px;
        }

   
        .table-responsive {
            padding: 20px; 
            overflow-x: auto;          
        }

        table {
            width: 100%; 
            border-collapse: collapse;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: rgb(151, 157, 163);
        }

        img {
            max-width: 100px;
            height: auto;
        }

   
        .description-cell {
            max-width: 200px; 
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

   
        tbody tr:nth-child(even) {
            background-color: #d1d0d0;
        }
        tbody tr:nth-child(odd) {
            background-color: #ffff;
        }

        /* Responsive styles */
        @media (max-width: 767px) {
            table {
                overflow-x: auto;
                display: block;
            }
        }

     
         #searchForm {
            margin-top: 4%;
            margin-bottom: 4%;
            position: relative;
            width: 80%; 
            background-color: #f2f2f2; 
            border-radius: 25px; 
            overflow: hidden; 
            box-shadow: inset 0 0 10px rgba(0, 0, 0, .7); 
            
        }
        #searchForm input[type="text"] {
            width: calc(100% - 70px); 
            padding: 10px; 
            border: none; 
            outline: none; 
            background: none; 
            float: left; 
            font-size: 16px; 
        }
        #search {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            padding: 5px 10px; 
            background-color: #007bff; 
            color: #fff; 
            border: none; 
            cursor: pointer;
            font-size: 16px;
            border-top-right-radius: 25px;
            border-bottom-right-radius: 25px; 
        }
        #search:hover {
            background-color: #0056b3;
        }
        .header {           
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
            background-image: url('img/headerbg.jpg'); 
            background-size: cover;
            padding: 20px; 
            margin-top: 0;
            margin-left: 0;
            margin-right: 0;
        }

    </style>
</head>
<body>

<div>
      <h1 class="header">Welcome to Nike Shoe Store Inventory</h1>
        </div>
                <img class="logonike" src="img/nikepicture.png" alt="Logo">
                <p  style="margin-left: 5%;
                           font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                           font-weight:900;">Hello, <?php echo ucfirst(strtolower($_SESSION['username'])); ?>!</p>
            <div class="container">
                <div class="left">     
                    <form id="searchForm" action="index.php" method="GET">
                        <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search Here">
                        <button id="search" type="submit">Search</button>
                    </form>
                </div>
               
                <div class="right">
                    
                    <form action="logout.php" method="post">
                        <button class="btn btn-danger" type="submit">Logout</button>
                    </form>           
                    <a class="btn btn-primary" href="change_info.php">Change Username/Password</a>
                </div>
        </div>
       
</div>


<!-- Add product button -->
<a href="add_product.php" class="btn btn-primary" style="margin-left: 5%;">Add Product</a>

<!-- Display products -->
<h2 style="text-align:center; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:900;">Products</h2>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Size (US Size)</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td><img src='" . $row['img'] . "' alt='Product Image'></td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td class='description-cell'>" . $row['description'] . "</td>";
                echo "<td> &#x20B1; " . $row['price'] . "</td>";
                echo "<td>" . $row['size'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>";
                echo "<a href='update_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Update</a> ";
                echo "<a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a> ";
                echo "<a href='view_product.php?id=" . $row['id'] . "' class='btn btn-sm btn-info'>View</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }
        CloseCon($conn);
        ?>
        </tbody>
    </table>
</div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
