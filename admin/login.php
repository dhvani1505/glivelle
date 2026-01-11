<?php
session_start();
include("../config/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
    $admin = mysqli_fetch_assoc($query);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Admin Email or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body {
            background: linear-gradient(135deg, #111, #333);
        }

        .admin-login-box {
            width: 400px;
            margin: 120px auto;
            background: #fff;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            animation: fadeUp 1s ease;
        }

        .admin-login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            color: #111;
        }

        .admin-login-box input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .admin-login-box button {
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

        .admin-login-box button:hover {
            background: #ffb703;
            color: #000;
        }

        .admin-icon {
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

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="admin-login-box">

    <div class="admin-icon">🔒</div>

    <h2>Admin Login</h2>

    <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>

</div>

</body>
</html>
