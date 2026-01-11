<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Users</title>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
body{background:#f4f6f8;}
.container{max-width:1000px;margin:50px auto;background:#fff;padding:30px;border-radius:14px;}
table{width:100%;border-collapse:collapse;}
th,td{padding:14px;border-bottom:1px solid #eee;text-align:center;}
th{background:#111;color:#fff;}
</style>
</head>
<body>

<div class="container">
<h2>👤 Registered Users</h2><br>

<?php if(mysqli_num_rows($users) > 0){ ?>

<table>
<tr>
<th>ID</th><th>Name</th><th>Email</th>
</tr>

<?php while($u = mysqli_fetch_assoc($users)){ ?>
<tr>
<td><?php echo $u['id']; ?></td>
<td><?php echo $u['name']; ?></td>
<td><?php echo $u['email']; ?></td>
</tr>
<?php } ?>

</table>

<?php } else { ?>

<p style="text-align:center;">No users found</p>

<?php } ?>

</div>

</body>
</html>
