## **Instrucciones para ejecutar el proyecto localmente**

### **Requisitos previos**

• **Instalar XAMPP**: XAMPP es necesario para poder ejecutar el servidor Apache y trabajar con bases de datos MySQL. Coloca el proyecto en la carpeta de `C:\xampp\htdocs\trivia-aventura`.  
  [Link de descarga](https://www.apachefriends.org/es/index.html)

• **Instalar Visual Studio Code**: Usado para codificar en PHP, HTML y CSS para el desarrollo de la lógica y estructura visual del proyecto.

• **Instalar MySQL**: Debes tener MySQL nativo instalado en tu ordenador para almacenar los datos de las preguntas, respuestas y el ranking de jugadores.

### **Ejecución del proyecto**

1. **Descargar el código del proyecto**  
   Descarga el archivo del proyecto desde el repositorio o fuente proporcionada.

2. **Colocar el proyecto en la carpeta de XAMPP**  
   Copia la carpeta del proyecto en el directorio `htdocs` de XAMPP:  
   **En Windows**: `C:\xampp\htdocs\nombreDeCarpetaProyecto`

3. **Configuración de la base de datos MySQL**  
   - Configura los datos de acceso a la base de datos (usuario, contraseña, puerto y host) en el archivo `db.php`.
   - Después en la base de datos abrimos la pestaña llamada Query y ejecutamos todo el código sql que tenemos en el archivo de preguntas.sql (este archivo está en el proyecto), este archivo contiene todo para poder crear el database llamado trivia, la tabla de preguntas, columnas y la inserción de datos sobre las preguntas y sus respuestas.
   - Hay que tener en cuenta en el archivo db.php, en donde definimos los datos y credenciales de acceso a la base de datos, coincidan con los datos de la configuración local, en este caso estamos utilizando para la práctica MySQL nativo.

Hay q configurar muy bien esta parte para poder tener una conexión exitosa con la BD. (Si se utiliza otra bd diferente, se define los datos en esta parte)


4. **Iniciar Apache**  
   - Abre el **Panel de Control de XAMPP**.
   - Haz clic en **Start** para iniciar el servicio de Apache.

5. **Acceder al proyecto en el navegador**  
   Abre tu navegador y escribe la URL:  
   `http://localhost/trivia-aventura/sesion.php`

   Esto cargará la página de inicio de tu proyecto.

### **Archivos del proyecto**

- **css/**: Contiene los archivos CSS para el diseño visual de las páginas.
- **db.php**: Archivo PHP que gestiona la conexión a la base de datos MySQL.
- **sesion.php**: Página de inicio donde los usuarios ingresan su nombre para comenzar el juego.
- **juego.php**: Muestra las preguntas y gestiona la lógica del juego.
- **resultado.php**: Muestra los resultados finales del juego.
- **reiniciar.php**: Destruye la sesión del usuario y reinicia el progreso del juego.

### **Librería instalada**

El comando composer require vlucas/phpdotenv se utiliza para instalar la librería phpdotenv desarrollada por vlucas. Esta librería permite gestionar variables de entorno en proyectos PHP utilizando un archivo.env.

### **Estructura en carpetas**

```plaintext
css/             # Archivos CSS para el diseño visual
includes/        # Archivos PHP reutilizables como db.php
controllers/     # Lógica del juego (juego, preguntas, resultados)
