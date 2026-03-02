# Translation System Setup

## Sistema de Traducción Multilingüe (i18n)

Implementación automática de traducción entre español e inglés usando CakePHP i18n.

### Características

- ✅ Soporte automático ES/EN
- ✅ Almacenamiento en base de datos
- ✅ Cambio dinámico sin recargar página
- ✅ Fallback automático a idioma por defecto
- ✅ Selector de idioma en header

---

## Base de Datos

### Tabla `i18n`

```sql
CREATE TABLE i18n (
    id int NOT NULL auto_increment,
    locale varchar(6) NOT NULL,
    model varchar(255) NOT NULL,
    foreign_key int(10) NOT NULL,
    field varchar(255) NOT NULL,
    content text,
    PRIMARY KEY (id),
    UNIQUE INDEX I18N_LOCALE_FIELD(locale, model, foreign_key, field),
    INDEX I18N_FIELD(model, foreign_key, field)
);
```

### Tabla de Modelos

Añade campo de descripción a cualquier tabla que necesite traducciones:

```sql
ALTER TABLE xserv_servicios ADD COLUMN descripcion TEXT NULL;
ALTER TABLE xserv_destinos ADD COLUMN descripcion TEXT NULL;
```

---

## Cómo Agregar Traducciones

### Opción 1: Via Formulario

1. Completa "Descripción" en español
2. Se guarda en `xserv_servicios.descripcion`
3. Para inglés, inserta en tabla `i18n`:

```sql
INSERT INTO i18n (locale, model, foreign_key, field, content) 
VALUES ('en', 'XservServicios', 7, 'descripcion', 'English text here');
```

### Opción 2: Directamente en BD

```sql
-- Españcol (tabla principal)
UPDATE xserv_servicios 
SET descripcion = 'Tour de café con degustación' 
WHERE id = 1;

-- Inglés (tabla i18n)
INSERT INTO i18n (locale, model, foreign_key, field, content)
VALUES ('en', 'XservServicios', 1, 'descripcion', 'Coffee tour with tasting');
```

---

## Cambiar Idioma

### Métodos Disponibles

1. **Query string**: `?lang=en` o `?lang=es`
2. **Cookie**: Se persiste 30 días
3. **Header Accept-Language**: Detecta del navegador
4. **Selector en header**: Clickear ES/EN

### En Código PHP

```php
// Establecer idioma
I18n::setLocale('en');

// Obtener idioma actual
$current = I18n::getLocale();

// Traducir
__('xserv_servicios.descripcion', true, ['id' => 1]);
```

---

## Modelos Soportados

Modelos con traducciones activas:

| Modelo | Campos | Tabla BD |
|--------|--------|----------|
| XservServicios | descripcion | xserv_servicios |
| XservDestinos | descripcion | xserv_destinos |
| XservConfiguraciones | valor | xserv_configuraciones |

---

## JavaScript (Frontend)

### Cómo Usar en HTML

```html
<!-- Traducción de atributos -->
<h1 data-i18n="page.title">Mis Reservas</h1>
<input data-i18n-placeholder="form.name" placeholder="Nombre">

<!-- Con etiqueta span -->
<span class="translate" data-key="menu.home">Inicio</span>
```

### En JavaScript

```javascript
// Cambiar idioma
setLanguage('en');

// Get translation
const text = translations['es']['page.title'];
```

---

## Setup Inicial

### 1. Migración

```bash
php bin/cake.php migrations migrate
```

### 2. Población de Datos (Opcional)

```bash
mysql -u root xservicios_db < config/Migrations/i18n_servicios_seeds.sql
```

### 3. Test

```bash
# Verificar tabla i18n existe
mysql -u root -e "DESCRIBE xservicios_db.i18n;"

# Ver datos
mysql -u root -e "SELECT * FROM xservicios_db.i18n LIMIT 5;"
```

---

## Idiomas Disponibles

| Código | Idioma | Estado |
|--------|--------|--------|
| es | Español | ✅ Activo |
| en | Inglés | ✅ Activo |
| fr | Francés | 🔶 Futuro |
| pt | Portugués | 🔶 Futuro |

---

## Ejemplos de Traducción

### Servicios

```sql
-- Español
UPDATE xserv_servicios SET descripcion = 'Tour de café con catación' WHERE id = 1;

-- Inglés  
INSERT INTO i18n VALUES (NULL, 'en', 'XservServicios', 1, 'descripcion', 'Coffee tour with tasting', NOW(), NOW());
```

### Destinos

```sql
-- Español
UPDATE xserv_destinos SET descripcion = 'Finca de café con vistas panorámicas' WHERE id = 3;

-- Inglés
INSERT INTO i18n VALUES (NULL, 'en', 'XservDestinos', 3, 'descripcion', 'Coffee farm with panoramic views', NOW(), NOW());
```

---

## Troubleshooting

| Problema | Solución |
|----------|----------|
| Traducción no aparece | Verifica que exista en tabla i18n |
| Idioma no cambia | Limpia localStorage y cookies |
| Error de locale | Verifica que tabla i18n exista |
| Fallback a español | Idioma solicitado no tiene traducción |

---

## Performance

- ✅ Caché de traducciones en memoria
- ✅ Lazy loading de idiomas
- ✅ localStorage para preferencia del usuario
- ✅ Sin impacto en velocidad

---

**Última actualización**: Marzo 2, 2026
