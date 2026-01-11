<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include("config/db.php");
include("includes/navbar.php");

$cat  = $_GET['cat']  ?? '';
$type = $_GET['type'] ?? '';

if ($cat && $type) {
    $sql = "SELECT * FROM products WHERE category='$cat' AND type='$type'";
} elseif ($cat) {
    $sql = "SELECT * FROM products WHERE category='$cat'";
} elseif ($type) {
    $sql = "SELECT * FROM products WHERE type='$type'";
} else {
    $sql = "SELECT * FROM products";
}

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Accessories & Charms</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>

/* ===== SIDE MENU ===== */
.side-menu {
    position: fixed;
    top: 0;
    left: -320px;
    width: 280px;
    height: 100%;
    background: #111;
    padding: 25px;
    transition: 0.4s;
    z-index: 1002;

    overflow-y: auto;

    /* ===== HIDE SCROLLBAR ===== */
    scrollbar-width: none;          /* Firefox */
    -ms-overflow-style: none;       /* IE & Edge */
}

/* Chrome, Safari, Opera */
.side-menu::-webkit-scrollbar {
    display: none;
}

.side-menu h3{
    color:#fff;
    margin-bottom:20px;
}
.side-menu a{
    display:block;
    padding:12px 0;
    color:#ddd;
    text-decoration:none;
    border-bottom:1px solid #222;
}
.side-menu a:hover{
    color:#ffb703;
    padding-left:10px;
}
.close-btn{
    color:#fff;
    font-size:22px;
    cursor:pointer;
    position:absolute;
    top:18px;
    right:18px;
}

/* ===== HERO SLIDER ===== */
.hero-slider {
    position: relative;
    height: 85vh;
    overflow: hidden;
}

.hero-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1.2s ease-in-out;
}

.hero-slide.active {
    opacity: 1;
}

/* DARK OVERLAY */
.hero-slider::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
    z-index: 1;
}

/* HERO TEXT */
.hero-content {
    position: absolute;
    z-index: 2;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    text-align: center;

    /* animation */
    animation: heroFadeUp 1.3s ease forwards;
}

.hero-content h1 {
    font-size: 56px;
    letter-spacing: 3px;
}

.hero-content p {
    font-size: 18px;
    margin: 15px 0 30px;
}

.hero-content a {
    padding: 14px 32px;
    background: #fff;
    color: #000;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.4s;
}

.hero-content a:hover {
    background: #ffb703;
}


/* ===== PRODUCTS ===== */
.section-title{
    text-align:center;
    font-size:34px;
    margin:60px 0 20px;
}
.products{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:30px;
    padding:40px 60px;
}
@media(max-width:992px){
    .products{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:576px){
    .products{grid-template-columns:1fr;padding:20px;}
}
.product{
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    transition:.4s;
}
.product:hover{transform:translateY(-10px);}
.product img{
    width:100%;
    height:240px;
    object-fit:cover;
}
.product-content{
    padding:20px;
    text-align:center;
}
.product-content h3{margin-bottom:8px;}
.product-content a{
    padding:10px 22px;
    background:#111;
    color:#fff;
    border-radius:25px;
    text-decoration:none;
}
.product-content a:hover{background:#ffb703;color:#000}

/* ===== FOOTER ===== */
.footer{
    background:#111;
    color:#fff;
    text-align:center;
    padding:18px;
    margin-top:60px;
}

/* ===== ANIMATION ===== */
@keyframes heroFadeUp {
    from {
        opacity: 0;
        transform: translate(-50%, -45%); /* small upward movement */
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%); /* PERFECT CENTER */
    }
}
</style>
</head>

<body>



<!-- SIDE MENU -->
<div id="sideMenu" class="side-menu">
    <span class="close-btn" onclick="closeMenu()">✖</span>
    <h3>Accessories</h3>

    <a href="index.php?cat=Accessories&type=Earrings">Earrings</a>
    <a href="index.php?cat=Accessories&type=Watches">Watches</a>
    <a href="index.php?cat=Accessories&type=Necklace">Necklace</a>
    <a href="index.php?cat=Accessories&type=Bracelet">Bracelet</a>
    <a href="index.php?cat=Accessories&type=Anklet">Anklet</a>
    <a href="index.php?cat=Accessories&type=Rings">Rings</a>
    <a href="index.php?cat=Accessories&type=Choker">Choker</a>
    <a href="index.php?cat=Accessories&type=Hair Clip">Hair Clip</a>
    <a href="index.php?cat=Accessories&type=Hair Band">Hair Band</a>
    <a href="index.php?cat=Accessories&type=Clutcher">Clutcher</a>

    <h3 style="margin-top:25px;">Charms</h3>
    <a href="index.php?cat=Charms&type=Phone Charm">Phone Charm</a>
    <a href="index.php?cat=Charms&type=Key Chain">Key Chain</a>
</div>


<div class="hero-slider">
    <div class="hero-slide active" style="background-image:url('https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3');"></div>
    <div class="hero-slide" style="background-image:url('https://tse3.mm.bing.net/th/id/OIP.68SrVPrPHEFrWlqHNw2AbQHaD4?pid=Api&P=0&h=220');"></div>
    <div class="hero-slide" style="background-image:url('https://tse3.mm.bing.net/th/id/OIP.8_1_-xFgyxd4jeOsw5dutQHaD4?pid=Api&P=0&h=220');"></div>
    <div class="hero-slide" style="background-image:url('https://tse4.mm.bing.net/th/id/OIP.WJvWaIYjsR5ygd-PEYnIOwHaHa?pid=Api&P=0&h=220');"></div>
    <div class="hero-slide" style="background-image:url('https://tse1.mm.bing.net/th/id/OIP.24j--05cbefOINc-7amcIgHaD4?pid=Api&P=0&h=220');"></div>

    <div class="hero-content">
        <h1>Elegant Accessories</h1>
        <p>Designed for modern women</p>
        <a href="#shop">Shop Collection</a>
    </div>
</div>


<!-- PRODUCTS -->
<h2 class="section-title" id="shop">New Arrivals</h2>

<div class="products">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="product">
    <img src="assets/images/<?php echo $row['image']; ?>">
    <div class="product-content">
        <h3><?php echo $row['name']; ?></h3>
        <p>₹<?php echo $row['price']; ?></p>
        <a href="product.php?id=<?php echo $row['id']; ?>">View Product</a>
    </div>
</div>
<?php } ?>
</div>

<!-- FOOTER -->
<div class="footer">
© <?php echo date("Y"); ?> Accessories & Charms • Designed with ❤
</div>

<script>
function openMenu(){
    document.getElementById("sideMenu").style.left="0";
}
function closeMenu(){
    document.getElementById("sideMenu").style.left="-320px";
}
</script>
<script>
let slides = document.querySelectorAll('.hero-slide');
let index = 0;

setInterval(() => {
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}, 3000); // 3 seconds
</script>

</body>
</html>