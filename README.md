# JMSync

JMSync es una aplicación web moderna construida en **Laravel 11** que funciona como el sucesor directo del antiguo tema de WordPress "Nexus". Ha sido reescrita desde cero utilizando un stack moderno para ofrecer el mejor rendimiento y la mejor experiencia de usuario.

## 🚀 Tecnologías y Stack

- **Backend:** Laravel 11
- **Frontend Público:** Inertia.js con Vue 3 (conservando el CSS original y los activos del tema Nexus)
- **Panel de Administración:** Filament PHP v3
- **Base de Datos:** MySQL / MariaDB
- **Build System:** Vite

## 🛠️ Requisitos del Servidor

Para implementar esta aplicación en un servidor de producción, asegúrate de cumplir con los siguientes requisitos:

- **PHP** >= 8.3
- Extensiones PHP: Ctype, cURL, DOM, Fileinfo, Filter, Hash, Mbstring, OpenSSL, PCRE, PDO, Session, Tokenizer, XML, GD/Imagick.
- **Composer** (para gestionar dependencias de PHP)
- **Node.js** y **NPM** (para compilar los activos del frontend)
- Servidor Web (**Nginx** o **Apache**)
- **MySQL** >= 8.0 o **MariaDB** >= 10.3

## 📦 Instrucciones de Implementación (Deployment)

Sigue estos pasos en tu servidor para realizar el despliegue del proyecto:

### 1. Clonar el repositorio
```bash
git clone https://github.com/progsevenrockradio-bot/jmsync.git
cd jmsync
```

### 2. Instalar dependencias de PHP
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Configurar el entorno
Copia el archivo de configuración de ejemplo y genera una nueva clave de aplicación:
```bash
cp .env.example .env
php artisan key:generate
```
Abre el archivo `.env` y configura los datos de tu base de datos y la URL del sitio:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Migraciones y Seeders (Base de datos)
Ejecuta las migraciones para crear las tablas y poblar la base de datos con los datos iniciales y el usuario administrador:
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Instalar dependencias de Node.js y compilar activos
```bash
npm install
npm run build
```

### 6. Optimización de Laravel
Para mejorar el rendimiento en producción, ejecuta los comandos de caché:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan filament:cache-components
```

### 7. Enlaces de almacenamiento
Para que las imágenes subidas desde el panel de administración sean públicas, debes enlazar la carpeta de almacenamiento:
```bash
php artisan storage:link
```

### 8. Permisos de carpetas (Linux/Unix)
Asegúrate de que tu servidor web (por ejemplo, `www-data` en Nginx/Apache) tenga permisos de escritura en las carpetas `storage` y `bootstrap/cache`:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 🔐 Acceso al Panel de Administración

Puedes acceder al panel de administración añadiendo `/admin` a tu dominio (ej. `https://tudominio.com/admin`).

Para iniciar sesión por primera vez, puedes utilizar las credenciales generadas por el seeder (o crear un nuevo usuario Filament mediante consola si es necesario).

---
**Desarrollado con ❤️ usando Laravel e Inertia.**
