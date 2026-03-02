# Frontend Pages Guide

## Guía de Páginas y su Organización

Todas las páginas del frontend están organizadas por nivel de acceso y rol de usuario.

---

## Estructura de Carpetas

```
webroot/frontend/
├── shared/                     # 🔓 Acceso público
│   ├── about.php              # Acerca de la empresa
│   ├── home-templates-public.php
│   ├── login.php              # Iniciar sesión
│   ├── services.php           # Catálogo de servicios
│   └── signup.php             # Registrarse
│
├── user/                       # 👥 Solo usuarios autenticados
│   ├── bus-details.php        # Fichas técnicas de buses
│   ├── dashboard.php          # Panel de control
│   ├── driver-details.php     # Perfiles de choferes
│   ├── fleet.php              # Galería de flota
│   ├── home-templates-login.php
│   ├── home-templates-pages.php
│   ├── home-webroot.php
│   ├── my-reservations.php    # Mis reservas
│   ├── new-reservation.php    # Nueva reserva
│   └── rate-service.php       # Valorar servicio
│
├── driver/                     # 🚗 Choferes (en desarrollo)
└── admin/                      # ⚙️ Administradores (en desarrollo)
```

---

## Páginas Públicas (`shared/`)

Acceso sin necesidad de login.

| Página | Archivo | Descripción |
|--------|---------|-------------|
| Inicio | `home-templates-public.php` | Landing page pública |
| Login | `login.php` | Formulario de autenticación |
| Registrarse | `signup.php` | Crear nueva cuenta |
| Servicios | `services.php` | Catálogo de servicios |
| Acerca de | `about.php` | Info de la empresa |

### Rutas CakePHP

```
/frontend/home        → home-templates-public.php
/frontend/login       → login.php
/frontend/signup      → signup.php
/frontend/services    → services.php
/frontend/about       → about.php
```

---

## Páginas de Usuario (`user/`)

Requieren autenticación. El sistema redirige si no estás logueado.

| Página | Archivo | Descripción |
|--------|---------|-------------|
| Dashboard | `dashboard.php` | Panel principal de usuario |
| Mis Reservas | `my-reservations.php` | Historial y estado de reservas |
| Nueva Reserva | `new-reservation.php` | Crear reserva |
| Flota | `fleet.php` | Ver vehículos disponibles |
| Detalles Bus | `bus-details.php` | Fichas técnicas de buses |
| Detalles Chofer | `driver-details.php` | Perfiles de choferes |
| Valorar | `rate-service.php` | Calificar servicio recibido |

### Rutas CakePHP

```
/frontend/dashboard       → dashboard.php
/frontend/myreservations  → my-reservations.php
/frontend/newreservation  → new-reservation.php
/frontend/fleet           → fleet.php
```

---

## Secciones En Desarrollo

### Chofer (`driver/`)

Próximamente:
- Dashboard de viajes asignados
- Aceptar/rechazar viajes
- Disponibilidad y estado
- Historial de viajes
- Calificaciones

### Admin (`admin/`)

Próximamente:
- Gestión de vehículos
- Gestión de choferes
- Gestión de reservas
- Reportes y analíticos
- Configuraciones del sistema

---

## Componentes de Página

Todos los archivos `.php` incluyen:

```html
<!-- Header (se carga automáticamente) -->
<script src="/js/header-loader.js"></script>

<!-- Contenido específico de la página -->

<!-- Footer -->

<!-- Scripts obligatorios (al final) -->
<script src="/js/header-dynamic.js"></script>
<script src="/js/i18n.js"></script>
</body>
```

---

## Características Técnicas

Todas las páginas incluyen:

- ✅ Header dinámico según autenticación
- ✅ Selector de idioma ES/EN
- ✅ Protección CSRF (tokens inyectados)
- ✅ Diseño responsive
- ✅ Tema dark/gold coherente
- ✅ Animaciones suaves

---

## Agregar Nueva Página

### 1. Crear archivo

```bash
touch webroot/frontend/user/my-page.php
```

### 2. Incluir estructura base

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <!-- Header se carga aquí automáticamente -->
    
    <main>
        <!-- Tu contenido aquí -->
    </main>

    <!-- Scripts ordenados -->
    <script src="/js/header-loader.js"></script>
    <script src="/js/header-dynamic.js"></script>
    <script src="/js/i18n.js"></script>
</body>
</html>
```

### 3. Agregar ruta en FrontendController

```php
public function mypage()
{
    $this->response = $this->response->withType('text/html');
    $content = file_get_contents(ROOT . '/webroot/frontend/user/my-page.php');
    $content = $this->injectCsrfToken($content);
    return $this->response->withStringBody($content);
}
```

### 4. Si necesita estar pública (sin login)

```php
// En beforeFilter()
$this->Authentication->addUnauthenticatedActions(['mypage']);
```

---

## Convenciones

- **Nombres**: inglés, kebab-case, minúsculas
- **Extensión**: `.php`
- **Ubicación**: `shared/` o `user/` según acceso
- **Headers**: Siempre incluir los 3 scripts al final
- **Traducciones**: Usar `data-i18n` en elementos

---

**Última actualización**: Marzo 2, 2026
