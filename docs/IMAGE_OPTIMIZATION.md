# Image Optimization Instructions

## Imágenes a Optimizar

### Imágenes Grandes Identificadas

| Archivo | Tamaño | Ubicación | Uso |
|---------|--------|-----------|-----|
| car-concept.jpeg | 297KB | webroot/img/ | Background hero |
| coaster_xservicios.png | 456KB | webroot/img/vehiculos/ | Galería flota |
| bus15_xservicios.png | 200KB | webroot/img/vehiculos/ | Galería flota |

---

## Opción 1: Usar Herramientas Online (Recomendado)

### Paso 1: Comprimir JPEG

1. Abre https://tinypng.com (o https://compressor.io)
2. Sube `webroot/img/car-concept.jpeg`
3. Baja la versión comprimida
4. **Reemplaza** el archivo original
5. **Resultado esperado**: 297KB → ~75-100KB (70% reducción)

### Paso 2: Convertir a WebP

1. Abre https://cloudconvert.com/jpeg-to-webp
2. Sube `webroot/img/car-concept.jpeg`
3. Selecciona Quality: 75
4. Descarga como `car-concept.webp`
5. Coloca en `/webroot/img/car-concept.webp`

### Paso 3: Optimizar PNGs

Para `coaster_xservicios.png` y `bus15_xservicios.png`:

1. Abre https://tinypng.com
2. Sube ambas imágenes (máximo 20 a la vez)
3. Descarga las versiones comprimidas
4. Reemplaza los archivos originales
5. **Resultado esperado**: 200KB + 456KB → ~50-80KB cada

### Paso 4: Convertir PNGs a WebP

1. Para cada PNG, abre https://cloudconvert.com/png-to-webp
2. Sube y descarga como WebP (Quality: 75)
3. Coloca en `/webroot/img/vehiculos/` con extensión `.webp`

---

## Opción 2: Script Automático (Requiere Imagick)

Si tienes Imagick instalado:

```bash
# Instalar Imagick (Ubuntu/Debian)
sudo apt-get update
sudo apt-get install php-imagick imagemagick

# Ejecutar script
php bin/image-optimizer.php
```

---

## Opción 3: CLI Tools (Linux/Mac)

### Comprimir JPEGs con ImageMagick

```bash
# Instalar
sudo apt-get install imagemagick

# Comprimir
convert webroot/img/car-concept.jpeg -quality 75 webroot/img/car-concept-optimized.jpeg
```

### Convertir a WebP

```bash
# Instalar
sudo apt-get install webp

# Convertir
cwebp webroot/img/car-concept.jpeg -q 75 -o webroot/img/car-concept.webp
cwebp webroot/img/vehiculos/coaster_xservicios.png -q 75 -o webroot/img/vehiculos/coaster_xservicios.webp
cwebp webroot/img/vehiculos/bus15_xservicios.png -q 75 -o webroot/img/vehiculos/bus15_xservicios.webp
```

---

## Actualizar HTML para Usar WebP

### Patrón para HTML

Cuando hayas creado las versiones WebP, actualiza los tags `<img>`:

```html
<!-- ANTES -->
<img src="/img/car-concept.jpeg" alt="Car">

<!-- DESPUÉS -->
<picture>
  <source srcset="/img/car-concept.webp" type="image/webp">
  <img src="/img/car-concept.jpeg" alt="Car" loading="lazy" decoding="async">
</picture>
```

### Patrón para CSS Backgrounds

Para backgrounds con fallback WebP (requiere JavaScript o media queries avanzadas):

```css
/* BEFORE */
background-image: url('/img/car-concept.jpeg');

/* DESPUÉS: Agregar srcset con JavaScript */
/* O simplemente usar JPEG optimizado */
background-image: url('/img/car-concept.jpeg');
```

---

## Archivos a Actualizar Después de Comprimir

Estos archivos contienen referencias a las imágenes grandes:

1. **home-loged.php** (línea ~44)
   - `background-image: url('/img/car-concept.jpeg')`

2. **home-templates-login.php** (línea ~247)
   - `background-image: url('/img/car-concept.jpeg')`

3. **dashboard.php** (línea ~170)
   - `background: url('/img/car-concept.jpeg')`

4. Cualquier otro archivo que referencia estas imágenes

---

## Impacto de Optimización

### Estimaciones

| Cambio | Reducción | Impacto LCP |
|--------|-----------|------------|
| Comprimir JPEG 75% | ~220KB ahorrados | +50-100ms |
| Convertir a WebP | ~40% más pequeño | +30-50ms |
| Lazy loading | No descarga al inicio | +100-200ms |
| **TOTAL** | ~60% reducción imagen | **~200-400ms de mejora** |

### Antes vs Después

```
ANTES:
car-concept.jpeg: 297KB (sincrono)
coaster_xservicios.png: 456KB (sincrono)
bus15_xservicios.png: 200KB (sincrono)
Total: ~953KB

DESPUÉS (con optimización + lazy):
car-concept.webp: ~75KB (lazy loaded)
coaster_xservicios.webp: ~90KB (lazy loaded)
bus15_xservicios.webp: ~50KB (lazy loaded)
Total: ~215KB (78% reducción)
```

---

## Verificación de Optimización

Después de optimizar:

1. **En navegador Developer Tools:**
   - F12 → Network
   - Busca las imágenes
   - Verifica tamaño descargado

2. **En CLI:**
   ```bash
   ls -lh webroot/img/
   # Debería mostrar archivos mucho más pequeños
   ```

3. **PageSpeed Insights:**
   - Ejecuta Google PageSpeed Insights
   - Verifica que "Optimize images" ya no aparezca

---

## Recomendaciones Finales

✅ **Paso 1**: Usa TinyPNG para comprimir (más fácil)

✅ **Paso 2**: Convierte a WebP en CloudConvert

✅ **Paso 3**: Ya agregué `loading="lazy"` en HTML ✓

✅ **Paso 4**: Actualiza referencias una vez optimices

---

## Timeline

- ⏱️ **5 minutos**: TinyPNG para comprimir JPEGs
- ⏱️ **5 minutos**: CloudConvert para WebP
- ⏱️ **5 minutos**: Actualizar HTML con picture tags

**Total: ~15 minutos para ahorro de ~200-400ms en LCP**

---

**Fecha**: Marzo 2, 2026
