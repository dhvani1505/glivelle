<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Products</title>
<link rel="stylesheet" href="../assets/css/style.css">

<style>
body{
    background:#f4f6f8;
}
.container{
    max-width:1200px;
    margin:50px auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
}
table{
    width:100%;
    border-collapse:collapse;
}
th, td{
    padding:14px;
    border-bottom:1px solid #eee;
    text-align:center;
}
th{
    background:#111;
    color:#fff;
}
img{
    width:70px;
    border-radius:8px;
}
.delete{
    color:red;
    text-decoration:none;
    font-weight:bold;
    font-size:18px;
}
</style>
</head>

<body>

<div class="container">
<h2>📦 Products</h2><br>

<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category</th>
    <th>Type</th>
    <th>Delete</th>
</tr>

<?php while($p = mysqli_fetch_assoc($products)){ ?>
<tr>
    <td>
        <img src="../assets/images/<?php echo $p['image']; ?>">
    </td>
    <td><?php echo $p['name']; ?></td>
    <td>₹<?php echo $p['price']; ?></td>
    <td><?php echo $p['category']; ?></td>
    <td><?php echo $p['type']; ?></td>
    <td>
        <a class="delete" href="delete_product.php?id=<?php echo $p['id']; ?>"onclick="return confirm('Are you sure you want to delete this product?');">✖</a>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
