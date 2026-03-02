# Dynamic Header System

## Sistema de Header Dinámico y Reutilizable

Header modular que se adapta automáticamente según autenticación e idioma del usuario.

### Características

- ✅ Autenticación dinámica (muestra login o perfil de usuario)
- ✅ Selector de idioma ES/EN funcional
- ✅ Menú desplegable para usuario autenticado
- ✅ Diseño completamente responsive
- ✅ Persistencia de preferencias en localStorage
- ✅ Zero-configuration (funciona automáticamente)

---

## Archivos del Sistema

```
webroot/
├── js/
│   ├── header-loader.js       # Inyecta HTML del header
│   ├── header-dynamic.js      # Autenticación y dropdown
│   └── i18n.js                # Sistema multilingüe
└── frontend/                  # Todos los .php lo incluyen

templates/
└── element/
    └── header.php             # Componente para CakePHP
```

---

## Implementación Rápida

### Para Archivos PHP Estáticos

Incluye al final antes de `</body>`:

```html
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>
<script src="/js/i18n.js"></script>
</body>
```

### Para CakePHP (Templates)

```php
<?= $this->element('header', ['page' => 'home']) ?>

<!-- Al final del body -->
<script src="/js/header-dynamic.js"></script>
<script src="/js/i18n.js"></script>
```

---

## Componentes

### 1. Autenticación

**Sin usuario logueado:**
- Botón "Iniciar sesión" (+login)
- Botón "Crear cuenta"

**Con usuario logueado:**
- Avatar con iniciales
- Nombre del usuario
- Menú desplegable:
  - Mi Perfil
  - Mis Reservas
  - Configuración
  - Cerrar Sesión

### 2. Selector de Idioma

- Botones ES/EN interactivos
- Traduce página instantáneamente
- Persiste en localStorage (30 días)
- Indica idioma activo con color dorado

### 3. Navegación

- Menú principal con enlaces:
  - Inicio / Home
  - Servicios
  - Flota
  - Acerca de
- Se resalta automáticamente la página actual

---

## Configuración Avanzada

### Cambiar Endpoint de Autenticación

En `webroot/js/header-dynamic.js`:

```javascript
this.API_ME = '/mi-api/usuario';     // Tu endpoint
this.API_LOGOUT = '/mi-api/logout';   // Tu endpoint
```

### Respuesta Esperada del API

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

### Personalizar Colores

En `header-loader.js` o `header.php`, edita:

```css
:root {
  --gold: #c9a962;        /* Color primario */
  --dark-bg: #0a0a0a;     /* Fondo principal */
  --light-bg: #1a1a1a;    /* Fondo secundario */
  --text: #ffffff;        /* Texto */
}
```

---

## Troubleshooting

| Problema | Solución |
|----------|----------|
| Header no aparece | Verifica orden de scripts, revisa consola |
| Idioma no cambia | Limpia localStorage: `localStorage.clear()` |
| No detecta usuario | Verifica que `/xserv-usuarios/me` exista |
| Dropdown cierra rápido | Recarga la página, verifica header-dynamic.js |

---

## Responsivo

| Dispositivo | Comportamiento |
|---|---|
| Desktop | Menú completo con texto + avatar + idioma |
| Tablet | Espaciado reducido, menú comprimido |
| Mobile | Solo iconos, nombre oculto, funcionalidad total |

---

## Browser Support

- Chrome/Edge: ✅ Full
- Firefox: ✅ Full
- Safari: ✅ Full
- IE11: ❌ No soportado

---

**Última actualización**: Marzo 2, 2026
