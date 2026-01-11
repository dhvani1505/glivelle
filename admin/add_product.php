<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {

    $name     = $_POST['name'];
    $price    = $_POST['price'];
    $category = $_POST['category'];
    $type     = $_POST['type'];

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "../assets/images/$img");

    mysqli_query($conn, "
        INSERT INTO products (name, price, category, type, image)
        VALUES ('$name', '$price', '$category', '$type', '$img')
    ") or die(mysqli_error($conn));

    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Product</title>
<link rel="stylesheet" href="../assets/css/style.css">

<style>
body {
    background: linear-gradient(135deg, #f4f6f8, #eaeaea);
}

.add-product-container {
    max-width: 500px;
    margin: 80px auto;
    background: #fff;
    padding: 35px;
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    animation: fadeUp 0.8s ease;
}

.add-product-container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 26px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.add-btn {
    width: 100%;
    padding: 14px;
    margin-top: 15px;
    background: #111;
    color: #fff;
    border-radius: 30px;
    border: none;
    cursor: pointer;
}

.add-btn:hover {
    background: #ffb703;
    color: #000;
}

.back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #555;
    text-decoration: none;
}

@keyframes fadeUp {
    from {opacity:0; transform:translateY(40px);}
    to {opacity:1; transform:translateY(0);}
}
</style>
</head>

<body>

<div class="add-product-container">

<h2>➕ Add New Product</h2>

<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Product Name</label>
        <input type="text" name="name" required>
    </div>

    <div class="form-group">
        <label>Price (₹)</label>
        <input type="number" name="price" required>
    </div>

    <!-- CATEGORY -->
    <div class="form-group">
        <label>Category</label>
        <select name="category" id="category" required onchange="updateTypes()">
            <option value="">Select Category</option>
            <option value="Accessories">Accessories</option>
            <option value="Charms">Charms</option>
        </select>
    </div>

    <!-- TYPE -->
    <div class="form-group">
        <label>Type</label>
        <select name="type" id="type" required>
            <option value="">Select Type</option>
        </select>
    </div>

    <div class="form-group">
        <label>Product Image</label>
        <input type="file" name="image" required>
    </div>

    <button type="submit" name="add" class="add-btn">
        Add Product
    </button>

</form>

<a href="dashboard.php" class="back-link">← Back to Dashboard</a>

</div>

<script>
function updateTypes() {
    const category = document.getElementById("category").value;
    const type = document.getElementById("type");

    type.innerHTML = '<option value="">Select Type</option>';

    let types = [];

    if (category === "Accessories") {
        types = [
            "Earrings",
            "Watches",
            "Necklace",
            "Bracelet",
            "Rings",
            "Anklet",
            "Choker",
            "Hair Clip",
            "Clutcher",
            "Hair Band"
        ];
    }

    if (category === "Charms") {
        types = [
            "Phone Charm",
            "Key Chain"
        ];
    }

    types.forEach(t => {
        const opt = document.createElement("option");
        opt.value = t;
        opt.textContent = t;
        type.appendChild(opt);
    });
}
</script>

</body>
</html>
