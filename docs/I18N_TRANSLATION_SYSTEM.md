# Sistema de Traducción Automática con i18n

## ¿Cómo funciona?

El sistema ahora soporta **traducción automática** entre español e inglés usando el **Translate Behavior** de CakePHP.

### Características principales:

1. **Descripción en español** en la base de datos (campo `descripcion`)
2. **Traducciones en inglés** almacenadas en tabla `i18n`
3. **Cambio automático** de idioma según preferencia del usuario
4. **Sin código manual** en las vistas - transparente

---

## Cómo agregar un nuevo servicio

### En el formulario:

1. Completa el campo **"Descripción del Servicio (Español)"** con texto en español
2. CakePHP guardará esto en `xserv_servicios.descripcion`
3. Para agregar la traducción en inglés, inserta manualmente en la tabla `i18n`:

```sql
INSERT INTO i18n (locale, model, foreign_key, field, content) VALUES
('en', 'XservServicios', 7, 'descripcion', 'Your English translation here');
```

> **Nota**: `foreign_key = 7` es el ID del servicio que acabas de crear.

---

## Cómo cambiar de idioma

### Para usuarios:

El sistema detecta automáticamente el idioma usando:

1. **Query string**: `?lang=en` o `?lang=es`
2. **Cookie**: Guarda la preferencia por 30 días
3. **Header Accept-Language**: Del navegador

### Selector visual:

En las vistas aparecerá automáticamente:

```
ES | EN
```

Click en el idioma para cambiar.

---

## Estructura de la base de datos

### Tabla `xserv_servicios`:
```sql
ALTER TABLE xserv_servicios ADD COLUMN descripcion TEXT NULL AFTER nombre;
```

### Tabla `i18n`:
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

### Ejemplo de datos:

```sql
-- Español (default en la tabla principal)
UPDATE xserv_servicios SET descripcion = 'Tour a las plantaciones de café...' WHERE id = 1;

-- Inglés (en tabla i18n)
INSERT INTO i18n (locale, model, foreign_key, field, content) VALUES
('en', 'XservServicios', 1, 'descripcion', 'Coffee plantation tour...');
```

---

## Comandos para configurar

### 1. Ejecutar la migración:
```bash
php bin/cake.php migrations migrate
```

### 2. Poblar traducciones de ejemplo:
```bash
mysql -u root xservicios_db < config/Migrations/i18n_servicios_seeds.sql
```

### 3. Actualizar servicios existentes con descripciones:
```sql
UPDATE xserv_servicios SET descripcion = 
  'Servicio de traslado desde la ciudad de David hasta el pueblo de Boquete. Transporte cómodo y seguro con choferes experimentados.' 
WHERE id = 1;

UPDATE xserv_servicios SET descripcion = 
  'Tour por plantaciones de café en las alturas de Boquete. Aprende sobre el proceso de producción desde la semilla hasta la taza. Incluye degustación.' 
WHERE id = 2;

-- etc...
```

---

## Componentes técnicos

### 1. `LocaleMiddleware.php`
Detecta y configura el idioma automáticamente en cada request.

### 2. `XservServiciosTable.php`
```php
$this->addBehavior('Translate', [
    'fields' => ['descripcion'],
    'translationTable' => 'i18n'
]);
```

### 3. `LanguageHelper.php`
Helper para selector de idioma y funciones útiles:
- `getCurrentLocale()` - Idioma actual
- `isSpanish()` / `isEnglish()`
- `languageSelector()` - HTML del selector

---

## Uso en las vistas

### Mostrar descripción traducida:
```php
<?= h($servicio->descripcion) ?>
```

> CakePHP automáticamente carga la traducción según el locale.

### Agregar selector de idioma:
```php
<?= $this->Language->languageSelector() ?>
```

---

## Preguntas frecuentes

### ¿Tengo que traducir manualmente?
**Sí**, por ahora las traducciones se agregan manualmente en la tabla `i18n`. En el futuro podrías integrar:
- Google Translate API
- DeepL API
- Panel de administración para traducciones

### ¿Puedo agregar más idiomas?
**Sí**, solo agrega más registros en `i18n` con locale diferente:
```sql
INSERT INTO i18n VALUES (null, 'fr', 'XservServicios', 1, 'descripcion', 'Votre traduction française');
```

Y actualiza el middleware para soportar 'fr'.

### ¿Qué pasa si no hay traducción?
CakePHP usa el valor por defecto de la tabla principal (español).

---

## Mejoras futuras

- [ ] Panel admin para gestionar traducciones
- [ ] Integración con API de traducción automática
- [ ] Soporte para más campos traducibles (nombre, variantes, etc.)
- [ ] Cache de traducciones para mejor performance
- [ ] Exportar/Importar traducciones en CSV

---

**Fecha**: 26 de febrero de 2026  
**Versión**: 1.0  
**Proyecto**: XServicios - Sistema de Traducción i18n
