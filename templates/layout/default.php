<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

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

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
        </div>
        <div class="top-nav-links">
            <a target="_blank" rel="noopener" href="https://book.cakephp.org/5/">Documentation</a>
            <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <div class="flash-container">
                <?= $this->Flash->render() ?>
            </div>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
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
