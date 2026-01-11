<style>
/* ===== GLIVELLE NAVBAR ===== */
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 42px;
    background: #fff;
    border-bottom: 1px solid #eee;
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* LEFT */
.nav-left {
    display: flex;
    align-items: center;
    gap: 25px;
}

.logo {
    font-size: 28px;
    font-weight: 700;
    letter-spacing: 2px;
}

.logo a {
    text-decoration: none;
    color: #000;
}

/* SEARCH */
.nav-search {
    flex: 1;
    max-width: 520px;
    position: relative;
}

.nav-search input {
    width: 100%;
    padding: 12px 44px 12px 18px;
    border-radius: 30px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 14px;
}

.nav-search span {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

/* RIGHT */
.nav-right {
    display: flex;
    align-items: center;
    gap: 22px;
}

.nav-right a {
    text-decoration: none;
    color: #000;
    font-size: 14px;
    font-weight: 500;
}

.nav-right a:hover {
    color: #c2a17e;
}

/* MOBILE */
@media(max-width:900px){
    .nav-search{display:none;}
}
</style>

<div class="navbar">

    <!-- LEFT -->
    <div class="nav-left">
        <div class="logo">
            <a href="index.php">GLIVELLE</a>
        </div>
    </div>

    <!-- SEARCH -->
    <form class="nav-search" action="index.php" method="get">
        <input type="text" name="type" placeholder='Search "Rings", "Necklace"...'>
        <span>🔍</span>
    </form>

    <!-- RIGHT -->
    <div class="nav-right">
        <a href="index.php">Shop</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>

</div>
