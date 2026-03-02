# Frontend Naming Standards

## Estándares de Nombres para Archivos Frontend

Todos los archivos HTML/PHP del frontend siguen convenciones internacionales consistentes.

### Reglas de Convención

| Aspecto | Estándar | Ejemplo |
|---------|----------|---------|
| Idioma | Inglés únicamente | ✅ `login.php` ❌ `inicio-sesion.php` |
| Formato | kebab-case | ✅ `new-reservation.php` ❌ `NewReservation.php` |
| Mayúsculas | Solo minúsculas | ✅ `about.php` ❌ `About.php` |
| Descriptividad | Claro y breve | ✅ `bus-details.php` ❌ `b.php` |
| Extensión | `.php` (no `.html`) | ✅ `fleet.php` ❌ `fleet.html` |

---

## Mapeo de Migraciones (Feb 2026)

| Anterior (Español) | Actual (Inglés) | Ubicación |
|---|---|---|
| `crear-cuenta.html` | `signup.php` | `frontend/shared/` |
| `inicio-sesion.html` | `login.php` | `frontend/shared/` |
| `Nosotros.html` | `about.php` | `frontend/shared/` |
| `servicios.html` | `services.php` | `frontend/shared/` |
| `ver-flota.html` | `fleet.php` | `frontend/user/` |
| `mis-reservas.html` | `my-reservations.php` | `frontend/user/` |
| `nueva-reserva.html` | `new-reservation.php` | `frontend/user/` |
| `valorar-servicios.html` | `rate-service.php` | `frontend/user/` |
| `ficha-bus.html` | `bus-details.php` | `frontend/user/` |
| `ficha-chofer.html` | `driver-details.php` | `frontend/user/` |
| `home-login.html` | `dashboard.php` | `frontend/user/` |
| `home-public.html` | `home.php` | `frontend/shared/` |

---

## Rutas CakePHP

Las rutas se mantienen sin cambios:

```
/frontend/login        → login.php
/frontend/signup       → signup.php  
/frontend/about        → about.php
/frontend/services     → services.php
/frontend/fleet        → fleet.php
/frontend/newreservation    → new-reservation.php
/frontend/myreservations    → my-reservations.php
/frontend/rateservice       → rate-service.php
```

---

## Para Nuevos Archivos

Al crear un archivo frontend:

1. ✅ Usa inglés
2. ✅ Usa kebab-case
3. ✅ Usa minúsculas
4. ✅ Sé descriptivo
5. ✅ Extensión `.php`
6. ✅ Colócalo en `shared/` o `user/` según permisos

**Ejemplo**:
```bash
# Correcto
touch webroot/frontend/user/my-bookings.php

# Incorrecto
touch webroot/frontend/MisReservas.html
```

---

## ¿Por Qué Estas Reglas?

- 🌍 **SEO**: Nombres en inglés favorecen buscadores internacionales
- 🔧 **Mantenibilidad**: Estándar de industria, fácil para nuevos devs
- 🛡️ **Compatibilidad**: Sin caracteres especiales que causen problemas
- 📦 **Consistencia**: Todo el proyecto sigue la misma convención
- 🚀 **Profesionalismo**: Buena práctica a nivel global

---

**Última actualización**: Marzo 2, 2026
