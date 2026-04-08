# xservicios

# Sistema Web de Transporte Turístico de Lujo - Xservicios de Chiriquí

Este repositorio contiene el código fuente del sistema web desarrollado en el marco de la **Práctica Profesional en Gestión y Desarrollo de Software** (Verano 2026, Universidad en Chiriquí, Panamá).  

El proyecto es un sistema bilingüe (español/inglés) para reservas de transporte turístico de lujo, gestión de choferes, flota vehicular, trazabilidad operativa, valoraciones y reportes básicos.  

**Tecnologías principales**:
- Framework: CakePHP 5.x
- Base de datos: MySQL
- Servidor local: XAMPP (Apache + MySQL) o MySQL nativo
- Control de versiones: Git + GitHub

## Requisitos Previos
- PHP ≥ 8.2 (recomendado 8.3 para mejor rendimiento y compatibilidad con CakePHP 5)
- Composer instalado globalmente
- MySQL 8.0+ (incluido en XAMPP o instalado nativo)
- Git
- Extensiones PHP requeridas: `intl`, `mbstring`, `pdo_mysql`, `simplexml` (habilitadas por defecto en XAMPP recientes, pero verifica)

## Demo para Render
Este repositorio incluye un modo demo pensado para portafolio y despliegue en Render.

- No depende de MySQL para las pantallas públicas.
- Usa datos simulados en el frontend.
- Guarda reservas y valoraciones de ejemplo en `localStorage`.
- Se activa con la variable de entorno `DEMO_MODE=true`.

Para Render, usa el `Dockerfile` del proyecto y el blueprint `render.yaml`.

## Instrucciones para Configurar y Ejecutar el Proyecto

### 1. Clonar el Repositorio
```bash
git clone https://github.com/edwardperxz/xservicios.git
cd xservicios
```
### 2. Instalar dependencias
```bash
composer install
```

Si es un proyecto fresco (sin vendor/):
```bash
composer create-project --prefer-dist cakephp/app:~5.0 .
```
(Nota: ~5.0 instala la última versión estable de la rama 5.x)

### 3. Configurar la base de datos

Opción A: Con XAMPP (recomendado para desarrollo local en Windows)

1. Abre XAMPP Control Panel.
2. Inicia Apache y MySQL (deben quedar en verde).
3. Accede a phpMyAdmin:
   - Clic en "Admin" junto a MySQL, o abre en navegador:
   - http://localhost/phpmyadmin/
   (si cambiaste puerto Apache a 80: http://localhost:80/phpmyadmin/)

4. Credenciales por defecto:
   - Usuario: root
   - Contraseña: (vacía) 

5. Crea la base de datos:
   - Clic en "Nueva" (izquierda) → Nombre: xservicios_db
   - Collation: utf8mb4_unicode_ci → Crear.

6. Importa el esquema:
   - Selecciona la DB → Pestaña Importar → Sube docs/database_schema.sql → Ejecutar.

Opción B: MySQL Nativo (sin XAMPP)

1. Abre MySQL Workbench o cualquier cliente MySQL.
2. Crea la base de datos:
   - Nombre: xservicios_db
   - Collation: utf8mb4_unicode_ci

3. Importa el esquema:
   - Selecciona la DB → Pestaña Importar → Sube docs/database_schema.sql → Ejecutar.

### 4. Configuración de Conexión en CakePHP

Edita el archivo:
config/app_local.php
(Importante: nunca commitear credenciales sensibles; usa .gitignore).
Busca y ajusta la sección Datasources > default:

```php
'Datasources' => [
    'default' => [
        'className' => 'Cake\Database\Connection',
        'driver' => 'Cake\Database\Driver\Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',          // Cambia si definiste contraseña en root
        'database' => 'xservicios_db',
        'encoding' => 'utf8mb4',
        'timezone' => 'America/Panama',  // Zona horaria de Chiriquí
        'cacheMetadata' => true,
    ],
],
```
Prueba la conexión:

```bash
php bin/cake migrations migrate
```
### 5. Ajustes Comunes a php.ini (para evitar conflictos con XAMPP)

Si ves errores como "ext-intl missing" durante composer install o ejecución:

1. Detén Apache/MySQL en XAMPP.
2. Abre: C:\xampp\php\php.ini (con editor como administrador).

```text
extension=intl
extension=mbstring
extension=pdo_mysql
extension=simplexml
``` 
```text
max_execution_time = 300
memory_limit = 512M
```
3. Reinicia Apache/MySQL en XAMPP.

Nota: Si usas MySQL nativo, edita el php.ini que carga tu CLI (php --ini para ubicarlo).

### 6. Ejecutar el Servidor de Desarrollo

```bash
php bin/cake.php server
```

### 7. Desplegar en Render

1. Crea un nuevo Web Service en Render desde este repositorio.
2. Asegúrate de que Render use el `Dockerfile` del proyecto.
3. Revisa/define estas variables de entorno:
   - `DEMO_MODE=true`
   - `DEBUG=false`
   - `APP_ENV=production`
   - `SECURITY_SALT` (secreto)
   - `APP_FULL_BASE_URL` (URL pública final de Render)
4. No necesitas configurar MySQL para la demo pública.

Si quieres publicar la versión completa con backend real, entonces sí necesitas una base de datos externa y revisar las rutas privadas.

### 8. Checklist de Producción (Demo)

- El servicio responde en `/` sin depender de base de datos.
- `DEMO_MODE=true` está activo en Render.
- `DEBUG=false` en producción.
- `APP_FULL_BASE_URL` configurado con tu dominio de Render.
- No subas `config/app_local.php` ni `composer.phar` al repositorio.
# Esquema de la base de datos

El esquema completo está en: docs/database_schema.sql
Resumen de tablas principales:

- xserv_usuarios → Accesos y roles (admin, operador, chofer)
- xserv_choferes → Perfiles de choferes con disponibilidad
- xserv_vehiculos → Flota (tipo, capacidad, placa, estado)
- xserv_servicios → Catálogo parametrizable (precios, variantes)
- xserv_destinos → Destinos turísticos bilingües
- xserv_clientes → Perfiles de clientes
- xserv_reservas → Núcleo (estados, asignaciones, trazabilidad)
- xserv_valoraciones → Calificaciones post-servicio
- xserv_notificaciones → Logs de envíos (correo/WhatsApp simulado)

Para generar código automático desde la DB:

```bash
php bin/cake bake model all
php bin/cake bake controller all
php bin/cake bake view all
```
### Estructura del Proyecto (CakePHP 5)

- src/ → Backend (Controllers, Models, etc.)
- templates/ → Vistas PHP (frontend server-side)
- webroot/ → Assets (CSS con paleta corporativa: negro, verde pastel, chocolate, amarillo amanecer, blanco; JS)
- config/ → Configuraciones (app_local.php para DB)
- docs/ → Documentación (esquema SQL, SRS, etc.)