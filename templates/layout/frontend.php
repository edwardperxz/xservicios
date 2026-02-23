<?php
/**
 * Xservicios Frontend Layout - Clean rendering without CakePHP UI
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('title') ?: 'Xservicios' ?></title>
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
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
    <div class="flash-container">
        <?= $this->Flash->render() ?>
    </div>
    <?= $this->fetch('content') ?>
    <script src="/js/i18n.js"></script>
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
