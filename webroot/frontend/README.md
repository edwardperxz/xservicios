# Frontend HTML Files - Xservicios

## 📁 Estructura de Directorios (v2.0)

La carpeta frontend ahora está organizada por roles de usuario para mejor mantenibilidad y escalabilidad.

```
frontend/
├── shared/                      # 🔓 Acceso público (sin autenticación)
│   ├── about.php               # Información de la empresa
│   ├── home-templates-public.php # Landing page pública
│   ├── login.php               # Formulario de inicio de sesión
│   ├── services.php            # Catálogo de servicios
│   └── signup.php              # Registro de usuarios
│
├── user/                        # 👥 Acceso de usuario autenticado
│   ├── bus-details.php         # Ficha técnica del vehículo
│   ├── dashboard.php           # Panel de control del usuario
│   ├── driver-details.php      # Perfil del chofer
│   ├── fleet.php               # Galería de flota
│   ├── home-templates-login.php # Home autenticado
│   ├── home-templates-pages.php # Home alternativo (CakePHP)
│   ├── home-webroot.php        # Home con i18n
│   ├── my-reservations.php     # Mis reservas
│   ├── new-reservation.php     # Nueva reserva
│   └── rate-service.php        # Valorar servicios
│
├── driver/                      # 🚗 Acceso de chofer (próximamente)
│   └── (vacío - en desarrollo)
│
├── admin/                       # ⚙️ Acceso de administrador (próximamente)
│   └── (vacío - en desarrollo)
│
└── README.md                    # Este archivo
```

---

## 📄 Archivo Index por Carpeta

### 🔓 **SHARED** - Páginas Públicas (Sin Autenticación Required)

| Archivo | Descripción | Ruta |
|---------|-------------|------|
| `login.php` | Formulario de inicio de sesión | `/frontend/login` |
| `signup.php` | Página de registro | `/frontend/signup` |
| `about.php` | Información sobre la empresa | `/frontend/about` |
| `services.php` | Catálogo de servicios disponibles | `/frontend/services` |
| `home-templates-public.php` | Landing page para usuarios no autenticados | `/` (alternativa) |

### 👥 **USER** - Páginas Autenticadas (Requiere Login)

| Archivo | Descripción | Ruta |
|---------|-------------|------|
| `dashboard.php` | Panel principal del usuario | `/frontend/dashboard` |
| `home-templates-login.php` | Home para usuarios autenticados | `/home` (primaria) |
| `home-templates-pages.php` | Home CakePHP (componente) | `/home` (alternativa) |
| `home-webroot.php` | Home con sistema i18n completo | `/frontend/home` |
| `fleet.php` | Galería completa de vehículos | `/frontend/fleet` |
| `new-reservation.php` | Formulario para crear reserva | `/frontend/newreservation` |
| `my-reservations.php` | Lista de reservas del usuario | `/frontend/myreservations` |
| `rate-service.php` | Panel de valoraciones | `/frontend/rateservice` |
| `bus-details.php` | Ficha técnica del vehículo | Acceso directo |
| `driver-details.php` | Perfiles de choferes | Acceso directo |

### 🚗 **DRIVER** - Páginas de Chofer (Por Crear)

Pendiente de desarrollo. Incluirá:
- Dashboard de viajes asignados
- Aceptar/Rechazar viajes
- Historial de viajes
- Perfil y calificaciones
- Disponibilidad/Estado

### ⚙️ **ADMIN** - Páginas de Administrador (Por Crear)

Pendiente de desarrollo. Incluirá:
- Gestión de vehículos
- Gestión de choferes
- Gestión de reservas
- Reportes y analíticos
- Configuraciones del sistema

---

## 🎨 Características Técnicas

Todas las páginas incluyen:
- ✅ **Header Dinámico**: Se carga automáticamente según estado de autenticación
- ✅ **Soporte i18n**: Selector de idioma ES/EN con localStorage
- ✅ **Diseño Responsivo**: Mobile-first, funciona en todos los dispositivos
- ✅ **Protección CSRF**: Inyección de tokens via FrontendController
- ✅ **Estilo Unificado**: Sistema de diseño coherente (gold, dark theme)
- ✅ **Animaciones Suaves**: Transiciones y efectos consistentes

### Scripts Requeridos (Orden Importante!)

TODOS los archivos .php deben incluir al final de `<body>`:

```html
<!-- Header será cargado dinámicamente por header-loader.js -->
<script src="/js/header-loader.js"></script>      <!-- 1. Inyecta header HTML -->
<script src="/js/header-dynamic.js"></script>     <!-- 2. Maneja autenticación -->
<script src="/js/i18n.js"></script>               <!-- 3. Gestiona traducciones -->
</body>
```

---

## 🛠️ Integración con FrontendController

El archivo `FrontendController.php` se encarga de:

1. **Leer archivos .php** de las subcarpetas
2. **Inyectar token CSRF** en formularios
3. **Servir contenido** con headers HTML correctos
4. **Manejar autenticación** mediante configuración en `beforeFilter()`

### Rutas Automáticas (No requieren acción manual)

Cuando agregas un archivo a `shared/` o `user/`, la ruta se genera automáticamente:

| Ubicación Archivo | Ruta de Acceso |
|-------------------|----------------|
| `shared/login.php` | `/frontend/login` |
| `shared/about.php` | `/frontend/about` |
| `user/fleet.php` | `/frontend/fleet` |
| `user/new-reservation.php` | `/frontend/newreservation` |

---

## 📝 Convenciones de Nombres

Todos los archivos siguen estándares internacionales:
- **Idioma**: Inglés ✅
- **Capitalización**: kebab-case (palabras-separadas-por-guiones)
- **Mayúsculas**: minúsculas únicamente
- **Extensión**: `.php` (no .html)

### Ejemplos
- ✅ `my-reservations.php` 
- ✅ `rate-service.php`
- ✅ `new-reservation.php`
- ❌ `MisReservas.php` (Spanish + CamelCase)
- ❌ `valorar_servicios.html` (Spanish + snake_case)

---

## 🆕 Agregar Nuevas Páginas

### Para Usuario (Requiere Autenticación)

1. **Crear archivo en `user/`**:
   ```bash
   touch webroot/frontend/user/my-feature.php
   ```

2. **Incluir scripts requeridos** al final de `<body>`:
   ```html
   <!-- Header será cargado dinámicamente por header-loader.js -->
   <script src="/js/header-loader.js"></script>
   <script src="/js/header-dynamic.js"></script>
   <script src="/js/i18n.js"></script>
   </body>
   ```

3. **Añadir método en FrontendController.php**:
   ```php
   /**
    * My Feature page (my-feature.php)
    */
   public function myfeature()
   {
       $this->response = $this->response->withType('text/html');
       $content = file_get_contents(ROOT . '/webroot/frontend/user/my-feature.php');
       $content = $this->injectCsrfToken($content);
       return $this->response->withStringBody($content);
   }
   ```

4. **Añadir ruta en `beforeFilter()`** si necesita lógica especial:
   ```php
   $this->Authentication->addUnauthenticatedActions(['myfeature']);
   ```

### Para Público (Sin Autenticación)

Sigue los mismos pasos pero guarda el archivo en `shared/` en lugar de `user/`.

---

## 🌐 Sistema de Traducciones (i18n)

Las traducciones se gestionan en `/js/i18n.js`:
- **Idioma por defecto**: Español (ES)
- **Idioma alternativo**: Inglés (EN)
- **Almacenamiento**: localStorage (persiste entre sesiones)

### Cómo Usar Traducciones

**En HTML:**
```html
<h1 data-i18n="page.title">Mis Reservas</h1>
<input type="text" data-i18n-placeholder="form.name" placeholder="Nombre">
```

**En JavaScript:**
```javascript
const label = translations[currentLanguage]['page.title'];
```

### Agregar Nuevas Traducciones

Edita `/js/i18n.js`:
```javascript
const translations = {
  es: {
    'myfeature.title': 'Mi Característica Especial',
    'myfeature.description': 'Descripción aquí...'
  },
  en: {
    'myfeature.title': 'My Special Feature',
    'myfeature.description': 'Description here...'
  }
};
```

---

## 🔐 Flujo de Autenticación

El sistema automático maneja:

1. **No Autenticado**: Muestra botón "Login" en header
2. **Autenticado**: Muestra perfil de usuario con menú dropdown:
   - Mi Perfil
   - Mis Reservas
   - Valoraciones
   - Cerrar Sesión

El header dinámico verifica estado mediante:
- **API**: `GET /xserv-usuarios/me` (obtiene usuario actual)
- **Logout**: `POST /xserv-usuarios/logout` (cierra sesión)

---

## 📦 Dependencias

### Externas
- Google Fonts (Playfair Display, Inter)
- Unsplash Images (para demostraciones)

### Internas
- `/js/header-loader.js` - Inyector de header
- `/js/header-dynamic.js` - Lógica de autenticación
- `/js/i18n.js` - Sistema de traducciones
- `/css/` - Estilos globales

---

## 🚀 Próximos Pasos

1. **Desarrollar sección DRIVER**:
   - Dashboard de viajes
   - Gestión de disponibilidad
   - Calificaciones y reviews

2. **Desarrollar sección ADMIN**:
   - Panel de control
   - Gestión de vehículos
   - Reportes y analíticos

3. **Optimizaciones**:
   - Separar CSS por página
   - Minificación de JS
   - Caché de assets

---

## 📞 Soporte

Para preguntas sobre estructura o integración, revisa:
- `src/Controller/FrontendController.php` - Rutas y lógica
- `/js/i18n.js` - Sistema de traducciones
- `/js/header-loader.js` - Carga de header
- Google Fonts: Playfair Display, Inter
- No external CSS frameworks (custom design)

### Internal
- CakePHP 5.x (backend)
- Custom JavaScript (ES6+)
- LocalStorage API (language preference, user cache)

---

## 🐛 Troubleshooting

### Header not loading?
1. Check console for JavaScript errors
2. Verify script load order (header-loader → header-dynamic → i18n)
3. Ensure files are in `/js/` directory

### Translations not working?
1. Check `data-i18n` attribute syntax
2. Verify key exists in `i18n.js`
3. Clear localStorage: `localStorage.clear()`

### Authentication not showing?
1. Check `/xserv-usuarios/me` endpoint response
2. Verify CSRF token in cookies
3. Check browser console for API errors

---

## 📚 Documentation

- [Header Component Guide](../../docs/HEADER_COMPONENT.md)
- [Migration Guide](../../docs/FILE_NAMING_MIGRATION.md)
- [API Documentation](../../docs/API.md) _(if available)_

---

## 👥 Maintenance

**Last Updated**: February 22, 2026  
**File Count**: 12 HTML files  
**Status**: ✅ All files using standardized naming

---

## 📄 License

Part of Xservicios proprietary application.  
© 2026 Xservicios - All rights reserved.
