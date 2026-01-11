<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user'];

/* 🔹 Calculate total from cart */
$cartQuery = mysqli_query($conn, "
    SELECT c.quantity, p.price 
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = '$user_id'
");

$totalAmount = 0;
while ($row = mysqli_fetch_assoc($cartQuery)) {
    $totalAmount += $row['price'] * $row['quantity'];
}

if ($totalAmount <= 0) {
    echo "<h2 style='text-align:center;margin-top:100px;'>Your cart is empty 🛒</h2>";
    exit();
}
$_SESSION['order_total'] = $totalAmount;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout | Accessories & Charms</title>

<!-- Razorpay -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<link rel="stylesheet" href="assets/css/style.css">

<style>
body{background:#f6f6f6;font-family:Segoe UI,sans-serif;}
.checkout-container{
    max-width:1100px;
    margin:80px auto;
    display:grid;
    grid-template-columns:1.2fr 0.8fr;
    gap:40px;
}
.checkout-box{
    background:#fff;
    padding:40px;
    border-radius:20px;
    box-shadow:0 20px 45px rgba(0,0,0,0.08);
}
.checkout-box h2,.checkout-box h3{
    margin-bottom:25px;
    font-size:26px;
}
.checkout-box input,
.checkout-box textarea{
    width:100%;
    padding:14px;
    margin-bottom:18px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:15px;
}
.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:18px;
    font-size:16px;
}
.summary-total{
    font-size:22px;
    font-weight:700;
    border-top:1px solid #eee;
    padding-top:18px;
}
.pay-btn{
    width:100%;
    padding:16px;
    margin-top:30px;
    background:#111;
    color:#fff;
    border:none;
    border-radius:40px;
    font-size:17px;
    cursor:pointer;
    transition:.3s;
}
.pay-btn:hover{
    background:#ffb703;
    color:#000;
}
@media(max-width:900px){
    .checkout-container{grid-template-columns:1fr;padding:20px;}
}
</style>
</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="checkout-container">

<!-- SHIPPING DETAILS -->
<div class="checkout-box">
    <h2>Shipping Details</h2>

    <input type="text" placeholder="Full Name" required>
    <input type="email" placeholder="Email" required>
    <input type="text" placeholder="Phone" required>
    <textarea rows="4" placeholder="Full Address" required></textarea>
</div>

<!-- ORDER SUMMARY -->
<div class="checkout-box">
    <h3>Order Summary</h3>

    <div class="summary-row">
        <span>Subtotal</span>
        <span>₹<?php echo $totalAmount; ?></span>
    </div>

    <div class="summary-row">
        <span>Shipping</span>
        <span>FREE</span>
    </div>

    <div class="summary-row summary-total">
        <span>Total</span>
        <span>₹<?php echo $totalAmount; ?></span>
    </div>

    <button id="payBtn" class="pay-btn">Pay Securely</button>
</div>

</div>

<script>
var options = {
    "key": "rzp_test_RyuiF5xgNaQcU4",
    "amount": "<?php echo $totalAmount * 100; ?>",
    "currency": "INR",
    "name": "Accessories & Charms",
    "description": "Order Payment",
    "handler": function (response){
        window.location.href =
        "payment_success.php?payment_id=" + response.razorpay_payment_id;
    },
    "theme": {"color":"#111"}
};

var rzp = new Razorpay(options);
document.getElementById('payBtn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>

</body>
</html>
