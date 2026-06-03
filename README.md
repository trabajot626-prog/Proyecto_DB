# Proyecto DB

Sistema Laravel basado en el diagrama ER de la imagen: `Empleado`, `Cargo` y `FuncionesCargo`, con relaciones y CRUD protegido por Laravel Sanctum.

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

