# Proyecto DB

Sistema Laravel basado en el diagrama ER de `Empleado`, `Cargo` y `FuncionesCargo`, con relaciones y CRUD protegido por Laravel Sanctum.

## Requisitos

- PHP 8.3 o superior.
- Composer.
- Node.js y npm.
- Una base de datos compatible con Laravel, por ejemplo MySQL.

## Paso a paso para ponerlo en marcha

### 1. Instala las dependencias de PHP

```bash
composer install
```

### 2. Instala las dependencias de Node.js

```bash
npm install
```

### 3. Crea el archivo de entorno

Si el proyecto no tiene un archivo `.env`, crea una copia desde el ejemplo:

```bash
copy .env.example .env
```

### 4. Configura la base de datos

Abre el archivo `.env` y ajusta los datos de conexión a tu entorno:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 5. Genera la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Ejecuta las migraciones

```bash
php artisan migrate
```

### 7. Compila los assets frontend

```bash
npm run build
```

### 8. Levanta el proyecto

En una terminal ejecuta el servidor de Laravel:

```bash
php artisan serve
```

En otra terminal ejecuta Vite para el frontend:

```bash
npm run dev
```

Luego abre la dirección que te indique Laravel, normalmente `http://127.0.0.1:8000`.

## Alcance

- Autenticación API con Sanctum mediante tokens personales.
- CRUD JSON para `cargos`, `empleados` y `funciones-cargo`.
- Filtros de consulta con `search`, `ids`, `estado`, `cargo_id` y rangos de fecha.
- Relaciones:
  - Un `Empleado` pertenece a un `Cargo`.
  - Un `Cargo` tiene un `Empleado`.
  - Un `Cargo` tiene muchas `FuncionesCargo`.
  - Una `FuncionesCargo` pertenece a un `Cargo`.

## Endpoints

### Auth

- `POST /api/login`
- `GET /api/me`
- `POST /api/logout`

### Cargos

- `GET /api/cargos`
- `POST /api/cargos`
- `GET /api/cargos/{cargo}`
- `PATCH /api/cargos/{cargo}`
- `DELETE /api/cargos/{cargo}`

### Empleados

- `GET /api/empleados`
- `POST /api/empleados`
- `GET /api/empleados/{empleado}`
- `PATCH /api/empleados/{empleado}`
- `DELETE /api/empleados/{empleado}`

### FuncionesCargo

- `GET /api/funciones-cargo`
- `POST /api/funciones-cargo`
- `GET /api/funciones-cargo/{funcionesCargo}`
- `PATCH /api/funciones-cargo/{funcionesCargo}`
- `DELETE /api/funciones-cargo/{funcionesCargo}`

## Filtros

- `search`: búsqueda parcial tipo `LIKE`.
- `ids`: lista separada por comas para `WHERE IN`.
- `estado`: filtro booleano.
- `cargo_id`: filtro por cargo.
- `fecha_ingreso_from` y `fecha_ingreso_to`: rango `BETWEEN` para empleados.

## Pruebas

El proyecto incluye tests en Pest para autenticación, CRUD y filtros.

```bash
php artisan test
```

