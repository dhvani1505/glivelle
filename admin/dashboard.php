<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body {
            background: #f4f6f8;
        }

        .admin-dashboard {
            max-width: 1100px;
            margin: 60px auto;
        }

        .admin-header {
            background: linear-gradient(135deg, #111, #333);
            color: #fff;
            padding: 30px;
            border-radius: 14px;
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            font-size: 30px;
        }

        .admin-header span {
            font-size: 14px;
            opacity: 0.8;
        }

        .logout-btn {
            background: #ff4d4d;
            color: #fff;
            padding: 10px 22px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #ffb703;
            color: #000;
        }

        .admin-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
        }

        .admin-card {
            background: #fff;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s;
        }

        .admin-card:hover {
            transform: translateY(-10px);
        }

        .admin-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .admin-card h3 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .admin-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .admin-card a {
            display: inline-block;
            padding: 10px 25px;
            background: #111;
            color: #fff;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .admin-card a:hover {
            background: #ffb703;
            color: #000;
        }
    </style>
</head>
<body>

<div class="admin-dashboard">

    <!-- HEADER -->
    <div class="admin-header">
        <div>
            <h1>Admin Dashboard</h1>
            <span>Manage your store efficiently</span>
        </div>
        <a href="logout.php" class="logout-btn">🚪 Logout</a>
    </div>

    <!-- CARDS -->
    <div class="admin-cards">

        <div class="admin-card">
            <div class="admin-icon">➕</div>
            <h3>Add Product</h3>
            <p>Add new accessories or charms to your store</p>
            <a href="add_product.php">Go</a>
        </div>

        <div class="admin-card">
            <div class="admin-icon">📦</div>
            <h3>Products</h3>
            <p>View, edit or delete existing products</p>
            <a href="products.php">Manage</a>
        </div>

        <div class="admin-card">
            <div class="admin-icon">🧾</div>
            <h3>Orders</h3>
            <p>View customer orders and payment status</p>
            <a href="orders.php">View</a>
        </div>

        <div class="admin-card">
            <div class="admin-icon">👤</div>
            <h3>Users</h3>
            <p>View registered customers</p>
            <a href="users.php">View</a>
        </div>

    </div>

</div>

</body>
</html>
