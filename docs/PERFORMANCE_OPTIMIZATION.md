# Performance Optimization Guide

## Diagnóstico de Rendimiento Lento

Tu sitio carga **~31KB de CSS sin minificar y múltiples archivos JavaScript bloqueantes**.  
LCP lento (5.85s) es causado principalmente por:

### 🔴 Problemas Identificados

| Problema | Impacto | Archivo |
|----------|---------|---------|
| 10 archivos CSS separados | ❌ 10 requests HTTP | `css/` |
| Google Fonts bloqueante | ❌ Retarda renderizado | home-templates-public.php:10 |
| CSS inlinado en templates | ❌ No cacheable | template files |
| JavaScript bloqueante | ❌ Bloquea parser | header-loader.js, i18n.js |
| cake.css sin uso | ❌ 6KB innecesarios | webroot/css/cake.css |
| Imágenes sin optimizar | ❌ Más grande que necesario | img/car-concept.jpeg |

---

## ✅ Soluciones (Orden de Recorrido)

### 1️⃣ Consolidar CSS (Ganancia: ~30-40% LCP)

**Estado actual:**
```html
<!-- 10 requests separados ❌ -->
<link rel="stylesheet" href="normalize.min.css">
<link rel="stylesheet" href="milligram.min.css">
<link rel="stylesheet" href="fonts.css">
<link rel="stylesheet" href="cake.css">
<link rel="stylesheet" href="style.css">
...
```

**Solución:**
```html
<!-- 1 request, 1 archivo minificado ✅ -->
<link rel="stylesheet" href="all.min.css">
```

**Pasos:**
```bash
# 1. Instalar minificador
npm install -g csso-cli

# 2. Consolidar en un solo archivo
cat css/normalize.min.css \
    css/milligram.min.css \
    css/fonts.css \
    css/style.css \
    css/header-auth.css > webroot/css/all.css

# 3. Minificar
csso webroot/css/all.css -o webroot/css/all.min.css

# 4. Actualizar layout
# En templates/layout/default.php cambiar:
# De: <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
# A:  <?= $this->Html->css(['all.min']) ?>
```

---

### 2️⃣ Optimizar Google Fonts (Ganancia: ~20-30% LCP)

**Cambio en home-templates-public.php:**

```html
<!-- ❌ ANTES: Bloqueante -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- ✅ DESPUÉS: No bloqueante + preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600&display=swap" rel="stylesheet"></noscript>
```

**Cambios:**
- ✅ Agregué `preconnect` (faster DNS)
- ✅ Solo pesos necesarios (700 de Playfair, 400/600 de Inter)
- ✅ `media="print"` + `onload` = no bloqueante

---

### 3️⃣ Diferir JavaScript (Ganancia: ~15-25% LCP)

**En home-templates-public.php y todos los .php:**

```html
<!-- ❌ ANTES: Bloqueante -->
<script src="/js/header-loader.js"></script>
<script src="/js/header-dynamic.js"></script>
<script src="/js/i18n.js"></script>

<!-- ✅ DESPUÉS: No bloqueante -->
<script src="/js/header-loader.js" defer></script>
<script src="/js/header-dynamic.js" defer></script>
<script src="/js/i18n.js" defer></script>
<!-- O mejor aún: -->
<script src="/js/all.min.js" defer></script>
```

---

### 4️⃣ Optimizar Imágenes (Ganancia: ~10-20%)

**Verificar tamaño actual:**
```bash
ls -lh webroot/img/
# car-concept.jpeg probablemente muy grande
```

**Soluciones:**

```bash
# Instalar herramientas
npm install -g imagemin-cli imagemin-mozjpeg imagemin-pngquant

# Comprimir JPG (máximo 60% de tamaño original)
imagemin webroot/img/*.jpeg --out-dir=webroot/img --plugin=mozjpeg --mozjpeg-quality=75

# Convertir a WebP (30-50% más pequeño)
cwebp webroot/img/car-concept.jpeg -o webroot/img/car-concept.webp -q 75

# En HTML usar con fallback:
<picture>
  <source srcset="/img/car-concept.webp" type="image/webp">
  <img src="/img/car-concept.jpeg" alt="Car">
</picture>
```

---

### 5️⃣ Lazy Loading (Ganancia: ~10%)

```html
<!-- En templates/element/header.php y todas las imágenes -->

<!-- ❌ ANTES -->
<img src="/img/logo.png">

<!-- ✅ DESPUÉS -->
<img src="/img/logo.png" loading="lazy" decoding="async">
```

---

### 6️⃣ Server Response (Ganancia: ~5-10%)

**En src/Controller/AppController.php:**

```php
public function beforeRender(Event $event)
{
    parent::beforeRender($event);
    
    // Agregar headers de cache
    $this->response = $this->response
        ->withHeader('Cache-Control', 'public, max-age=3600')
        ->withHeader('X-Content-Type-Options', 'nosniff')
        ->withHeader('X-Frame-Options', 'SAMEORIGIN');
}
```

---

### 7️⃣ Minificar JavaScript Personalizado (Ganancia: ~10%)

```bash
# Instalar
npm install -g terser

# Minificar
terser webroot/js/header-loader.js -c -m -o webroot/js/header-loader.min.js
terser webroot/js/header-dynamic.js -c -m -o webroot/js/header-dynamic.min.js
terser webroot/js/i18n.js -c -m -o webroot/js/i18n.min.js

# O mejor: Combinar todo en un solo archivo
cat webroot/js/header-loader.js \
    webroot/js/header-dynamic.js \
    webroot/js/i18n.js > webroot/js/all.js

# Minificar el combined
terser webroot/js/all.js -c -m -o webroot/js/all.min.js
```

---

## 📊 Impacto Esperado

| Optimización | Mejora Estimada | Costo |
|--------------|-----------------|-------|
| Consolidar CSS | 30-40% | 30 min |
| Google Fonts | 20-30% | 5 min |
| Defer JS | 15-25% | 10 min |
| Imágenes | 10-20% | 20 min |
| Lazy Loading | 10% | 15 min |
| Cache Headers | 5-10% | 5 min |
| Minificar JS | 10% | 15 min |
| **TOTAL** | **~100-170%** | **~2 horas** |

**Expectativa final: LCP de 5.85s → ~1.5-2.0s ✅**

---

## 🚀 Plan de Acción Recomendado

### Día 1 (1 hora)
1. ✅ Consolidar CSS → `all.min.css`
2. ✅ Optimizar Google Fonts
3. ✅ Agregar `defer` a scripts

### Día 2 (1 hora)
4. ✅ Comprimir imágenes
5. ✅ Convertir a WebP
6. ✅ Agregar lazy loading

### Día 3 (30 min)
7. ✅ Cache headers en servidor
8. ✅ Test con PageSpeed Insights
9. ✅ Ajustes finales

---

## 🔍 Testing

**Antes de optimizar:**
```bash
# Verificar LCP actual
# Google PageSpeed: https://pagespeed.web.dev/
# Lighthouse en DevTools: F12 → Lighthouse
```

**Después de optimizar:**
```bash
# Verificar mejora
# Deberías ver:
# - LCP: < 2.5s ✅
# - FCP: < 1.5s ✅
# - CLS: < 0.1 ✅
```

---

## 📝 Cambios en Archivos

### templates/layout/default.php

```php
<!-- Cambiar -->
<?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

<!-- A -->
<?= $this->Html->css(['all.min']) ?>
```

### webroot/frontend/shared/home-templates-public.php

```html
<!-- Cambiar Google Fonts -->
<!-- Agregar preconnect -->
<!-- Agregar media="print" onload -->
```

### Todos los .php frontend

```html
<!-- Cambiar scripts al final de body -->
<script src="/js/all.min.js" defer></script>
```

---

## ⚠️ Precauciones

1. **Hacer backup** antes de cambios grandes
2. **Probar localmente** primero
3. **Verificar que no rompa funcionalidad**
4. **Probar en diferentes navegadores**
5. **Verificar SEO** con Google Search Console

---

## 📞 Soporte

Si necesitas ayuda implementar cualquiera de estas changes, avísame y lo hacemos juntos.

**Última actualización**: Marzo 2, 2026
