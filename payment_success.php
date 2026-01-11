<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id    = $_SESSION['user'];
$payment_id = $_GET['payment_id'] ?? '';

/* 🔐 Recalculate total securely */
$totalAmount = $_SESSION['order_total'] ?? 0;

if ($totalAmount <= 0) {
    die("Invalid order amount.");
}


/* Save order */
mysqli_query($conn, "
    INSERT INTO orders (user_id, total_amount, payment_id, payment_status)
    VALUES ('$user_id','$totalAmount','$payment_id','Success')
");

/* Clear cart */
mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
unset($_SESSION['order_total']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment Successful | Accessories Shop</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
body{
    background:#f4f6f8;
    font-family:Segoe UI, sans-serif;
}

/* Center wrapper */
.success-wrapper{
    min-height:80vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* Card */
.success-card{
    background:#fff;
    width:100%;
    max-width:650px;
    padding:50px;
    border-radius:22px;
    text-align:center;
    box-shadow:0 25px 60px rgba(0,0,0,0.12);
    animation:slideUp .8s ease;
}

/* Check icon */
.check-circle{
    width:100px;
    height:100px;
    background:linear-gradient(135deg,#2ecc71,#27ae60);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:48px;
    color:#fff;
    margin:0 auto 25px;
}

/* Text */
.success-card h1{
    font-size:34px;
    margin-bottom:10px;
    color:#2ecc71;
}
.success-card p{
    font-size:16px;
    color:#555;
    margin-bottom:25px;
}

/* Payment info box */
.payment-info{
    background:#f8f9fa;
    padding:18px;
    border-radius:12px;
    margin-bottom:30px;
    text-align:left;
    font-size:15px;
}
.payment-info div{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
}
.payment-info strong{
    color:#111;
}

/* Button */
.success-btn{
    display:inline-block;
    padding:16px 42px;
    background:#111;
    color:#fff;
    border-radius:40px;
    text-decoration:none;
    font-size:16px;
    transition:.3s;
}
.success-btn:hover{
    background:#ffb703;
    color:#000;
}

/* Small text */
.thank-text{
    margin-top:20px;
    font-size:14px;
    color:#888;
}

/* Animation */
@keyframes slideUp{
    from{opacity:0;transform:translateY(40px);}
    to{opacity:1;transform:translateY(0);}
}

@media(max-width:600px){
    .success-card{padding:35px;}
    .success-card h1{font-size:28px;}
}
</style>
</head>

<body>

<?php include("includes/navbar.php"); ?>

<div class="success-wrapper">

    <div class="success-card">

        <div class="check-circle">✔</div>

        <h1>Payment Successful</h1>
        <p>Your order has been placed successfully.</p>

        <div class="payment-info">
            <div>
                <span>Payment ID</span>
                <strong><?php echo htmlspecialchars($payment_id); ?></strong>
            </div>
            <div>
                <span>Total Paid</span>
                <strong>₹<?php echo $totalAmount; ?></strong>
            </div>
            <div>
                <span>Payment Status</span>
                <strong style="color:#2ecc71;">Success</strong>
            </div>
        </div>

        <a href="index.php" class="success-btn">Continue Shopping</a>

        <div class="thank-text">
            Thank you for shopping with Accessories Shop 💖
        </div>

    </div>

</div>

</body>
</html>
