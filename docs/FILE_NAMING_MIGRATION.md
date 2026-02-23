# Migración de Nombres de Archivos - Frontend

## 📌 Resumen
Todos los archivos HTML del frontend han sido renombrados siguiendo convenciones internacionales:
- ✅ Nombres en inglés
- ✅ kebab-case (palabras-separadas-por-guiones)
- ✅ Minúsculas
- ✅ Descriptivos y claros

---

## 📝 Mapeo de Archivos

### Archivos Renombrados

| Nombre Anterior (Español) | Nombre Nuevo (Inglés) | Descripción |
|---------------------------|----------------------|-------------|
| `crear-cuenta.html` | `signup.php` | Página de registro/crear cuenta |
| `inicio-sesion.html` | `login.php` | Página de inicio de sesión |
| `Nosotros.html` | `about.php` | Página sobre nosotros/empresa |
| `servicios.html` | `services.php` | Lista de servicios disponibles |
| `ver-flota.html` | `fleet.php` | Galería de vehículos |
| `mis-reservas.html` | `my-reservations.php` | Lista de reservas del usuario |
| `nueva-reserva.html` | `new-reservation.php` | Formulario nueva reserva |
| `valorar-servicios.html` | `rate-service.php` | Valoración de servicios |
| `ficha-bus.html` | `bus-details.php` | Fichas técnicas de buses |
| `ficha-chofer.html` | `driver-details.php` | Perfiles de choferes |
| `home-login.html` | `dashboard.php` | Dashboard usuarios autenticados |
| `home-public.html` | `home.php` | Página principal pública |

> **Nota**: Todos los archivos del frontend fueron convertidos de HTML a PHP para uniformidad y flexibilidad futura. El contenido y estructura se mantienen idénticos.

---

## 🔧 Archivos Actualizados

Los siguientes archivos se actualizaron automáticamente para reflejar los nuevos nombres:

### Controllers PHP
- ✅ `src/Controller/FrontendController.php` - Todas las rutas actualizadas

### Archivos HTML
- ✅ `rate-service.html` - Enlaces de navegación
- ✅ `dashboard.html` - Referencias internas

### Documentación
- ✅ `docs/HEADER_COMPONENT.md` - Ejemplos y estructura de archivos
- ✅ `docs/FILE_NAMING_MIGRATION.md` - Este documento

---

## 🌐 Rutas de la Aplicación

Las rutas de CakePHP se mantienen igual (no cambiaron):

| Ruta | Archivo Servido |
|------|----------------|
| `/frontend/fleet` | `fleet.php` |
| `/frontend/services` | `services.php` |
| `/frontend/about` | `about.php` |
| `/frontend/newreservation` | `new-reservation.php` |
| `/frontend/myreservations` | `my-reservations.php` |
| `/frontend/rateservice` | `rate-service.php` |
| `/frontend/signup` | `signup.php` |
| `/frontend/login` | `login.php` |

---

## ✅ Beneficios

1. **Mejor SEO**: Nombres en inglés son más amigables para buscadores internacionales
2. **Consistencia**: Todos los archivos siguen la misma convención
3. **Mantenibilidad**: Más fácil para desarrolladores internacionales
4. **Profesionalismo**: Estándar de la industria
5. **Sin caracteres especiales**: No hay mayúsculas ni acentos que puedan causar problemas

---

## 🔄 Compatibilidad

- ✅ Todo el sistema i18n funciona correctamente
- ✅ Header dinámico carga sin problemas
- ✅ Autenticación funcional en todos los archivos
- ✅ Traducciones ES/EN operativas
- ✅ Sin errores de compilación

---

## 📅 Fecha de Migración
**22 de febrero de 2026**

---

## 👥 Próximos Pasos

Si necesitas agregar nuevos archivos al frontend:

1. **Nómbralos en inglés**: `my-new-page.php`
2. **Usa kebab-case**: palabras separadas por guiones
3. **Extensión PHP**: todos los archivos frontend usan `.php`
4. **Mantenlo descriptivo**: el nombre debe indicar qué hace
4. **Todo en minúsculas**: nunca uses mayúsculas
5. **Agrega al FrontendController**: si necesita una ruta CakePHP

**Ejemplo**:
```php
// En FrontendController.php
public function myNewPage()
{
    $this->response = $this->response->withType('text/html');
    $content = file_get_contents(ROOT . '/webroot/frontend/my-new-page.html');
    $content = $this->injectCsrfToken($content);
    return $this->response->withStringBody($content);
}
```

---

## 🆘 Soporte

Si encuentras alguna referencia antigua que no se haya actualizado:
1. Busca el archivo: `grep -r "nombre-antiguo" .`
2. Actualiza la referencia al nuevo nombre
3. Documenta el cambio

---

**Nota**: Esta migración no afecta a los templates PHP de CakePHP (archivos en `templates/`), solo a los archivos HTML estáticos del frontend.
