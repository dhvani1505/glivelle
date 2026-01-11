<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

include("config/db.php");

$client = new Google\Client();

$client->setClientId("id");
$client->setClientSecret("secret");

$client->setRedirectUri(
    "http://localhost/accessories-shop-main/google-callback.php"
);

if (!isset($_GET['code'])) {
    header("Location: login.php");
    exit();
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    header("Location: login.php");
    exit();
}

$client->setAccessToken($token);

/* FETCH USER INFO */
$oauth = new Google\Service\Oauth2($client);
$userInfo = $oauth->userinfo->get();

$email = mysqli_real_escape_string($conn, $userInfo->email);
$name  = mysqli_real_escape_string($conn, $userInfo->name);

/* CHECK USER */
$q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($q);

if (!$user) {
    mysqli_query(
        $conn,
        "INSERT INTO users (name, email, password, provider)
         VALUES ('$name', '$email', NULL, 'google')"
    );
    $user_id = mysqli_insert_id($conn);
} else {
    $user_id = $user['id'];
}

$_SESSION['user'] = $user_id;
$_SESSION['name'] = $name;

header("Location: index.php");
exit();
