# Gestión de Sacramentos - Iglesia de Sansare

<div align="center">
  
![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.1-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

</div>

## 📑 Contenido

- [Sobre el Proyecto](#-sobre-el-proyecto)
- [Características](#-características)
- [Estructura del Sistema](#-estructura-del-sistema)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)
- [Requisitos Previos](#-requisitos-previos)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Uso](#-uso)
- [API](#-api)
- [Seguridad](#-seguridad)
- [Contribuciones](#-contribuciones)
- [Licencia](#-licencia)
- [Contacto](#-contacto)

## 🌟 Sobre el Proyecto

Este sistema de gestión de sacramentos ha sido desarrollado para la Iglesia de Sansare con el propósito de digitalizar y optimizar el proceso de registro y seguimiento de los sacramentos católicos. Permite a los administradores de la parroquia realizar un seguimiento detallado de los feligreses y los sacramentos que han recibido, así como generar reportes y certificados oficiales.

El proyecto surge como una respuesta a la necesidad de modernizar los procesos administrativos de la iglesia, reemplazando el sistema tradicional de registro en libros físicos por una plataforma digital segura, eficiente y fácil de usar.

## ✨ Características

### Gestión de Sacramentos

El sistema permite gestionar los siguientes sacramentos:

- **Bautizo**: 
  - Registro completo de información de bautizados
  - Datos de padres y padrinos
  - Generación de certificados de bautismo
  - Búsqueda y filtrado por fechas, nombres, etc.

- **Primera Comunión**:
  - Control de niños que han recibido su primera comunión
  - Registro de fechas, parroquia y ministro celebrante
  - Emisión de constancias de primera comunión
  - Reportes estadísticos

- **Confirmación**:
  - Seguimiento de personas que han recibido el sacramento
  - Registro de padrinos y datos completos del confirmado
  - Generación de certificados oficiales
  - Búsqueda avanzada

- **Matrimonio**:
  - Gestión de matrimonios celebrados en la iglesia
  - Registro de contrayentes, testigos y datos ceremoniales
  - Emisión de actas matrimoniales
  - Historial completo de matrimonios

### Otras Funcionalidades

- **Gestión de Personas**: Base de datos centralizada de feligreses con su historial sacramental completo
- **Panel de Administración**: Interfaz intuitiva para la gestión diaria
- **Sistema de Usuarios**: Control de acceso con diferentes niveles de permisos
- **Generación de Reportes**: Informes en PDF para diferentes propósitos administrativos
- **Respaldo de Datos**: Funcionalidad para respaldar la información crítica
- **Notificaciones**: Sistema de alertas para eventos importantes

## 🏗 Estructura del Sistema

El sistema está organizado en módulos que corresponden a cada sacramento y funcionalidades adicionales:

```
app/
├── Models/               # Modelos de datos (Bautizo, Confirmacion, etc.)
├── Http/Controllers/     # Controladores para cada funcionalidad
├── Notifications/        # Sistema de notificaciones
resources/
├── views/                # Plantillas de la interfaz de usuario
│   ├── bautizos/         # Vistas para gestión de bautizos
│   ├── comuniones/       # Vistas para primera comunión
│   ├── confirmaciones/   # Vistas para confirmaciones
│   ├── casamientos/      # Vistas para matrimonios
│   └── personas/         # Vistas para gestión de personas
```

## 🔧 Tecnologías Utilizadas

- **Framework Backend**: Laravel 10.x
- **Lenguaje**: PHP 8.1
- **Base de Datos**: MySQL
- **Frontend**: Blade, HTML5, CSS3, JavaScript
- **Generación de PDF**: DomPDF
- **Autenticación**: Laravel Sanctum
- **Validación de Datos**: Laravel Validator
- **Herramientas Adicionales**: 
  - Jenssegers/Date para manejo de fechas
  - Laravel Mix para la compilación de assets
  - Vite para el entorno de desarrollo

## 📋 Requisitos Previos

Para instalar y ejecutar este proyecto, necesitarás:

- PHP 8.1 o superior
- Composer
- Node.js y NPM
- MySQL o MariaDB
- Servidor web (Apache, Nginx, etc.)
- Git (para clonar el repositorio)

## 💻 Instalación

Sigue estos pasos para instalar el proyecto:

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/iglesia-sansare-web.git
   cd iglesia-sansare-web
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de JavaScript**
   ```bash
   npm install
   ```

4. **Compilar assets**
   ```bash
   npm run build
   ```

5. **Configurar el entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

## ⚙️ Configuración

1. **Configurar la base de datos**
   - Edita el archivo `.env` con los datos de tu conexión:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_de_tu_base_de_datos
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

2. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

3. **Ejecutar seeders (opcional, para datos de prueba)**
   ```bash
   php artisan db:seed
   ```

## 🚀 Uso

Para iniciar el servidor de desarrollo:

```bash
php artisan serve
```

Accede a la aplicación a través de `http://localhost:8000` en tu navegador.

### Acceso al sistema

1. Ingresa con las credenciales de administrador:
   - Email: admin@ejemplo.com
   - Contraseña: password

2. Desde el panel principal, accede a las diferentes secciones:
   - Gestión de Bautizos
   - Registro de Primeras Comuniones
   - Control de Confirmaciones
   - Administración de Matrimonios
   - Registro de Personas

### Flujo de trabajo típico

1. Registrar nueva persona en el sistema
2. Asociar sacramentos a la persona según se vayan realizando
3. Generar certificados o constancias cuando sea necesario
4. Realizar búsquedas o consultas según necesidades administrativas

## 📡 API

El sistema cuenta con endpoints API para integración con otras aplicaciones:

- `GET /api/personas`: Obtiene lista de personas registradas
- `GET /api/sacramentos/{tipo}/{id}`: Obtiene detalles de un sacramento específico
- `POST /api/certificados/generar`: Genera certificados en formato PDF

Para más detalles sobre la API, consulta la documentación completa en `/docs/api`.

## 🔒 Seguridad

El sistema implementa las siguientes medidas de seguridad:

- Autenticación segura con Laravel Sanctum
- Protección CSRF en todos los formularios
- Validación de datos en servidor y cliente
- Políticas de autorización para control de acceso
- Encriptación de datos sensibles
- Protección contra ataques comunes (XSS, CSRF, SQL Injection)

## 🤝 Contribuciones

Las contribuciones son bienvenidas y apreciadas. Para contribuir:

1. Haz un fork del proyecto
2. Crea una rama para tu característica (`git checkout -b feature/AmazingFeature`)
3. Realiza tus cambios y haz commit (`git commit -m 'Add some AmazingFeature'`)
4. Sube tus cambios (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

Por favor, asegúrate de actualizar las pruebas según corresponda y seguir el estilo de código del proyecto.

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 📞 Contacto

Nombre del Desarrollador - [tu-email@ejemplo.com](mailto:tu-email@ejemplo.com)

Link del Proyecto: [https://github.com/tu-usuario/iglesia-sansare-web](https://github.com/tu-usuario/iglesia-sansare-web)

---

<div align="center">
  <p>Desarrollado con ❤️ para la Iglesia Católica de Sansare</p>
</div>

