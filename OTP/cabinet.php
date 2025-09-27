<?php
session_start();
if (!isset($_SESSION['chat_id'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f8f9fa; display:flex; justify-content:center; align-items:center; height:100vh; }
    .dashboard { background:white; padding:30px; border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.1); text-align:center; width:100%; max-width:400px; }
  </style>
</head>
<body>
  <div class="dashboard">
    <h2>✅ Login Successful</h2>
    <p><strong>Telegram Chat ID:</strong> <?php echo htmlspecialchars($_SESSION['chat_id']); ?></p>
    <a href="index.html" class="btn btn-secondary w-100">Logout</a>
  </div>
</body>
</html>
