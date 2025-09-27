<?php
// Database connection
define('DB_HOST', 'localhost'); // Add your database host here
define('DB_USER', 'root'); // Add your database username here
define('DB_PASS', ''); // Add your database password here
define('DB_NAME', 'dbname'); // Add your database name here

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
    die("❌ DB connection failed: " . $mysqli->connect_error);
}

// Telegram Bot
$bot_token    = ""; // Add your bot token here
$bot_username = "OTPOrgBot";
$bot_api      = "https://api.telegram.org/bot$bot_token/";
?>
