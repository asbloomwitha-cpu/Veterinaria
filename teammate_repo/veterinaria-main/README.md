# 🐾 VetCare: Sistema de Gestión Veterinaria & API RESTful

Bienvenido a **VetCare**, una plataforma web robusta de administración veterinaria desarrollada bajo el framework **Laravel 12/13 (PHP 8.2+)**. Este proyecto implementa un completo sistema administrativo (CRUD) y expone una API RESTful formal para la gestión del catálogo de libros, cumpliendo con los estándares académicos y profesionales más exigentes de desarrollo de software backend.

---

## 👤 Información del Proyecto

* **Desarrollador / Alumno:** YvnPretty
* **Materia:** Desarrollo Backend Avanzado
* **Framework:** Laravel 12 / 13
* **Base de Datos:** MySQL / SQLite

---

## 🛠️ Módulos e Implementación

### 1. Sistema de Autenticación
* Inicio de sesión y registro de usuarios completamente personalizado.
* Vistas de autenticación adaptadas con recursos propios de marca ("Dr. Perrito").

### 2. Panel de Control (Dashboard VetCare)
* Interfaz basada en una versión de colores claros del popular template **SB Admin 2**.
* Estadísticas interactivas rápidas sobre pacientes, citas activas e historiales clínicos.

### 3. Módulo de Gestión de Usuarios (CRUD)
* Control de administradores y personal veterinario.
* Asignación y administración de credenciales de acceso.

### 4. Módulo de Pacientes / Mascotas (CRUD)
* Registro detallado de animales que incluye: Nombre, Especie, Raza, Edad y el dueño asignado de la base de usuarios.

### 5. Módulo de Citas y Agendamiento (CRUD)
* Planificación de consultas veterinarias vinculando pacientes, fechas, horas y motivos de la visita médica.

### 6. Historial Clínico Digital (CRUD)
* Almacenamiento de notas médicas, diagnósticos y tratamientos detallados por mascota.

### 7. API RESTful de Libros
* Endpoint disponible bajo `/api/libros` con soporte total para los 5 métodos del estándar REST:
  * **GET** `/api/libros`: Obtiene el catálogo completo de libros.
  * **POST** `/api/libros`: Inserta un nuevo libro (validado mediante Eloquent Model con protección `$fillable`).
  * **GET** `/api/libros/{id}`: Obtiene la ficha de un libro específico.
  * **PUT/PATCH** `/api/libros/{id}`: Actualiza un libro existente.
  * **DELETE** `/api/libros/{id}`: Elimina un registro del sistema.
* Respuestas en formato **JSON estricto** respetando los códigos de estado HTTP correctos (`200 OK`, `201 Created` y `404 Not Found`).



---

## ⚙️ Instrucciones de Instalación y Ejecución Local

1. **Clonar e ingresar al proyecto:**
   ```bash
   git clone git@github.com:YvnPretty/veterinaria.git
   cd veterinaria
   ```

2. **Ejecutar migraciones y poblar la base de datos:**
   ```bash
   php artisan migrate --seed
   ```

3. **Iniciar el servidor local de desarrollo:**
   ```bash
   php artisan serve
   ```
   Accede a la plataforma a través de `http://localhost:8000`.

4. **Actualizar y Empujar Cambios:**
   Para empujar las últimas modificaciones a tu repositorio GitHub de forma automática y limpia, simplemente ejecuta:
   ```bash
   bash push_vet.sh
   ```
