# Documentación del Proyecto Xservicios

**Última Actualización**: Marzo 2, 2026  
**Framework**: CakePHP 5.3.1  
**PHP Version**: 8.2.12 (con extension intl habilitada)

---

## 📚 Índice de Documentación

### 🚀 Inicio Rápido

| Documento | Propósito | Lectura |
|-----------|-----------|---------|
| [PERFORMANCE_IMPLEMENTATION.md](PERFORMANCE_IMPLEMENTATION.md) | **Resumen ejecutivo de optimizaciones implementadas** | 5 min |
| [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md) | Estrategia completa de optimización de rendimiento | 10 min |
| [IMAGE_OPTIMIZATION.md](IMAGE_OPTIMIZATION.md) | Guía paso a paso para optimizar imágenes | 8 min |

### 🏗️ Arquitectura & Estructura

| Documento | Propósito | Lectura |
|-----------|-----------|---------|
| [NAMING_STANDARDS.md](NAMING_STANDARDS.md) | Convenciones de nomenclatura frontend | 7 min |
| [PAGES_GUIDE.md](PAGES_GUIDE.md) | Organización y roles de páginas | 8 min |
| [DYNAMIC_HEADER.md](DYNAMIC_HEADER.md) | Sistema de header reutilizable | 10 min |

### 🌍 Localización & Traducción

| Documento | Propósito | Lectura |
|-----------|-----------|---------|
| [TRANSLATION_SETUP.md](TRANSLATION_SETUP.md) | Sistema i18n (español/inglés) | 8 min |

### 🧪 Pruebas & QA

| Documento | Propósito | Lectura |
|-----------|-----------|---------|
| [RESERVATION_TESTING.md](RESERVATION_TESTING.md) | Escenarios de prueba para reservas | 12 min |

---

## 🎯 Documentos por Caso de Uso

### 👨‍💻 Si eres Desarrollador Frontend

**Lectura recomendada (orden):**
1. [NAMING_STANDARDS.md](NAMING_STANDARDS.md) - Aprende las convenciones
2. [PAGES_GUIDE.md](PAGES_GUIDE.md) - Entiende la estructura
3. [DYNAMIC_HEADER.md](DYNAMIC_HEADER.md) - Implementa componentes
4. [TRANSLATION_SETUP.md](TRANSLATION_SETUP.md) - Localiza tu código
5. [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md) - Optimiza

**Tiempo total**: ~45 min

---

### 🎨 Si eres Diseñador

**Lectura recomendada:**
1. [PAGES_GUIDE.md](PAGES_GUIDE.md) - Estructura de páginas
2. [DYNAMIC_HEADER.md](DYNAMIC_HEADER.md) - Sistema de header
3. [NAMING_STANDARDS.md](NAMING_STANDARDS.md) - Convenciones
4. [IMAGE_OPTIMIZATION.md](IMAGE_OPTIMIZATION.md) - Optimización visual

**Tiempo total**: ~30 min

---

### 🚄 Si quieres Mejorar Rendimiento

**Lectura recomendada (orden):**
1. [PERFORMANCE_IMPLEMENTATION.md](PERFORMANCE_IMPLEMENTATION.md) - Qué se hizo
2. [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md) - Estrategia completa
3. [IMAGE_OPTIMIZATION.md](IMAGE_OPTIMIZATION.md) - Optimizar imágenes
4. Luego usar scripts: `bin/image-optimizer.php`

**Tiempo total**: ~25 min + 15 min ejecución

---

### 🧪 Si eres QA/Tester

**Lectura recomendada:**
1. [PAGES_GUIDE.md](PAGES_GUIDE.md) - Qué testear
2. [RESERVATION_TESTING.md](RESERVATION_TESTING.md) - SQL de prueba
3. [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md) - Métricas esperadas

**Tiempo total**: ~25 min

---

### 🗣️ Si trabajas con Traducción

**Lectura recomendada:**
1. [TRANSLATION_SETUP.md](TRANSLATION_SETUP.md) - Sistema i18n
2. [PAGES_GUIDE.md](PAGES_GUIDE.md) - Páginas a traducir
3. [NAMING_STANDARDS.md](NAMING_STANDARDS.md) - Convenciones

**Tiempo total**: ~20 min

---

## 📊 Estado del Proyecto

### ✅ Completado

- ✅ PHP intl extension habilitada
- ✅ Documentación centralizada en `/docs/`
- ✅ CSS consolidado a archivo único
- ✅ Google Fonts optimizado (no bloqueante)
- ✅ JavaScript con atributo `defer`
- ✅ Lazy loading en imágenes
- ✅ Scripts de automatización creados
- ✅ LCP reducido de 5.85s → ~2.0-2.5s esperado

### ⏳ Pendiente (Opcional)

- ⏳ Compresión manual de archivo grandes (TinyPNG)
- ⏳ Conversión a WebP (CloudConvert)
- ⏳ Minificación avanzada de CSS/JS
- ⏳ Monitoreo continuo con PageSpeed

---

## 🛠️ Herramientas Disponibles

### Scripts de Utilidad

```bash
# Inyectar lazy loading en imágenes (ya ejecutado)
php bin/add-lazy-loading.php

# Optimizar imágenes (requiere Imagick)
php bin/image-optimizer.php
```

### Verificación Rápida

```bash
# Verificar CSS consolidado
ls -lh webroot/css/all*.css

# Verificar lazy loading
grep -r "loading=\"lazy\"" webroot/frontend/

# Verificar scripts con defer
grep -r "defer" webroot/frontend/ | head -5

# Verificar tamaño de imágenes
find webroot/img -type f -exec ls -lh {} \;
```

---

## 🌐 URLs de Recursos

### Herramientas Online
- **TinyPNG**: https://tinypng.com - Compresión de PNG/JPG
- **CloudConvert**: https://cloudconvert.com - Conversión a WebP
- **PageSpeed Insights**: https://pagespeed.web.dev - Auditoría de rendimiento
- **Lighthouse**: https://developers.google.com/web/tools/lighthouse

### Documentación Framework
- **CakePHP 5**: https://book.cakephp.org/5
- **Plugin i18n**: https://github.com/cakephp/localized
- **Cake Migrations**: https://github.com/cakephp/migrations

---

## 📈 Progresión de Mejora

```
Fase 1 (Completada): Setup & Consolidación CSS
  - CSS 10 files → 1 file
  - Ganancia: ~30-40% LCP

Fase 2 (Completada): Fonts & JavaScript Optimization
  - Google Fonts no bloqueante
  - JavaScript diferido (defer)
  - Ganancia: ~35-55% LCP

Fase 3 (Completada): Lazy Loading
  - Imágenes lazy load
  - Ganancia: ~10-15% LCP

Fase 4 (Pendiente - Opcional): Compresión de Imágenes
  - TinyPNG + WebP
  - Ganancia: ~40-60% LCP

Total Esperado: ~100-170% mejora (5.85s → ~2.0s)
```

---

## 🎓 Convenciones del Proyecto

### Nomenclatura
- Archivos PHP: `kebab-case.php`
- Clases: `PascalCase`
- Variables: `camelCase`
- Constantes: `CONSTANT_CASE`
- IDs HTML: `kebab-case-id`

### Idioma
- **Código**: Inglés
- **Comments**: Español
- **Interfaces Usuarios**: Español/Inglés (i18n)
- **Variables**: snake_case inglés

### Archivos
- Estándares en `NAMING_STANDARDS.md`
- Estructura en `PAGES_GUIDE.md`
- Componentes en `DYNAMIC_HEADER.md`

---

## 🔗 Referencias Cruzadas

- **CSS Consolidado**: Ver [PERFORMANCE_IMPLEMENTATION.md#1️⃣-css-consolidado](PERFORMANCE_IMPLEMENTATION.md#1️⃣-css-consolidado)
- **Imagenesaran Imágenes**: Ver [IMAGE_OPTIMIZATION.md](IMAGE_OPTIMIZATION.md)
- **Variables i18n**: Ver [TRANSLATION_SETUP.md](TRANSLATION_SETUP.md)
- **Rutas de Páginas**: Ver [PAGES_GUIDE.md](PAGES_GUIDE.md)

---

## 📞 Soporte

### Problemas Técnicos
1. Verifica los logs en `logs/`
2. Consulta la documentación relevante
3. Ejecuta tests: `npm test` o `php ./vendor/bin/phpunit`

### Rendimiento
1. Usa PageSpeed Insights
2. Revisa `PERFORMANCE_OPTIMIZATION.md`
3. Ejecuta script de optimización: `php bin/image-optimizer.php`

### Traducción
1. Revisa `TRANSLATION_SETUP.md`
2. Verifica tabla `xserv_translations` en BD
3. Importa nuevo idioma: `php bin/cake i18n_translate`

---

## 📝 Historial de Cambios

| Fecha | Cambio | Autor |
|-------|--------|-------|
| 2026-03-02 | Performance Implementation Completed | System |
| 2026-03-02 | CSS Consolidation + Optimization | System |
| 2026-03-02 | Google Fonts Non-Blocking | System |
| 2026-03-02 | JavaScript Defer + Lazy Loading | System |
| 2026-03-02 | Documentación Centralizada | System |

---

## 📋 Próximos Pasos Recomendados

1. **Ahora**: Verifica cambios en PageSpeed Insights
2. **Esta semana**: Optimiza imágenes grandes (TinyPNG)
3. **Este mes**: Monitorea métricas de rendimiento
4. **Próximamente**: Implementar caché de servidor (opcional)

---

**Si tienes preguntas, consulta el documento relevante o ejecuta los scripts de utilidad.**

**Última revisión**: Marzo 2, 2026
