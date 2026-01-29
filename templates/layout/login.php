<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #0d0d0d;
      color: #ffffff;
      min-height: 100vh;
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background-color: transparent;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
    }

    .logo {
      font-family: 'Inter', sans-serif;
      font-size: 24px;
      font-weight: 700;
      color: #c9a962;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .logo span {
      font-style: italic;
    }

    .nav {
      display: flex;
      gap: 30px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #a0a0a0;
      text-decoration: none;
      font-size: 14px;
      transition: color 0.3s;
    }

    .nav-item:hover,
    .nav-item.active {
      color: #c9a962;
    }

    .nav-item svg {
      width: 18px;
      height: 18px;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .lang-selector {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #a0a0a0;
      font-size: 14px;
    }

    .lang-selector .active {
      color: #ffffff;
    }

    .icon-btn {
      background: none;
      border: none;
      color: #a0a0a0;
      cursor: pointer;
      padding: 8px;
      transition: color 0.3s;
    }

    .icon-btn:hover {
      color: #c9a962;
    }

    .icon-btn.gold {
      color: #c9a962;
    }

    .user-icon-circle {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: #1a1a1a;
      border: 1px solid #c9a962;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .user-icon-circle svg {
      width: 18px;
      height: 18px;
      color: #c9a962;
    }

    .create-account-btn {
      background-color: #1a1512;
      border: 1px solid #4a7c59;
      color: #4a7c59;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 500;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s;
      font-family: 'Inter', sans-serif;
      text-decoration: none;
    }

    .create-account-btn:hover {
      background-color: #4a7c59;
      color: #ffffff;
    }

    /* Hero Section with Background */
    .hero-section {
      min-height: 100vh;
      background-image: url('<?= $this->Url->image('login-bg.jpeg') ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
      display: flex;
      align-items: center;
      padding: 120px 60px 60px;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to right, rgba(13, 13, 13, 0.95) 0%, rgba(13, 13, 13, 0.7) 40%, rgba(13, 13, 13, 0.3) 70%, transparent 100%);
    }

    /* Form Container */
    .form-container {
      position: relative;
      z-index: 10;
      max-width: 480px;
      width: 100%;
    }

    .form-title {
      font-family: 'Playfair Display', serif;
      font-size: 48px;
      font-weight: 400;
      font-style: italic;
      color: #c9a962;
      margin-bottom: 10px;
    }

    .form-subtitle {
      font-size: 16px;
      color: #a0a0a0;
      margin-bottom: 40px;
    }

    /* Form */
    .register-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .input-group {
      position: relative;
      display: flex;
      align-items: center;
      background-color: rgba(26, 26, 26, 0.8);
      border: 1px solid rgba(201, 169, 98, 0.4);
      border-radius: 8px;
      padding: 0 20px;
      transition: border-color 0.3s;
    }

    .input-group:focus-within {
      border-color: #c9a962;
    }

    .input-icon {
      color: #c9a962;
      width: 20px;
      height: 20px;
      flex-shrink: 0;
    }

    .input-group input {
      flex: 1;
      background: transparent;
      border: none;
      padding: 18px 15px;
      color: #ffffff;
      font-size: 15px;
      font-family: 'Inter', sans-serif;
      outline: none;
    }

    .input-group input::placeholder {
      color: #a0a0a0;
    }

    .forgot-password {
      text-align: right;
      margin-top: -10px;
    }

    .forgot-password a {
      color: #a0a0a0;
      font-size: 13px;
      text-decoration: none;
      transition: color 0.3s;
    }

    .forgot-password a:hover {
      color: #c9a962;
    }

    .submit-btn {
      background-color: #1a1512;
      border: 1px solid #4a7c59;
      color: #4a7c59;
      padding: 18px;
      font-size: 16px;
      font-weight: 500;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
      font-family: 'Inter', sans-serif;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background-color: #4a7c59;
      color: #ffffff;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .header {
        padding: 15px 20px;
        flex-wrap: wrap;
        gap: 15px;
      }

      .nav {
        order: 3;
        width: 100%;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
      }

      .hero-section {
        padding: 100px 20px 40px;
      }

      .form-title {
        font-size: 36px;
      }

      .form-container {
        max-width: 100%;
      }
    }
    </style>
</head>
<body>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</body>
</html>