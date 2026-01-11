<?php
session_start();
include("config/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($q);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Login</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
body {
    background: linear-gradient(135deg, #111, #333);
}

.login-box {
    width: 400px;
    margin: 120px auto;
    background: #fff;
    padding: 35px;
    border-radius: 14px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    animation: fadeUp 1s ease;
}

.login-box h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 26px;
    color: #111;
}

.login-icon {
    width: 70px;
    height: 70px;
    background: #111;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin: 0 auto 15px;
}

.login-box input {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.password-box {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 13px;
    color: #777;
}

.login-box button {
    width: 100%;
    padding: 12px;
    background: #111;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 10px;
}

.login-box button:hover {
    background: #ffb703;
    color: #000;
}

/* GOOGLE LOGIN */
.google-btn {
    width: 100%;
    padding: 12px;
    border-radius: 30px;
    border: 1px solid #ddd;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.google-btn:hover {
    background: #f1f1f1;
}

.divider {
    text-align: center;
    margin: 18px 0;
    position: relative;
    color: #777;
    font-size: 14px;
}

.divider::before,
.divider::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #ddd;
}

.divider::before { left: 0; }
.divider::after { right: 0; }

.error-msg {
    text-align: center;
    color: red;
    margin-bottom: 10px;
}

.register-link {
    text-align: center;
    margin-top: 15px;
}

.register-link a {
    color: #111;
    font-weight: 600;
    text-decoration: none;
}

.register-link a:hover {
    color: #ffb703;
}

.trust-text {
    text-align: center;
    font-size: 12px;
    color: #777;
    margin-top: 12px;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<div class="login-box">

    <div class="login-icon">👤</div>
    <h2>User Login</h2>

    <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>

    <!-- EMAIL / PASSWORD LOGIN -->
    <form method="post">
        <input type="email" name="email" placeholder="Email Address" required>

        <div class="password-box">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()">Show</span>
        </div>

        <button name="login">Login</button>
    </form>

    <div class="divider">or</div>

    <!-- GOOGLE LOGIN -->
    <button class="google-btn" onclick="googleLogin()">
        <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="18">
        Continue with Google
    </button>

    <div class="register-link">
        Don’t have an account?
        <a href="register.php">Register</a>
    </div>

    <div class="trust-text">
        🔒 Secure login • Your data is protected
    </div>

</div>


<script>
function togglePassword() {
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}


function googleLogin() {
    window.location.href = "google-login.php";
}


</script>

</body>
</html>
