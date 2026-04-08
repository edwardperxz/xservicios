<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="page.title.login">Xservicios - Iniciar Sesión</title>
  <script src="/js/i18n-preload.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    .logo-x {
      color: #c9a962;
      font-size: 28px;
      font-weight: 700;
      margin-right: 6px;
    }

    .nav-menu {
      display: flex;
      gap: 30px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      min-width: 90px;
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

    .nav-icon {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      fill: none;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .header-icon {
      width: 20px;
      height: 20px;
      stroke: #c9a962;
      fill: none;
      cursor: pointer;
    }

    .auth-button {
      padding: 0.5rem 1.1rem;
      border: 1px solid #c9a962;
      border-radius: 20px;
      color: #c9a962;
      font-size: 0.8rem;
      text-decoration: none;
      transition: all 0.3s;
      white-space: nowrap;
    }

    .auth-button:hover {
      background: rgba(201, 169, 98, 0.15);
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      cursor: pointer;
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, #c9a962, #a88b4a);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
      font-weight: 600;
      color: #0d0d0d;
    }

    .user-name {
      font-size: 0.875rem;
      color: #ffffff;
    }

    .is-hidden {
      display: none !important;
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
      background-image: url('/img/car-concept.jpeg');
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
  <!-- Header será cargado dinámicamente por header-loader.js -->

  <section class="hero-section">
    <div class="form-container">
      <h1 class="form-title" data-i18n="auth.loginTitle">Inicia Sesión</h1>
      <p class="form-subtitle" data-i18n="auth.loginSubtitle">Inicia sesión en cualquiera de tus cuentas existentes</p>
      
      <form class="register-form" id="loginForm" action="/xserv-usuarios/login" method="POST">
        <input type="hidden" name="_csrfToken" id="csrfToken" value="">
        <div class="input-group">
          <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          <input type="text" name="username" data-i18n-placeholder="auth.username" placeholder="Nombre de Usuario" autocomplete="username" required>
        </div>
        
        <div class="input-group">
          <svg class="input-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5zm0 2c1.654 0 3 1.346 3 3v3H9V7c0-1.654 1.346-3 3-3zm0 10a2 2 0 110 4 2 2 0 010-4z"></path>
          </svg>
          <input type="password" name="password" data-i18n-placeholder="form.password" placeholder="Contraseña" autocomplete="current-password" required>
        </div>
        
        <div class="forgot-password">
          <a href="#" data-i18n="auth.forgotPassword">¿Olvidaste tu contraseña?</a>
        </div>
        
        <button type="submit" class="submit-btn" data-i18n="auth.login">Iniciar Sesión</button>
      </form>
    </div>
  </section>
  <script>
    // En demo mantenemos este formulario para login simulado.
    if (!window.XSERVICIOS_DEMO) {
      window.location.href = '/xserv-usuarios/login';
    }
  </script>
  <script src="/js/i18n.js" defer></script>
  <script src="/js/header-loader.js" defer></script>
  <script src="/js/header-dynamic.js" defer></script>
</body>
</html>
