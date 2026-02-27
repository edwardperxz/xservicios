<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="page.title.changePassword">Xservicios - Cambiar Contraseña</title>
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

        .form-container {
            position: relative;
            z-index: 10;
            max-width: 520px;
            width: 100%;
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 44px;
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
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 20px 40px;
            }

            .form-title {
                font-size: 34px;
            }

            .form-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header sera cargado dinamicamente por header-loader.js -->

    <section class="hero-section">
        <div class="form-container">
            <h1 class="form-title" data-i18n="auth.changePasswordTitle">Cambiar Contraseña</h1>
            <p class="form-subtitle" data-i18n="auth.changePasswordSubtitle">Actualiza tu contraseña de acceso de forma segura</p>

            <form class="register-form" id="change-password-form" method="post" action="">
                <div class="input-group">
                    <svg class="input-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zm0 2c1.654 0 3 1.346 3 3v3H9V7c0-1.654 1.346-3 3-3zm0 10a2 2 0 110 4 2 2 0 010-4z"></path>
                    </svg>
                    <input type="password" name="current_password" placeholder="Contraseña actual" data-i18n-placeholder="auth.currentPassword" autocomplete="current-password" required>
                </div>

                <div class="input-group">
                    <svg class="input-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zm0 2c1.654 0 3 1.346 3 3v3H9V7c0-1.654 1.346-3 3-3zm0 10a2 2 0 110 4 2 2 0 010-4z"></path>
                    </svg>
                    <input type="password" name="new_password" placeholder="Nueva contraseña" data-i18n-placeholder="auth.newPassword" autocomplete="new-password" required>
                </div>

                <div class="input-group">
                    <svg class="input-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V7c0-2.757-2.243-5-5-5zm0 2c1.654 0 3 1.346 3 3v3H9V7c0-1.654 1.346-3 3-3zm0 10a2 2 0 110 4 2 2 0 010-4z"></path>
                    </svg>
                    <input type="password" name="confirm_password" placeholder="Confirmar nueva contraseña" data-i18n-placeholder="auth.confirmPassword" autocomplete="new-password" required>
                </div>

                <button type="submit" class="submit-btn" data-i18n="auth.updatePassword">Actualizar Contraseña</button>
            </form>
        </div>
    </section>

    <script src="/js/i18n.js"></script>
    <script src="/js/header-loader.js"></script>
    <script src="/js/header-dynamic.js"></script>
</body>
</html>
