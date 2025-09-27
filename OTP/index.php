<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🔐 OTP Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; display:flex; justify-content:center; align-items:center; height:100vh; }
    .login-box { background:white; padding:40px; border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.1); width:100%; max-width:400px; text-align:center; }
    .btn-telegram { background:#0088cc; color:white; font-weight:bold; border-radius:50px; padding:12px 25px; text-decoration:none; display:inline-block; margin-bottom:20px; }
    .btn-telegram:hover { background:#0077b6; color:white; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>🔐 Secure OTP Login</h2>
    <p>Step 1: Click below to get OTP via Telegram</p>
    <a href="https://t.me/OTPOrgBot?start=login_<?php echo time(); ?>" class="btn-telegram w-100">Login with Telegram</a>
    <hr>
    <p>Step 2: Enter OTP received in Telegram</p>
    <form method="post" action="check_otp.php">
      <input type="text" class="form-control my-3" name="otp" placeholder="Enter OTP" maxlength="6" required>
      <button type="submit" class="btn btn-dark w-100">Verify OTP</button>
    </form>
  </div>
</body>
</html>
