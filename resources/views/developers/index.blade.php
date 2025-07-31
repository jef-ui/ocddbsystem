<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Module Not Ready</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #f4f4f4;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
    }

    .message-box {
      text-align: center;
      padding: 30px 40px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      max-width: 400px;
    }

    .logo {
      max-width: 120px;
      margin-bottom: 20px;
    }

    .message-box h1 {
      font-size: 24px;
      margin-bottom: 15px;
      color: #ff6600;
    }

    .message-box p {
      font-size: 16px;
      margin-bottom: 10px;
    }

    .loader {
      margin-top: 20px;
      border: 4px solid #f3f3f3;
      border-top: 4px solid #ff6600;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
      margin-left: auto;
      margin-right: auto;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .footer-note {
      margin-top: 30px;
      font-size: 13px;
      color: #777;
    }
  </style>
</head>
<body>

<div class="message-box">
  <img src="{{ asset('images/logo.png') }}" alt="LTMS Logo" class="logo">
  <h1>Module Loading</h1>
  <h3>Calendar of Activities</h3>
  <p>Coming soon! module in progress.</p>
  <p>Please wait while the developer finishes the module.</p>
  <div class="loader"></div>
  <div class="footer-note">
    For more information, please contact <strong>Mr. Jefrie G. Rodriguez</strong>.
  </div>
</div>

</body>
</html>
