# Event Management MVP

## Descripción del Proyecto

Este proyecto es un MVP (Producto Mínimo Viable) desarrollado para una compañía que organiza eventos y desea validar su negocio en línea. La aplicación cuenta con una API para permitir la interacción con un frontend. Se ha desarrollado el backend y las reglas de negocio el framework Laravel. La aplicación permite la gestión de eventos por parte de administradores, así como la inscripción de usuarios a eventos publicados.

## Funcionalidades

### 1. Gestión de Eventos (Rol Administrador)
Los administradores pueden:
- Crear nuevos eventos.
- Editar eventos existentes.
- Eliminar eventos.


### 2. Visualización de Eventos
- Todos los eventos son visibles para todos los usuarios, sin importar su estado.
- Los eventos con fecha futura permiten la inscripción de usuarios.
- Los eventos con fecha pasada se pueden visualizar pero no permiten inscripción.

### 3. Inscripción de Usuarios
- Los usuarios pueden inscribirse en eventos publicados que tengan una fecha y hora futura. Cada usuario puede ver los eventos en los que está inscrito, tanto activos como completados.
- Los usuario se pueden inscribir una sola vez en cada evento.

### 4. Listado de Eventos Inscriptos
Los usuarios pueden acceder a un endpoint donde se les mostrará un listado de los eventos en los que están inscritos, pudiendo filtrar entre eventos activos (con fecha futura) y eventos completados (con fecha pasada).

## Endpoints de la API

### **Login (Administradores y Usuarios)**
- **POST /login**: Autentica y genera un token al usuario:
   ```bash 
  array('email' => 'user@test.com','password' => 'password')

### **Administración de Eventos (Sólo Administradores)**
- **POST /events**: Crear un nuevo evento:
    ```json
    {
        "title": "evento nuevo",
        "short_description": "short_description",
        "long_description":"long_description",
        "date_time":"2023-10-01 12:00:00",
        "organizer":"organizer",
        "location":"location",
        "status":"borrador"
    }

- **PUT /events/{id}**: Actualizar un evento existente:
    ```json
    {
        "title": "evento modificado",
        "short_description": "short_description",
        "long_description":"long_description",
        "date_time":"2023-10-01 12:00:00",
        "organizer":"organizer",
        "location":"location",
        "status":"publicado"
    }
  
- **DELETE /events/{id}**: Eliminar un evento.

### **Visualización de Eventos (Administradores y Usuarios)**
- **GET /events**: Listar eventos.
- **GET /events/{id}**: Ver detalles de un evento.

### **Inscripción a Eventos y Listar inscripciones (Sólo Usuarios)**
- **POST /inscriptions**: Inscribirse a un evento publicado:
    ```json
    {
        "user_id": 2,
        "event_id": 9
    }
  
- **GET /inscriptions/{id}**: Ver eventos en los que el usuario está inscrito.

## Requisitos Técnicos
- **docker-compose v3**

## Cómo Ejecutar el Proyecto

- **Clonar repositorio**:
   ```bash
   git clone url_repositorio

- **En el directorio raiz ejecutar**:
   ```bash
   docker-compose up -d

- **Dentro del contenedor de PHP, instalar dependencias con composer**:
   ```bash
   composer install

- **Copiar y configurar el archivo de variables de entorno según su configuración local**:
   ```bash
   cp .env.example .env

- **Generar key en caso de ser necesario**:
   ```bash
   php artisan key:generate
  
- **Dentro del contenedor de PHP, ejecutar las migraciones**:
   ```bash
   php artisan migrate --seed
