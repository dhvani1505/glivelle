<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = intval($_GET['id']); // security

// 🔹 Get image name (optional but recommended)
$get = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($get);

if ($product) {
    // 🔹 Delete image from folder
    $imagePath = "../assets/images/" . $product['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // 🔹 Delete product from DB
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
}

// 🔹 Redirect back
header("Location: products.php");
exit();
