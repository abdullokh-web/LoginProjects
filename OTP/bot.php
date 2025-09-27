<?php
require_once "config.php";

$update = json_decode(file_get_contents('php://input'), true);
if (!$update || !isset($update['message'])) exit;

$chat_id = $update['message']['chat']['id'];
$text    = $update['message']['text'] ?? "";

if (preg_match('/^\/start(?:\s+login_(.+))?$/', $text, $matches)) {
    if (isset($matches[1])) {
        $session_key = filter_var($matches[1], FILTER_SANITIZE_STRING);
        $otp = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
        $expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $stmt = $mysqli->prepare("INSERT INTO otp_sessions (chat_id, otp, expires_at, session_key) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $chat_id, $otp, $expires_at, $session_key);
        $stmt->execute();
        $stmt->close();

        $message = "🔐 Your OTP: <b>$otp</b>\n⏳ Expires in 5 minutes.\n\n";
        $message .= "Or click to login instantly:\n";
        $message .= "https://yourdomain.com/check_otp.php?session=$session_key";

        file_get_contents($bot_api . "sendMessage?chat_id=$chat_id&text=" . urlencode($message) . "&parse_mode=HTML");
    } else {
        $msg = "👋 Welcome! Please use the login link on the website to authenticate.";
        file_get_contents($bot_api . "sendMessage?chat_id=$chat_id&text=" . urlencode($msg));
    }
}
?>
