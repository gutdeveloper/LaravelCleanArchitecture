# Laravel Clean Architecture

Este proyecto implementa una API siguiendo los principios de Clean Architecture y SOLID.

## Requisitos

- PHP 8.1 o superior
- Composer
- PostgreSQL
- Docker (opcional)

## Instalación

1. **Clonar el repositorio**
    ```bash
    git clone <repository-url>
    cd LaravelCleanArchitecture
    ```

2. **Base de datos**
   
   **Opción A**: Usando Docker
    ```bash
    docker-compose up -d
    ```
   
   **Opción B**: Usando PostgreSQL local
   - Asegúrate de tener PostgreSQL instalado y configurado

3. **Instalar dependencias**
    ```bash
    composer install
    ```

4. **Configurar entorno**
    ```bash
    cp .env.example .env
    ```
    Editar el archivo .env con la configuración adecuada:
    ```
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_password
    ```

5. **Generar claves**
    ```bash
    php artisan key:generate
    php artisan jwt:secret
    ```

6. **Ejecutar migraciones**
    ```bash
    php artisan migrate
    ```

7. **Iniciar servidor de desarrollo (opcional)**
    ```bash
    php artisan serve
    ```

## Arquitectura

Este proyecto implementa Clean Architecture con una clara separación en capas:

- **Domain**: Entidades, interfaces, objetos de valor y reglas de negocio
- **Application**: Casos de uso y DTOs
- **Infrastructure**: Implementaciones concretas (controladores, repositorios, servicios)

Para más detalles sobre la arquitectura, consulta el archivo [ARCHITECTURE.md](ARCHITECTURE.md).

## Características

- Registro y login de usuarios
- Manejo de excepciones personalizadas con respuestas JSON
- Validación en múltiples niveles (HTTP y dominio)
- Uso de DTOs para transferencia de datos entre capas
- Implementación de patrones Repository, Factory y Value Objects



