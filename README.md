# Sistema de Gestión de Proyectos

Este sistema permite gestionar proyectos y empleados, con seguimiento de cambios a través de un sistema de auditoría.

## Requisitos previos

- PHP 8.2 o superior
- Composer
- MySQL 5.7 o superior
- Symfony CLI

## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

### 1. Clonar el repositorio

```bash
git clone https://github.com/Darkot1/project-manager
cd project-manager
```

### 2. Instalar dependencias con Composer

```bash
composer install
```

### 3. Configuración de la base de datos

Crea un archivo `.env.local` en la raíz del proyecto de tomando como referencia el archivo `.env` y configura la URL de conexión a la base de datos MySQL:

```
DATABASE_URL="mysql://usuario:contraseña@127.0.0.1:3306/database?serverVersion=8.0.32&charset=utf8mb4
```

Reemplaza `usuario`, `contraseña` y `database` con tus credenciales de acceso a la base de datos.

### 4. Crear la base de datos

```bash
php bin/console doctrine:database:create
```

### 5. Ejecutar las migraciones

```bash
php bin/console doctrine:migrations:migrate
```

## Iniciar el servidor

### Usando Symfony CLI

```bash
symfony server:start
```

El sistema estará disponible en `http://127.0.0.1:8000`

## Características principales

- Gestión de proyectos
- Gestión de empleados
- Asignación de empleados a proyectos
- Sistema de auditoría para seguimiento de cambios
- Autenticación y registro de usuarios

## Estructura del sistema de auditoría

El sistema utiliza las extensiones de Doctrine (Gedmo) para implementar:

- **Timestampable**: Seguimiento automático de fechas de creación y actualización
- **Blameable**: Registro del usuario que creó o modificó un registro
- **Loggable**: Registro detallado de cambios en entidades

## Acceso al sistema

1. Regístrate como nuevo usuario
2. Inicia sesión con tus credenciales
3. Navega entre las secciones de Proyectos, Empleados y Auditoría
