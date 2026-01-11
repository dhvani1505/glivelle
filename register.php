<?php
session_start();
include("config/db.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already registered";
    } else {
        mysqli_query($conn, "INSERT INTO users (name,email,password)
        VALUES ('$name','$email','$password')");

        $_SESSION['user'] = mysqli_insert_id($conn);
        $_SESSION['name'] = $name;
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Registration</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
/* SAME AS USER LOGIN */
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
    margin-bottom: 25px;
    font-size: 26px;
    color: #111;
}

.login-box input {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
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

.error-msg {
    text-align: center;
    color: red;
    margin-bottom: 10px;
}

.login-link {
    text-align: center;
    margin-top: 15px;
}

.login-link a {
    color: #111;
    font-weight: 600;
    text-decoration: none;
}

.login-link a:hover {
    color: #ffb703;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<div class="login-box">

    <div class="login-icon">📝</div>

    <h2>Create Account</h2>

    <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <button name="register">Register</button>
    </form>

    <div class="login-link">
        Already have an account?
        <a href="login.php">Login</a>
    </div>

</div>

</body>
</html>
