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
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2.5rem;
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: var(--text-white);
            text-decoration: none;
        }

        .logo-x {
            color: var(--gold);
            font-size: 1.8rem;
            font-weight: 700;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-gray);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .nav-item:hover {
            color: var(--gold);
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
            gap: 1.5rem;
        }

        .lang-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-gray);
            font-size: 0.875rem;
        }

        .lang-selector span.active {
            color: var(--text-white);
        }

        .header-icon {
            width: 20px;
            height: 20px;
            stroke: var(--gold);
            fill: none;
            cursor: pointer;
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
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .user-name {
            font-size: 0.875rem;
            color: var(--text-white);
        }

        /* Flash Messages */
        .message {
            padding: 1rem 1.5rem;
            margin: 1rem 2.5rem;
            border-radius: 8px;
            font-size: 14px;
        }

        .message.success {
            background-color: rgba(74, 222, 128, 0.15);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .message.error {
            background-color: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?= $this->element('header_auth') ?>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

</body>
</html>
