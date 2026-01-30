<?php
/** @var \App\View\AppView $this */

$this->layout = 'login';
?>

<header class="header">
    <div class="logo"><span>X</span>SERVICIOS</div>
    </header>

<section class="hero-section">
    <div class="form-container">
        <h1 class="form-title">Inicia Sesión</h1>
        <p class="form-subtitle">Inicia sesión en cualquiera de tus cuentas existentes</p>
        
        <?= $this->Form->create(null, ['class' => 'register-form']) ?>
            
            <div class="input-group">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <?= $this->Form->control('username', [
                    'label' => false,
                    'placeholder' => 'Nombre de Usuario',
                    'required' => true,
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
                    'required' => true,
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
            </div>
            
            <div class="forgot-password">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
            
            <?= $this->Form->button('Iniciar Sesión', ['class' => 'submit-btn']) ?>
            <div class="forgot-password register-link">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>">
                    ¿No tienes una cuenta? Regístrate
                </a>
            </div>


            
        <?= $this->Form->end() ?>
    </div>
</section>