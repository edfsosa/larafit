# Larafit

**Larafit** es una aplicación web para la gestión integral de gimnasios, construida con **Laravel 12** y **FilamentPHP** para el panel administrativo.

## Características

- **Gestión de Socios**: Inscripción, perfil, datos de contacto y metas de entrenamiento.
- **Membresías**: Tipos, duración, precios y renovaciones.
- **Control de Asistencia**: Registro de entradas y salidas (con futuro soporte para control facial).
- **Entrenadores**: Perfiles, especialidades, disponibilidad y tarifas.
- **Clases/Actividades**: Horarios, cupos, reservas y asignación de entrenadores.
- **Pagos**: Gestión de cobros, vencimientos y reportes.
- **Rutinas de Ejercicio**:
  - Catálogo de ejercicios (tipos, dificultad, multimedia, parámetros por defecto).
  - Planes de entrenamiento asignados a socios.
  - Ítems de rutina con series, repeticiones, peso, tempo, superseries, cardio, etc.
  - Comentarios y marcado de completado por socio o entrenador.
- **Roles y Permisos** con **Spatie**:
  - Roles: `admin`, `trainer`, `member`.
  - Permisos granulares (gestión de recursos y acceso).

## Requisitos

- PHP ≥ 8.1
- Composer
- MySQL (o MariaDB)
- Node.js & NPM (para assets de Filament)
- Servidor web (Nginx, Apache)
- Opcional: HestiaCP para gestión de dominios y SSL

## Instalación local

1. **Clonar repositorio**  
   ```bash
   git clone https://github.com/TU_USUARIO/larafit.git
   cd larafit
   ```

2. **Variables de entorno**  
   ```bash
   cp .env.example .env
   ```  
   Configura en `.env`:
   ```
   APP_URL=http://localhost
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=larafit
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

3. **Instalar dependencias**  
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install
   npm run build
   ```

4. **Key y migraciones**  
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   ```

5. **Servir la aplicación**  
   ```bash
   php artisan serve
   ```  
   Accede a `http://localhost/admin` y entra con el usuario admin creado.

## Roles y Permisos

- Ejecuta el seeder tras migrar:
  ```bash
  php artisan db:seed --class=RolesAndPermissionsSeeder
  ```
- Asigna roles en Tinker o desde Filament:
  ```php
  $user->assignRole('trainer');
  $user->assignRole('member');
  ```

## Contribuciones

1. **Fork** del proyecto.
2. Crea una **branch** feature.
3. Haz **pull request** describiendo cambios.
4. Asegura que todas las **migraciones** y **seeders** estén actualizados.

## Licencia

Proyecto de código abierto bajo la licencia MIT.