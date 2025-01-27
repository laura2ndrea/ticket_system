# Sistema de gestión de tickets 

## Requisitos

- **PHP** 
- **Servidor Web** (como XAMPP, WAMP, o cualquier otro que soporte PHP)
- **Base de datos PostgreSQL** (puede usarse pgAdmin o cualquier otro cliente PostgreSQL)
- **PHP PDO Extension** (para conexión con PostgreSQL)

## Pasos para usar el sistema

### 1. Descargar el Proyecto

- Descarga el proyecto desde el repositorio o directamente desde tu fuente de código.

### 2. Crear la base de Datos

- Abre **pgAdmin** o el cliente de tu preferencia para gestionar tu base de datos.
- Crea una nueva base de datos llamada `ticket_system`.

### 3. Ejecutar el script SQL

- Dirígete a la carpeta del proyecto donde se encuentra el archivo `database.sql`.
- Abre el archivo y ejecuta el script SQL en tu base de datos recién creada (`ticket_system`).
  - Este script creará todas las tablas necesarias, incluidas las de `usuario`, `ticket`, `log`, y sus relaciones.

### 4. Configurar la conexión a la base de datos

- Navega a la carpeta `database` en tu proyecto.
- Abre el archivo `connection.php`.
- En este archivo, ajusta los parámetros de conexión a la base de datos según los siguientes parámetros:
  - **Host**: `localhost` o el servidor que uses.
  - **Nombre de la base de datos**: `ticket_system`.
  - **Usuario**: tu usuario de PostgreSQL (por ejemplo, `postgres`).
  - **Contraseña**: la contraseña de tu usuario PostgreSQL.

```php
<?php
$host = 'localhost'; 
$dbname = 'ticket_system'; 
$user = 'postgres'; 
$password = 'tu_contraseña'; 

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>
```

### 5. Accede al sistema

1. **Inicia el servidor web** (por ejemplo, XAMPP o WAMP).
2. **Accede al sistema** abriendo tu navegador web y dirigiéndote a la siguiente URL:

```
http://localhost/index.php
```
### Usuarios disponibles para login:

 **Administrador**:
- **Nick**: `admin`
- **Correo**: `admin@mail.com`
- **Contraseña**: `admin123`

 **Soporte**:
- **Nick**: `soporte`
- **Correo**: `soporte@mail.com`
- **Contraseña**: `soporte123`

 **Usuario Normal**:
- **Nick**: `usuario1`
- **Correo**: `usuario1@mail.com`
- **Contraseña**: `user123`

### Dependiendo del rol del usuario, se mostrará una vista diferente:

- **Administrador**:
- Tendrá acceso a gestionar los usuarios. 

- **Soporte**:
- El usuario con el rol de soporte podrá ver los tickets creados por otros usuarios y responder a esos tickets (no se implemento). 

- **Usuario**:
- Podrá crear nuevos tickets de soporte y visualizar los tickets que ha creado. 
