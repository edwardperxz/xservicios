<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    
    <!-- Pre-load language from localStorage to avoid flash -->
    <script src="/js/i18n-preload.js"></script>
    
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

    .header-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .lang-button {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      background: rgba(201, 169, 98, 0.1);
      border: 1px solid rgba(201, 169, 98, 0.3);
      border-radius: 6px;
      color: #c9a962;
      cursor: pointer;
      transition: all 0.3s;
      font-family: 'Inter', sans-serif;
    }

    .lang-button:hover {
      background: rgba(201, 169, 98, 0.2);
      border-color: #c9a962;
      transform: translateY(-1px);
    }

    .lang-button svg {
      width: 18px;
      height: 18px;
    }

    .lang-button .lang-code {
      font-size: 13px;
      font-weight: 600;
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

    .toggle-password {
      background: none;
      border: none;
      color: #a0a0a0;
      cursor: pointer;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.3s;
      outline: none;
      flex-shrink: 0;
    }

    .toggle-password:hover {
      color: #c9a962;
    }

    .toggle-password svg {
      width: 20px;
      height: 20px;
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

    .flash-container {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 9999;
      display: flex;
      flex-direction: column;
      gap: 12px;
      align-items: center;
      width: min(520px, calc(100% - 32px));
      pointer-events: none;
    }

    .message {
      width: 100%;
      padding: 14px 18px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 500;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
      border: 1px solid rgba(255, 255, 255, 0.08);
      background: rgba(26, 26, 26, 0.95);
      pointer-events: auto;
    }

    .message.success {
      background-color: rgba(74, 124, 89, 0.2);
      color: #4ade80;
      border: 1px solid rgba(74, 124, 89, 0.45);
    }

    .message.error {
      background-color: rgba(231, 76, 60, 0.18);
      color: #f87171;
      border: 1px solid rgba(231, 76, 60, 0.45);
    }

    .message.warning {
      background-color: rgba(245, 158, 11, 0.18);
      color: #fbbf24;
      border: 1px solid rgba(245, 158, 11, 0.45);
    }

    .message.info {
      background-color: rgba(59, 130, 246, 0.18);
      color: #60a5fa;
      border: 1px solid rgba(59, 130, 246, 0.45);
    }

    .message.hidden {
      display: none;
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
  <div class="flash-container">
    <?= $this->Flash->render() ?>
  </div>
    <?= $this->fetch('content') ?>
    
    <!-- i18n System -->
    <script src="/js/i18n.js"></script>
    
    <!-- Toggle Password Visibility -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-password');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const eyeOpen = this.querySelector('.eye-open');
                    const eyeClosed = this.querySelector('.eye-closed');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        eyeOpen.style.display = 'block';
                        eyeClosed.style.display = 'none';
                    } else {
                        input.type = 'password';
                        eyeOpen.style.display = 'none';
                        eyeClosed.style.display = 'block';
                    }
                });
            });

            // Validación de seguridad de contraseña en tiempo real
            const passwordInput = document.getElementById('register-password');
            const strengthIndicator = document.getElementById('password-strength');
            
            if (passwordInput && strengthIndicator) {
                // Mostrar indicadores al enfocar el campo
                passwordInput.addEventListener('focus', function() {
                    strengthIndicator.style.display = 'block';
                });

                // Validar en tiempo real
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    
                    // Mínimo 8 caracteres
                    const lengthCheck = document.getElementById('length-check');
                    if (password.length >= 8) {
                        lengthCheck.style.color = '#4a7c59';
                        lengthCheck.querySelector('.check-icon').textContent = '✓';
                    } else {
                        lengthCheck.style.color = '#e74c3c';
                        lengthCheck.querySelector('.check-icon').textContent = '✗';
                    }
                    
                    // Al menos una mayúscula
                    const uppercaseCheck = document.getElementById('uppercase-check');
                    if (/[A-Z]/.test(password)) {
                        uppercaseCheck.style.color = '#4a7c59';
                        uppercaseCheck.querySelector('.check-icon').textContent = '✓';
                    } else {
                        uppercaseCheck.style.color = '#e74c3c';
                        uppercaseCheck.querySelector('.check-icon').textContent = '✗';
                    }
                    
                    // Al menos un número
                    const numberCheck = document.getElementById('number-check');
                    if (/[0-9]/.test(password)) {
                        numberCheck.style.color = '#4a7c59';
                        numberCheck.querySelector('.check-icon').textContent = '✓';
                    } else {
                        numberCheck.style.color = '#e74c3c';
                        numberCheck.querySelector('.check-icon').textContent = '✗';
                    }
                });

                // Validación de coincidencia de contraseñas
                const confirmPasswordInput = document.getElementById('confirm-password');
                const matchIndicator = document.getElementById('password-match-indicator');
                const matchIcon = document.getElementById('match-icon');
                const matchText = document.getElementById('match-text');
                
                function validatePasswordMatch() {
                    const password = passwordInput.value;
                    const confirmPassword = confirmPasswordInput.value;
                    
                    if (password.length > 0 && confirmPassword.length > 0) {
                        matchIndicator.style.display = 'flex';
                        
                        const lang = localStorage.getItem('language') || 'es';
                        const translations = window.translations || {};
                        const t = translations[lang] || translations['es'] || {};
                        
                        if (password === confirmPassword) {
                            // Contraseñas coinciden
                            matchIndicator.style.background = 'rgba(74, 124, 89, 0.2)';
                            matchIndicator.style.border = '1px solid rgba(74, 124, 89, 0.4)';
                            matchIndicator.style.color = '#4a7c59';
                            matchIcon.textContent = '✓';
                            matchText.textContent = t['password.match'] || 'Las contraseñas coinciden';
                        } else {
                            // Contraseñas no coinciden
                            matchIndicator.style.background = 'rgba(231, 76, 60, 0.2)';
                            matchIndicator.style.border = '1px solid rgba(231, 76, 60, 0.4)';
                            matchIndicator.style.color = '#e74c3c';
                            matchIcon.textContent = '✗';
                            matchText.textContent = t['password.noMatch'] || 'Las contraseñas no coinciden';
                        }
                    } else {
                        matchIndicator.style.display = 'none';
                    }
                }
                
                if (confirmPasswordInput) {
                    confirmPasswordInput.addEventListener('input', validatePasswordMatch);
                    passwordInput.addEventListener('input', validatePasswordMatch);
                }

                // Validar antes de enviar el formulario
                const form = passwordInput.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const password = passwordInput.value;
                        
                        let isValid = true;
                        const lang = localStorage.getItem('language') || 'es';
                        const translations = window.translations || {};
                        const t = translations[lang] || translations['es'];
                        
                        let errorMessages = [];
                        
                        if (password.length < 8) {
                            isValid = false;
                            errorMessages.push('- ' + (t['password.minLength'] || 'Mínimo 8 caracteres'));
                        }
                        if (!/[A-Z]/.test(password)) {
                            isValid = false;
                            errorMessages.push('- ' + (t['password.uppercase'] || 'Al menos una mayúscula'));
                        }
                        if (!/[0-9]/.test(password)) {
                            isValid = false;
                            errorMessages.push('- ' + (t['password.number'] || 'Al menos un número'));
                        }
                        
                        // Validar que las contraseñas coincidan
                        if (confirmPasswordInput) {
                            const confirmPassword = confirmPasswordInput.value;
                            if (password !== confirmPassword) {
                                isValid = false;
                                errorMessages.push('- ' + (t['password.noMatch'] || 'Las contraseñas no coinciden'));
                            }
                        }
                        
                        if (!isValid) {
                            e.preventDefault();
                            const errorTitle = t['password.requirements'] || 'La contraseña debe cumplir con los requisitos de seguridad:';
                            alert(errorTitle + '\n' + errorMessages.join('\n'));
                        }
                    });
                }
            }

                  const flashMessages = document.querySelectorAll('.message');
                  if (flashMessages.length) {
                    flashMessages.forEach(message => {
                      setTimeout(() => {
                        message.style.transition = 'opacity 0.3s ease';
                        message.style.opacity = '0';
                        setTimeout(() => {
                          message.remove();
                        }, 300);
                      }, 5000);
                    });
                  }
        });
    </script>
</body>
</html>