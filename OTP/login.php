<?php
require "config.php";

$token = bin2hex(random_bytes(16));
$expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

$stmt = $mysqli->prepare("INSERT INTO otp_sessions (token, otp_expiry) VALUES (?, ?)");
$stmt->bind_param("ss", $token, $expiry);
$stmt->execute();

header("Location: verify.php?token=$token");
exit;
?>
