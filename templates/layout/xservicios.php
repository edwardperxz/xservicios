<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Xservicios - Transporte Turístico de Lujo en Chiriquí</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --gold: #c9a962;
            --gold-light: #d4b978;
            --gold-dark: #a88b4a;
            --dark-bg: #0d0d0d;
            --dark-card: #1a1a1a;
            --dark-lighter: #2a2a2a;
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
            --green: #4ade80;
            --orange: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-white);
            min-height: 100vh;
            padding-top: 70px;
        }

        /* Header */
        /* Estilos del header se cargan desde header-responsive.css */

        /* Flash Messages */
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
    </style>
</head>
<body>
    <!-- Header será cargado dinámicamente por header-loader.js -->

    <div class="flash-container">
        <?= $this->Flash->render() ?>
    </div>
    <?= $this->fetch('content') ?>
    <script src="/js/i18n.js"></script>
    <script src="/js/header-loader.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
