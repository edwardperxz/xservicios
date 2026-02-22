<?php
/** @var \App\View\AppView $this */
/** @var \App\Model\Entity\XservUsuario $xservUsuario */

$this->layout = 'login';
?>

<header class="header">
    <?= $this->Html->link('<div class="logo"><span>X</span>SERVICIOS</div>', '/', ['escape' => false, 'style' => 'text-decoration: none;']) ?>
    <nav class="nav" style="display: flex; align-items: center; gap: 20px;">
        <!-- Language Toggle Button -->
        <button class="lang-button" id="langToggle" aria-label="Cambiar idioma" style="display: flex; align-items: center; gap: 8px; padding: 8px 16px; background: rgba(201, 169, 98, 0.1); border: 1px solid rgba(201, 169, 98, 0.3); border-radius: 6px; color: #c9a962; cursor: pointer; transition: all 0.3s;">
            <svg style="width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2;" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
            <span class="lang-code" style="font-size: 13px; font-weight: 600;">ES</span>
        </button>
    </nav>
</header>

<section class="hero-section">
    <div class="form-container">
        <h1 class="form-title" data-i18n="auth.signUpTitle">Crea una cuenta</h1>
        <p class="form-subtitle" data-i18n="auth.signUpSubtitle">Regístrate para continuar</p>
        
        <?= $this->Form->create($xservUsuario, [
            'url' => ['controller' => 'XservUsuarios', 'action' => 'register'],
            'class' => 'register-form'
        ]) ?>
            <div class="input-group">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <?= $this->Form->control('username', [
                    'label' => false,
                    'placeholder' => 'Nombre de Usuario',
                    'data-i18n-placeholder' => 'auth.username',
                    'required' => true,
                    'autocomplete' => 'username',
                    'error' => false,
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
            </div>

            <div class="input-group">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <?= $this->Form->control('correo', [
                    'label' => false,
                    'type' => 'email',
                    'placeholder' => 'Correo Electrónico',
                    'data-i18n-placeholder' => 'form.email',
                    'required' => true,
                    'autocomplete' => 'email',
                    'id' => 'register-correo',
                    'pattern' => '[^\s@]+@[^\s@]+\.[^\s@]+',
                    'title' => 'Ingrese un correo electrónico válido (ejemplo@dominio.com)',
                    'error' => false,
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
            </div>
            
            <div class="input-group">
                <svg class="input-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5zm0 2c1.654 0 3 1.346 3 3v3H9V7c0-1.654 1.346-3 3-3zm0 10a2 2 0 110 4 2 2 0 010-4z"></path>
                </svg>
                <?= $this->Form->control('password', [
                    'label' => false,
                    'placeholder' => 'Contraseña',
                    'data-i18n-placeholder' => 'form.password',
                    'required' => true,
                    'autocomplete' => 'new-password',
                    'id' => 'register-password',
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
                <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
                    <svg class="eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                    <svg class="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>

            <!-- Indicadores de seguridad de contraseña -->
            <div class="password-strength" id="password-strength" style="display: none; margin-top: -10px; margin-bottom: 15px; padding: 12px; background: rgba(26, 26, 26, 0.6); border-radius: 6px; border: 1px solid rgba(201, 169, 98, 0.2);">
                <p style="font-size: 12px; color: #a0a0a0; margin-bottom: 8px; font-weight: 500;" data-i18n="password.requirements">La contraseña debe contener:</p>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 6px;">
                    <li id="length-check" style="font-size: 12px; color: #e74c3c; display: flex; align-items: center; gap: 6px;">
                        <span class="check-icon">✗</span> <span data-i18n="password.minLength">Mínimo 8 caracteres</span>
                    </li>
                    <li id="uppercase-check" style="font-size: 12px; color: #e74c3c; display: flex; align-items: center; gap: 6px;">
                        <span class="check-icon">✗</span> <span data-i18n="password.uppercase">Al menos una mayúscula</span>
                    </li>
                    <li id="number-check" style="font-size: 12px; color: #e74c3c; display: flex; align-items: center; gap: 6px;">
                        <span class="check-icon">✗</span> <span data-i18n="password.number">Al menos un número</span>
                    </li>
                </ul>
            </div>

            <div class="input-group" id="confirm-password-group">
                <svg class="input-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C9.243 2 7 4.243 7 7v3H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5zm0 2c1.654 0 3 1.346 3 3v3H9V7c0-1.654 1.346-3 3-3zm0 10a2 2 0 110 4 2 2 0 010-4z"></path>
                </svg>
                <input type="password" name="password_confirm" id="confirm-password" placeholder="Confirmar Contraseña" data-i18n-placeholder="form.confirmPassword" required autocomplete="new-password" style="flex: 1; background: transparent; border: none; padding: 18px 15px; color: #ffffff; font-size: 15px; font-family: 'Inter', sans-serif; outline: none;">
                <button type="button" class="toggle-password" aria-label="Mostrar contraseña">
                    <svg class="eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                    <svg class="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>

            <!-- Indicador de coincidencia de contraseñas -->
            <div id="password-match-indicator" style="display: none; margin-top: -10px; margin-bottom: 15px; padding: 10px 12px; border-radius: 6px; font-size: 12px; display: flex; align-items: center; gap: 6px;">
                <span id="match-icon"></span>
                <span id="match-text" data-i18n="password.match">Las contraseñas coinciden</span>
            </div>

            <?php
                echo $this->Form->hidden('rol', ['value' => 'cliente']); // Por defecto al registrarse
                echo $this->Form->hidden('estado', ['value' => 'activo']);
            ?>
            
            <button type="submit" class="submit-btn" data-i18n="auth.signUp">Crear Cuenta</button>
            
            <p style="text-align: center; margin-top: 15px; font-size: 14px; color: #a0a0a0;">
                <span data-i18n="auth.haveAccount">¿Ya tienes cuenta?</span> <?= $this->Html->link('<span data-i18n="auth.login">Inicia sesión</span>', ['action' => 'login'], ['style' => 'color: #c9a962; text-decoration: none;', 'escape' => false]) ?>
            </p>
        <?= $this->Form->end() ?>
    </div>
</section>