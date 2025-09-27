<?php
session_start();
require_once "config.php";

// Magic link
if (isset($_GET['session'])) {
    $session_key = $_GET['session'];
    $stmt = $mysqli->prepare("SELECT id, chat_id, expires_at FROM otp_sessions WHERE session_key=? LIMIT 1");
    $stmt->bind_param("s", $session_key);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (strtotime($row['expires_at']) < time()) die("❌ Session expired");
        $_SESSION['chat_id'] = $row['chat_id'];
        $stmt = $mysqli->prepare("DELETE FROM otp_sessions WHERE id=?");
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
        header("Location: cabinet.php");
        exit();
    } else {
        die("❌ Invalid session");
    }
}

// Manual OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = trim($_POST['otp'] ?? '');
    if ($otp === '') die("❌ OTP required");
    $stmt = $mysqli->prepare("SELECT id, chat_id, expires_at FROM otp_sessions WHERE otp=? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("s", $otp);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (strtotime($row['expires_at']) < time()) die("❌ OTP expired");
        $_SESSION['chat_id'] = $row['chat_id'];
        $stmt = $mysqli->prepare("DELETE FROM otp_sessions WHERE id=?");
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
        header("Location: cabinet.php");
        exit();
    } else {
        die("❌ Invalid OTP");
    }
}

die("Invalid request");
?>
