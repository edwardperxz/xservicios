# Sistema de Header Reutilizable - Xservicios

## 📋 Descripción

Sistema de header modular y reutilizable con:
- ✅ Autenticación dinámica (login/perfil de usuario)
- ✅ Selector de idioma funcional (ES/EN)
- ✅ Menú desplegable de usuario
- ✅ Estilos incluidos
- ✅ Responsive design
- ✅ Persistencia de idioma en localStorage

---

## 📂 Estructura de Archivos (Actualizada)

```
webroot/
├── js/
│   ├── header-loader.js       # Inyecta el HTML del header
│   ├── header-dynamic.js      # Maneja autenticación y dropdown
│   └── i18n.js                # Sistema de traducción ES/EN
├── frontend/
│   ├── home.html              # Página principal pública
│   ├── dashboard.html         # Dashboard usuarios autenticados
│   ├── login.html             # Inicio de sesión
│   ├── signup.html            # Crear cuenta
│   ├── about.html             # Acerca de/Nosotros
│   ├── services.html          # Servicios disponibles
│   ├── fleet.html             # Ver flota de vehículos
│   ├── new-reservation.html   # Nueva reserva
│   ├── my-reservations.html   # Mis reservas
│   ├── rate-service.html      # Valorar servicio
│   ├── bus-details.html       # Fichas técnicas buses
│   └── driver-details.html    # Fichas de choferes
templates/
└── element/
    └── header.php             # Header component para CakePHP
```

**Nota**: Todos los archivos frontend ahora usan nombres en inglés con kebab-case siguiendo convenciones internacionales.

---

## 🚀 Uso Rápido

### Para Archivos HTML Estáticos

Incluye estos 3 scripts al final de tu archivo HTML (antes de `</body>`):

```html
<!-- Scripts: El orden es importante -->
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>
<script src="/js/i18n.js"></script>
</body>
```

**¡Eso es todo!** El header se carga automáticamente.

---

### Para Archivos PHP (CakePHP)

En tus templates PHP (`.php`), usa el elemento:

```php
<?= $this->element('header', ['page' => 'home']) ?>
```

Páginas válidas: `'home'`, `'fleet'`, `'services'`, `'about'`

Luego incluye los scripts:

```html
<script src="/js/header-dynamic.js"></script>
<script src="/js/i18n.js"></script>
```

---

## 📂 Archivos del Sistema

### Componentes
- **`templates/element/header.php`** - Componente reutilizable para CakePHP
- **`webroot/js/header-loader.js`** - Inyector de header para HTML estáticos
- **`webroot/js/header-dynamic.js`** - Manejo de autenticación dinámica
- **`webroot/js/i18n.js`** - Sistema de traducción multilingüe

---

## 🎯 Características

### 1. Autenticación Dinámica

El header detecta automáticamente si hay un usuario logueado:

- **Sin autenticación**: Muestra botón "Iniciar sesión"
- **Con autenticación**: Muestra perfil de usuario con:
  - Avatar con iniciales
  - Nombre del usuario
  - Menú desplegable:
    - Mi Perfil
    - Mis Reservas
    - Configuración
    - Cerrar Sesión

### 2. Selector de Idioma

Botones interactivos ES/EN que:
- Traducen toda la página instantáneamente
- Persisten la preferencia en localStorage
- Resaltan el idioma activo en dorado
- Funcionan sin recargar la página

### 3. Navegación Activa

El header detecta automáticamente la página actual y resalta el menú correspondiente.

---

## 🔧 Configuración Avanzada

### Agregar Nuevas Traducciones

Edita `webroot/js/i18n.js`:

```javascript
const translations = {
  es: {
    'nav.newPage': 'Nueva Página',
    // ...
  },
  en: {
    'nav.newPage': 'New Page',
    // ...
  }
};
```

Luego usa en HTML:

```html
<span data-i18n="nav.newPage">Nueva Página</span>
```

### Personalizar Endpoint de Autenticación

Edita `webroot/js/header-dynamic.js`:

```javascript
this.API_ME = '/api/usuario/actual';  // Tu endpoint
this.API_LOGOUT = '/api/logout';      // Tu endpoint de logout
```

### API de Usuario Esperada

El endpoint debe retornar JSON:

```json
{
  "usuario": {
    "id": 1,
    "nombre": "Juan",
    "apellido": "Pérez",
    "email": "juan@example.com"
  }
}
```

---

## 📱 Responsive

El header es totalmente responsive:

- **Desktop**: Menú completo con texto
- **Tablet**: Menú con espaciado reducido
- **Mobile**: 
  - Solo iconos de navegación
  - Nombre de usuario oculto
  - Funcionalidad completa mantenida

---

## 🎨 Personalización de Estilos

Los estilos están incluidos en los archivos. Para personalizarlos:

### En `header-loader.js` (HTML estáticos)

Edita la función `createHeaderStyles()`:

```javascript
:root {
  --gold: #c9a962;        // Tu color principal
  --dark-bg: #0a0a0a;     // Tu fondo
  // ...
}
```

### En `templates/element/header.php` (CakePHP)

Edita el tag `<style>` del elemento:

```css
:root {
  --gold: #c9a962;        // Tu color principal
  --dark-bg: #0a0a0a;     // Tu fondo
  // ...
}
```

---

## 🧪 Pruebas

### Probar Header Estático

1. Abre `webroot/frontend/Nosotros.html`
2. Verifica que el header se carga correctamente
3. Prueba cambio de idioma (ES/EN)
4. Verifica navegación responsive

### Probar Autenticación

1. Inicia sesión en el sistema
2. Refresca página
3. Debe mostrar perfil de usuario
4. Prueba menú desplegable
5. Prueba cerrar sesión

---

## 🐛 Troubleshooting

### El header no aparece

- Verifica que los scripts estén en el orden correcto
- Revisa la consola del navegador para errores
- Asegúrate de que las rutas de los scripts sean correctas

### El idioma no cambia

- Verifica que los elementos tengan atributo `data-i18n`
- Revisa que i18n.js se cargue después de header-loader.js
- Limpia localStorage: `localStorage.clear()`

### La autenticación no funciona

- Verifica que el endpoint `/xserv-usuarios/me` exista
- Revisa la consola para errores de API
- Asegúrate de que las cookies de sesión estén configuradas

### El dropdown no se cierra

- Verifica que header-dynamic.js esté cargado
- Revisa la consola para errores de JavaScript

---

## 📞 Soporte

Para más información, contacta al equipo de desarrollo de Xservicios.

**Proyecto**: Sistema Web de Transporte Turístico de Lujo  
**Universidad**: Universidad en Chiriquí, Panamá  
**Período**: Práctica Profesional - Verano 2026
