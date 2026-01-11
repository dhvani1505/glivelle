<?php
session_start();
include("../config/db.php");
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

$orders = mysqli_query($conn, "
SELECT orders.*, users.name 
FROM orders 
JOIN users ON orders.user_id = users.id
ORDER BY orders.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Orders</title>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
body{background:#f4f6f8;}
.container{max-width:1100px;margin:50px auto;background:#fff;padding:30px;border-radius:14px;}
table{width:100%;border-collapse:collapse;}
th,td{padding:14px;border-bottom:1px solid #eee;text-align:center;}
th{background:#111;color:#fff;}
</style>
</head>
<body>

<div class="container">
<h2>🧾 Orders</h2><br>

<table>
<tr>
<th>User</th><th>Total</th><th>Payment ID</th><th>Status</th>
</tr>

<?php while($o=mysqli_fetch_assoc($orders)){ ?>
<tr>
<td><?php echo $o['name']; ?></td>
<td>₹<?php echo $o['total_amount']; ?></td>
<td><?php echo $o['payment_id']; ?></td>
<td><?php echo $o['payment_status']; ?></td>
</tr>
<?php } ?>
</table>

</div>
</body>
</html>
