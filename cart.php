<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");
include("includes/navbar.php");

$user_id = $_SESSION['user'];

/* ADD PRODUCT FROM PRODUCT PAGE */
if (isset($_GET['id'])) {
    $pid = $_GET['id'];

    $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$pid'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 
                              WHERE user_id='$user_id' AND product_id='$pid'");
    } else {
        mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity)
                              VALUES ('$user_id','$pid',1)");
    }
}

/* INCREASE QUANTITY */
if (isset($_GET['inc'])) {
    $cid = $_GET['inc'];
    mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE id='$cid'");
}

/* DECREASE QUANTITY */
if (isset($_GET['dec'])) {
    $cid = $_GET['dec'];
    mysqli_query($conn, "UPDATE cart SET quantity = quantity - 1 WHERE id='$cid' AND quantity > 1");
}

/* REMOVE PRODUCT */
if (isset($_GET['remove'])) {
    $cid = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart WHERE id='$cid'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .cart-container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
        }

        .cart-title {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f8f8;
        }

        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .qty-box {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .qty-btn {
            padding: 4px 10px;
            background: #111;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }

        .qty-btn:hover {
            background: #ffb703;
            color: #000;
        }

        .remove-btn {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }

        .total-box {
            text-align: right;
            margin-top: 30px;
            font-size: 20px;
        }

        .checkout-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 30px;
            background: #111;
            color: #fff;
            border-radius: 25px;
            text-decoration: none;
        }

        .checkout-btn:hover {
            background: #ffb703;
            color: #000;
        }

        .empty-cart {
            text-align: center;
            font-size: 20px;
            padding: 40px;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h2 class="cart-title">My Shopping Cart</h2>

<?php
$q = mysqli_query($conn, "
    SELECT cart.id AS cid, products.name, products.price, products.image, cart.quantity
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id='$user_id'
");

if (mysqli_num_rows($q) > 0) {

    $total = 0;
?>
<table>
    <tr>
        <th>Product</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Remove</th>
    </tr>

<?php while ($row = mysqli_fetch_assoc($q)) {
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
?>
<tr>
    <td><img src="assets/images/<?php echo $row['image']; ?>" class="cart-img"></td>
    <td><?php echo $row['name']; ?></td>
    <td>₹<?php echo $row['price']; ?></td>
    <td>
        <div class="qty-box">
            <a class="qty-btn" href="cart.php?dec=<?php echo $row['cid']; ?>">−</a>
            <strong><?php echo $row['quantity']; ?></strong>
            <a class="qty-btn" href="cart.php?inc=<?php echo $row['cid']; ?>">+</a>
        </div>
    </td>
    <td>₹<?php echo $subtotal; ?></td>
    <td>
        <a href="cart.php?remove=<?php echo $row['cid']; ?>" class="remove-btn">✖</a>
    </td>
</tr>
<?php } ?>

</table>

<div class="total-box">
    <strong>Total: ₹<?php echo $total; ?></strong><br>
    <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
</div>

<?php } else { ?>

<div class="empty-cart">
    🛒 Your cart is empty <br><br>
    <a href="index.php" class="checkout-btn">Continue Shopping</a>
</div>

<?php } ?>

</div>

</body>
</html>
