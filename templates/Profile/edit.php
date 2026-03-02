<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $usuario
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
  <title>Editar Perfil - Xservicios</title>
  
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
    .form-group input[type="tel"] {
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
    .form-group input[type="tel"]:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.08);
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(201, 169, 98, 0.1);
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
        <h1>Editar Mi Perfil</h1>
        <p>Gestiona tu información personal y de contacto</p>
    </div>

    <!-- Profile Avatar -->
    <div class="profile-avatar-section">
        <div class="profile-avatar" id="profileAvatar">
            <?= strtoupper(substr($usuario->nombre ?? 'U', 0, 1)) ?>
        </div>
    </div>

    <!-- Form -->
    <div class="form-card">
        <?= $this->Form->create($usuario, ['method' => 'post']) ?>

        <!-- Personal Information Section -->
        <div class="form-section">
            <div class="section-header">
                <svg fill="none" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <h2>Información Personal</h2>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">
                        Nombre Completo
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->text('nombre', [
                        'id' => 'nombre',
                        'placeholder' => 'Ej: Juan Carlos Pérez',
                        'required' => true,
                        'value' => $usuario->nombre ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('nombre')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('nombre')) ?></div>
                    <?php endif; ?>
                    <span class="form-help">Tu nombre completo</span>
                </div>

                <div class="form-group">
                    <label for="username">
                        Usuario
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->text('username', [
                        'id' => 'username',
                        'placeholder' => 'Ej: juancperez',
                        'required' => true,
                        'value' => $usuario->username ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('username')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('username')) ?></div>
                    <?php endif; ?>
                    <span class="form-help">Tu nombre de usuario único</span>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="form-section">
            <div class="section-header">
                <svg fill="none" viewBox="0 0 24 24">
                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h2>Información de Contacto</h2>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="correo">
                        Correo Electrónico
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->email('correo', [
                        'id' => 'correo',
                        'placeholder' => 'Ej: juan@ejemplo.com',
                        'required' => true,
                        'value' => $usuario->correo ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('correo')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('correo')) ?></div>
                    <?php endif; ?>
                    <span class="form-help">Tu correo electrónico de contacto</span>
                </div>

                <div class="form-group">
                    <label for="telefono">
                        Teléfono
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->text('telefono', [
                        'id' => 'telefono',
                        'placeholder' => 'Ej: +507 6000 0000',
                        'type' => 'tel',
                        'value' => $usuario->telefono ?? ''
                    ]) ?>
                    <?php if ($this->Form->isFieldError('telefono')): ?>
                        <div class="form-error"><?= implode(', ', $this->Form->getFieldError('telefono')) ?></div>
                    <?php endif; ?>
                    <span class="form-help">Tu número para contacto directo</span>
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
                <h2>Dirección</h2>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <?= $this->Form->text('direccion', [
                    'id' => 'direccion',
                    'placeholder' => 'Ej: Calle Principal 123',
                    'value' => $usuario->direccion ?? ''
                ]) ?>
                <?php if ($this->Form->isFieldError('direccion')): ?>
                    <div class="form-error"><?= implode(', ', $this->Form->getFieldError('direccion')) ?></div>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <?= $this->Form->text('ciudad', [
                        'id' => 'ciudad',
                        'placeholder' => 'Ej: Panamá',
                        'value' => $usuario->ciudad ?? ''
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="provincia">Provincia</label>
                    <?= $this->Form->text('provincia', [
                        'id' => 'provincia',
                        'placeholder' => 'Ej: Panamá Oeste',
                        'value' => $usuario->provincia ?? ''
                    ]) ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="codigopostal">Código Postal</label>
                    <?= $this->Form->text('codigopostal', [
                        'id' => 'codigopostal',
                        'placeholder' => 'Ej: 00000',
                        'value' => $usuario->codigopostal ?? ''
                    ]) ?>
                </div>

                <div class="form-group">
                    <label for="pais">País</label>
                    <?= $this->Form->text('pais', [
                        'id' => 'pais',
                        'placeholder' => 'Ej: Panamá',
                        'value' => $usuario->pais ?? 'Panamá'
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
                    'escape' => false
                ]
            ) ?>
            <?= $this->Html->link(
                'Cancelar',
                ['action' => 'index'],
                [
                    'class' => 'btn btn-secondary',
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
</script>
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>

</body>
</html>
