<?php
session_start();

/* MANUAL GOOGLE SDK LOAD — CORRECT FOR YOUR STRUCTURE */
require_once __DIR__ . '/vendor/autoload.php';


$client = new Google\Client();

$client->setClientId("id");
$client->setClientSecret("secret");

$client->setRedirectUri(
    "http://localhost/accessories-shop-main/google-callback.php"
);

$client->addScope("email");
$client->addScope("profile");

header("Location: " . $client->createAuthUrl());
exit();
