<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $usuario
 */

$normalizeCountry = static function (string $country): string {
  $country = trim($country);
  if ($country === '') {
    return '';
  }

  return function_exists('mb_strtoupper')
    ? mb_strtoupper($country, 'UTF-8')
    : strtoupper($country);
};

$countryOptions = ['PANAMA' => 'PANAMA'];
$countriesJsonPath = ROOT . DS . 'resources' . DS . 'countries.json';

if (is_readable($countriesJsonPath)) {
  $countriesContent = file_get_contents($countriesJsonPath);
  $countriesData = json_decode($countriesContent ?: '', true);

  if (is_array($countriesData) && isset($countriesData['countries']) && is_array($countriesData['countries'])) {
    foreach ($countriesData['countries'] as $countryItem) {
      if (!is_array($countryItem) || empty($countryItem['name']) || !is_string($countryItem['name'])) {
        continue;
      }

      $countryName = $normalizeCountry($countryItem['name']);
      if ($countryName === '' || $countryName === 'PANAMA') {
        continue;
      }

      $countryOptions[$countryName] = $countryName;
    }
  }
}

$selectedCountry = $normalizeCountry((string)($usuario->pais ?? 'PANAMA'));
if ($selectedCountry === '') {
  $selectedCountry = 'PANAMA';
}

if (!isset($countryOptions[$selectedCountry])) {
  $countryOptions[$selectedCountry] = $selectedCountry;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
  <title>Editar Perfil - Xservicios</title>
  <script src="/js/i18n-preload.js"></script>
  
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
      --text-light-gray: #707070;
      --border-color: rgba(201, 169, 98, 0.2);
      --error-color: #ef4444;
      --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.3);
      --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.4);
    }

    body {
      background-color: var(--dark-bg);
      color: var(--text-white);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      line-height: 1.6;
      background-attachment: fixed;
      background-image: 
        radial-gradient(circle at 20% 50%, rgba(201, 169, 98, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(201, 169, 98, 0.05) 0%, transparent 50%);
    }

    /* Container */
    .edit-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 1.5rem 2rem 2rem;
      width: 100%;
      animation: fadeInUp 0.8s ease-out;
      padding-top: 6rem;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Header */
    .edit-header {
      background: linear-gradient(135deg, rgba(201, 169, 98, 0.15) 0%, rgba(201, 169, 98, 0.05) 100%);
      border: 1px solid var(--border-color);
      border-radius: 20px;
      padding: 1.5rem 2rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow-lg);
    }

    .edit-header h1 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 0.3rem;
      background: linear-gradient(135deg, #d4b978, #c9a962);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .edit-header p {
      color: var(--text-gray);
      font-size: 0.9rem;
    }

    /* Profile Avatar */
    .profile-avatar-section {
      text-align: center;
      padding: 1.5rem 0 1.5rem;
      border-bottom: 1px solid var(--border-color);
      margin-bottom: 1.5rem;
    }

    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: linear-gradient(135deg, #d4b978 0%, #c9a962 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #0d0d0d;
      font-weight: 700;
      font-size: 2.5rem;
      border: 3px solid #c9a962;
      box-shadow: 0 8px 24px rgba(201, 169, 98, 0.3);
      margin: 0 auto 1rem;
    }

    /* Upload Photo Group */
    .upload-photo-group {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
      margin-top: 1rem;
    }

    .file-input-hidden {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border-width: 0;
      opacity: 0;
      pointer-events: none;
    }

    .upload-photo-label {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.7rem 1.5rem;
      background: linear-gradient(135deg, #d4b978 0%, #c9a962 100%);
      color: #0d0d0d;
      border: none;
      border-radius: 12px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      text-transform: uppercase;
      letter-spacing: 0.05em;
      box-shadow: 0 4px 12px rgba(201, 169, 98, 0.3);
    }

    .upload-photo-label:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(201, 169, 98, 0.4);
    }

    .upload-photo-label:active {
      transform: translateY(0);
    }

    .upload-photo-help {
      font-size: 0.8rem;
      color: var(--text-gray);
      font-style: italic;
    }

    /* Form Card */
    .form-card {
      background: linear-gradient(135deg, rgba(26, 26, 26, 0.8) 0%, rgba(26, 26, 26, 0.5) 100%);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 2rem;
      box-shadow: var(--shadow-md);
    }

    /* Section Headers */
    .section-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin: 0 0 1.5rem 0;
      padding-bottom: 0.8rem;
      border-bottom: 2px solid var(--border-color);
    }

    .section-header:not(:first-of-type) {
      margin-top: 2rem;
    }

    .section-header svg {
      width: 28px;
      height: 28px;
      color: var(--gold);
      flex-shrink: 0;
      stroke: currentColor;
      stroke-width: 2;
      fill: none;
    }

    .section-header h2 {
      font-size: 1.15rem;
      font-weight: 600;
      color: var(--text-white);
      margin: 0;
    }

    /* Form Sections */
    .form-section {
      margin-bottom: 2rem;
    }

    /* Form Groups */
    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text-white);
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .form-group label .required {
      color: var(--error-color);
      margin-left: 0.3rem;
    }

    /* Input Fields */
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group select {
      background: rgba(255, 255, 255, 0.05);
      border: 1.5px solid var(--border-color);
      border-radius: 12px;
      padding: 0.8rem 1rem;
      font-size: 0.95rem;
      color: var(--text-white);
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="email"]:focus,
    .form-group input[type="tel"]:focus,
    .form-group select:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.08);
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.1);
    }

    .form-group select {
      text-transform: uppercase;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: linear-gradient(45deg, transparent 50%, var(--gold) 50%), linear-gradient(135deg, var(--gold) 50%, transparent 50%);
      background-position: calc(100% - 18px) calc(50% - 3px), calc(100% - 12px) calc(50% - 3px);
      background-size: 6px 6px, 6px 6px;
      background-repeat: no-repeat;
      padding-right: 2.5rem;
      cursor: pointer;
    }

    .form-group select option {
      text-transform: uppercase;
      background: var(--dark-card);
      color: var(--text-white);
    }

    .form-group input::placeholder {
      color: rgba(160, 160, 160, 0.5);
    }

    /* Form Row (2 columns) */
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .form-row .form-group {
      margin-bottom: 0;
    }

    @media (max-width: 768px) {
      .form-row {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
    }

    /* Help Text */
    .form-help {
      font-size: 0.85rem;
      color: var(--text-light-gray);
      margin-top: 0.4rem;
    }

    /* Error Messages */
    .form-error {
      color: var(--error-color);
      font-size: 0.85rem;
      margin-top: 0.4rem;
    }

    /* Button Group */
    .form-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
      padding-top: 1.5rem;
      border-top: 1px solid var(--border-color);
      margin-top: 2rem;
    }

    /* Buttons */
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      padding: 0.8rem 2rem;
      border: none;
      border-radius: 12px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
      white-space: nowrap;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      min-width: 140px;
    }

    .btn svg {
      width: 20px;
      height: 20px;
      stroke-width: 2;
    }

    .btn-primary {
      background: linear-gradient(135deg, #d4b978 0%, #c9a962 100%);
      color: #0d0d0d;
      box-shadow: 0 8px 24px rgba(201, 169, 98, 0.3);
      border: 2px solid #c9a962;
    }

    .btn-primary:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 36px rgba(201, 169, 98, 0.4);
    }

    .btn-primary:active {
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: transparent;
      color: var(--gold);
      border: 2px solid var(--gold);
    }

    .btn-secondary:hover {
      background: rgba(201, 169, 98, 0.1);
      box-shadow: 0 8px 24px rgba(201, 169, 98, 0.2);
      transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .edit-container {
        padding: 1.5rem 1rem 2rem;
        padding-top: 6rem;
      }

      .edit-header {
        padding: 1.5rem 1.2rem;
        margin-bottom: 1.5rem;
      }

      .edit-header h1 {
        font-size: 1.6rem;
      }

      .form-card {
        padding: 1.5rem;
      }

      .form-group {
        margin-bottom: 1.5rem;
      }

      .form-actions {
        flex-direction: column;
        gap: 1rem;
      }

      .btn {
        width: 100%;
        min-width: unset;
      }

      .section-header h2 {
        font-size: 1.2rem;
      }
    }

    @media (max-width: 480px) {
      .edit-container {
        padding: 1rem 0.8rem 1.5rem;
        padding-top: 6rem;
      }

      .edit-header {
        padding: 1.2rem 0.8rem;
      }

      .edit-header h1 {
        font-size: 1.3rem;
      }

      .form-card {
        padding: 1.2rem;
      }

      .form-group label {
        font-size: 0.85rem;
      }

      .form-group input {
        padding: 0.7rem 0.9rem;
        font-size: 16px;
      }

      .btn {
        padding: 0.7rem 1.2rem;
        font-size: 0.85rem;
      }

      .profile-avatar {
        font-size: 1.8rem;
        width: 90px;
        height: 90px;
      }

      .section-header h2 {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

<div class="edit-container">
    <!-- Header -->
    <div class="edit-header">
        <h1 data-i18n="profile.edit.title">Editar Mi Perfil</h1>
        <p data-i18n="profile.edit.subtitle">Gestiona tu información personal y de contacto</p>
    </div>

    <!-- Form -->
    <?= $this->Form->create($usuario, ['method' => 'post', 'enctype' => 'multipart/form-data']) ?>

    <!-- Profile Avatar -->
    <div class="profile-avatar-section">
        <?php if ($usuario->rol === 'chofer' && $chofer && !empty($chofer->foto_url)): ?>
            <img src="<?= h($chofer->foto_url) ?>" alt="<?= h($usuario->nombre) ?>" class="profile-avatar" id="profileAvatar" style="object-fit: cover;">
        <?php else: ?>
            <div class="profile-avatar" id="profileAvatar">
                <?= strtoupper(substr($usuario->nombre ?? 'U', 0, 1)) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($usuario->rol === 'chofer' && $chofer): ?>
        <div class="upload-photo-group">
            <label for="foto-input" class="upload-photo-label" data-i18n="profile.edit.uploadPhoto">
                <svg fill="none" viewBox="0 0 24 24" style="width: 20px; height: 20px; stroke: currentColor; stroke-width: 2; margin-right: 0.5rem;">
                    <path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Cambiar Foto
            </label>
            <!-- Input HTML directo con name="foto" como en admin -->
            <input type="file" id="foto-input" name="foto" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="file-input-hidden" />
            <span class="upload-photo-help" data-i18n="profile.edit.photoHelp">JPG, PNG, GIF, WEBP (máx. 5MB)</span>
        </div>
        <?php else: ?>
            <?php if ($usuario->rol === 'chofer'): ?>
            <div class="upload-photo-group">
                <p style="color: #ef4444; font-size: 0.9rem;">No se encontró perfil de chofer. Contacta al administrador.</p>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="form-card">

        <!-- Personal Information Section -->
        <div class="form-section">
            <div class="section-header">
                <svg fill="none" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <h2 data-i18n="profile.edit.personalInfo">Información Personal</h2>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre" data-i18n="profile.edit.fullName">
                        Nombre Completo
                        <span class="required" data-i18n="profile.edit.required">*</span>
                    </label>
                    <?= $this->Form->text('nombre', [
                        'id' => 'nombre',
                        'placeholder' => 'Ej: Juan Carlos Pérez',
                        'data-i18n-placeholder' => 'profile.edit.fullNamePlaceholder',
                        'required' => true,
                        'value' => $usuario->nombre ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('nombre')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('nombre')) ?></div>
                    <?php endif; ?>
                    <span class="form-help" data-i18n="profile.edit.fullNameHelp">Tu nombre completo</span>
                </div>

                <div class="form-group">
                    <label for="username" data-i18n="profile.edit.username">
                        Usuario
                        <span class="required" data-i18n="profile.edit.required">*</span>
                    </label>
                    <?= $this->Form->text('username', [
                        'id' => 'username',
                        'placeholder' => 'Ej: juancperez',
                        'data-i18n-placeholder' => 'profile.edit.usernamePlaceholder',
                        'required' => true,
                        'value' => $usuario->username ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('username')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('username')) ?></div>
                    <?php endif; ?>
                    <span class="form-help" data-i18n="profile.edit.usernameHelp">Tu nombre de usuario único</span>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="form-section">
            <div class="section-header">
                <svg fill="none" viewBox="0 0 24 24">
                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h2 data-i18n="profile.edit.contactInfo">Información de Contacto</h2>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="correo" data-i18n="profile.edit.email">
                        Correo Electrónico
                        <span class="required" data-i18n="profile.edit.required">*</span>
                    </label>
                    <?= $this->Form->email('correo', [
                        'id' => 'correo',
                        'placeholder' => 'Ej: juan@ejemplo.com',
                        'data-i18n-placeholder' => 'profile.edit.emailPlaceholder',
                        'required' => true,
                        'value' => $usuario->correo ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('correo')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('correo')) ?></div>
                    <?php endif; ?>
                    <span class="form-help" data-i18n="profile.edit.emailHelp">Tu correo electrónico de contacto</span>
                </div>

                <div class="form-group">
                    <label for="telefono" data-i18n="profile.edit.phone">
                        Teléfono
                        <span class="required" data-i18n="profile.edit.required">*</span>
                    </label>
                    <?= $this->Form->text('telefono', [
                        'id' => 'telefono',
                        'placeholder' => 'Ej: +507 6000 0000',
                        'data-i18n-placeholder' => 'profile.edit.phonePlaceholder',
                        'type' => 'tel',
                        'value' => $usuario->telefono ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('telefono')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('telefono')) ?></div>
                    <?php endif; ?>
                    <span class="form-help" data-i18n="profile.edit.phoneHelp">Tu número para contacto directo</span>
                </div>
            </div>
        </div>

        <!-- Address Section -->
        <div class="form-section">
            <div class="section-header">
                <svg fill="none" viewBox="0 0 24 24">
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h2 data-i18n="profile.edit.address">Dirección</h2>
            </div>

            <div class="form-group">
                <label for="direccion" data-i18n="profile.edit.address">Dirección</label>
                <?= $this->Form->text('direccion', [
                    'id' => 'direccion',
                    'placeholder' => 'Ej: Calle Principal 123',
                    'data-i18n-placeholder' => 'profile.edit.addressPlaceholder',
                    'value' => $usuario->direccion ?? ''
                ]) ?>
                <?php if ($this->Form->isFieldError('direccion')): ?>
                    <div class="form-error"><?= implode(', ', $this->Form->getFieldError('direccion')) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="ciudad" data-i18n="profile.edit.city">Ciudad</label>
                    <?= $this->Form->text('ciudad', [
                        'id' => 'ciudad',
                        'placeholder' => 'Ej: Panamá',
                        'data-i18n-placeholder' => 'profile.edit.cityPlaceholder',
                        'value' => $usuario->ciudad ?? ''
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="provincia" data-i18n="profile.edit.state">Provincia</label>
                    <?= $this->Form->text('provincia', [
                        'id' => 'provincia',
                        'placeholder' => 'Ej: Panamá Oeste',
                        'data-i18n-placeholder' => 'profile.edit.statePlaceholder',
                        'value' => $usuario->provincia ?? ''
                    ]) ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="codigopostal" data-i18n="profile.edit.zipCode">Código Postal</label>
                    <?= $this->Form->text('codigopostal', [
                        'id' => 'codigopostal',
                        'placeholder' => 'Ej: 00000',
                        'data-i18n-placeholder' => 'profile.edit.zipCodePlaceholder',
                        'value' => $usuario->codigopostal ?? ''
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="pais" data-i18n="profile.edit.country">País</label>
                    <?= $this->Form->select('pais', $countryOptions, [
                        'id' => 'pais',
                        'value' => $selectedCountry,
                        'empty' => false
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <?= $this->Form->button(
                'Guardar Cambios',
                [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'data-i18n' => 'profile.edit.save',
                    'escape' => false
                ]
            ) ?>
            <?= $this->Html->link(
                'Cancelar',
                ['action' => 'index'],
                [
                    'class' => 'btn btn-secondary',
                    'data-i18n' => 'profile.edit.cancel',
                    'escape' => false
                ]
            ) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>

<script>
  window.xservHeaderConfig = {
    variant: '<?= ($usuario && $usuario->rol === 'chofer') ? 'driver' : 'user' ?>',
    activePage: 'profile'
  };

  // Preview image when selected and ensure label works
  document.addEventListener('DOMContentLoaded', function() {
    // Buscar el input de foto (puede tener ID diferente por CakePHP)
    let fotoInput = document.getElementById('foto_chofer') || document.getElementById('foto-chofer') || document.querySelector('input[name="foto_chofer"]');
    const fotoLabel = document.querySelector('.upload-photo-label');
    
    console.log('Input de foto encontrado:', fotoInput ? 'Sí' : 'No');
    
    // Asegurar que el label active el input
    if (fotoLabel && fotoInput) {
      fotoLabel.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Label clicked, abriendo selector de archivos');
        fotoInput.click();
      });
    }
    
    if (fotoInput) {
      fotoInput.addEventListener('change', function(e) {
        console.log('Archivo seleccionado:', e.target.files[0]);
        const file = e.target.files[0];
        if (file) {
          console.log('Tipo de archivo:', file.type, 'Tamaño:', file.size);
          const reader = new FileReader();
          reader.onload = function(event) {
            const avatar = document.getElementById('profileAvatar');
            if (avatar) {
              // Si es una imagen, mostrar preview
              if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.alt = 'Vista previa';
                img.style.cssText = 'width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #c9a962; box-shadow: 0 8px 24px rgba(201, 169, 98, 0.3);';
                
                // Reemplazar el avatar con la imagen
                if (avatar.tagName === 'IMG') {
                  avatar.src = event.target.result;
                } else {
                  avatar.parentNode.replaceChild(img, avatar);
                  img.id = 'profileAvatar';
                }
                console.log('Preview actualizado');
              }
            }
          };
          reader.readAsDataURL(file);
        }
      });
    } else {
      console.error('No se encontró el input de foto');
    }
  });
</script>
<script src="/js/i18n.js"></script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>

</body>
</html>
