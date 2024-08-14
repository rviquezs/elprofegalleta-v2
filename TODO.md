# Kevin: Autenticación y Gestión de Usuario

* **Header/Dropdown Menu Btn:**
  
  * [ ] (1.1) Mostrar la foto de perfil si el usuario está loggeado; de lo contrario, mostrar un ícono de usuario. (Bootstrap, JS, PHP)
  * [ ] (1.2) Si no está loggeado, mostrar el formulario de inicio de sesión; si está loggeado, mostrar un submenú con Configuración y Cerrar sesión. (JS, Bootstrap)
  * [ ] (1.4) Cerrar sesión debe cerrar la sesión del usuario. (PHP)

* **Header/Dropdown Menu/Form:**
  
  * [ ] (2.5) Verificar usuario y contraseña con el botón de inicio de sesión. (PHP, Slim, SQL)

* **Templates/Recover Password:**
  
  * [ ] (5.1) Crear un formulario para recuperar la contraseña (generar una nueva aleatoriamente y enviarla al correo del usuario). (Bootstrap, PHP, Slim)

* **Templates/Signup:**
  
  * [ ] (4.3) Hacer que el botón de registro guarde la información del formulario en la base de datos. (Slim, PHP)

* **Templates/UserDashboard:**
  
  * [ ] (14.1) Asegurarse de que el UserDashboard solo sea accesible si el usuario ha iniciado sesión correctamente. (PHP)
  * [ ] (14.2) Menú de Gestión de Inscripciones: En este submenú, el usuario podrá ver y eliminar sus inscripciones. (PHP, JS, HTML)
  * [ ] (14.3) Actualizar datos: En este submenú, el usuario podrá actualizar los datos de su cuenta (excepto el nombre de usuario). (PHP, JS, HTML)

# Victoria: Interacción Dinámica y Visualización de Datos

* **Crear la base de datos:**
  
  * [ ] Definir y crear las tablas necesarias (usuarios, cursos, inscripciones, etc.) en la base de datos. (SQL)

* **Templates/Index:**
  
  * [ ] (6.2) Hacer que la sección de noticias sea contenido dinámico mediante AJAX con información de la base de datos. (JS AJAX, Slim PHP)

* **Templates/Porque Elegirnos:**
  
  * [ ] (7.1) Las tarjetas de testimonios deben ser generadas dinámicamente mediante AJAX con información de la base de datos. (Slim/PHP, JS AJAX)

* **Templates/Oferta Académica:**
  
  * [ ] (8.1) Las tarjetas de curso deben ser generadas dinámicamente mediante AJAX con información de la base de datos. (Slim/PHP, JS AJAX)
  * [ ] (8.2) Cambiar el href de Ver Más para los cursos a oferta_academica/detalle_curso. (HTML)

* **Templates/Oferta Académica/Detalles Curso:**
  
  * [ ] (9.1) Incluir una galería con 3 imágenes relacionadas con el curso (SVG o enlace a imagen guardada como cadena). (HTML, JS)
  * [ ] (9.9) Código QR con enlace al curso. (JS, HTML)

* **Templates/Servicios:**
  
  * [x] (10.1) Añadir imágenes de los servicios a las tarjetas. (Bootstrap)

* **Templates/Servicios/Detalles:**
  
  * [x] (11.1) Añadir imágenes al detalle de cada servicio. (Bootstrap)
  * [x] (11.2) Arreglar CSS.

# Robert: Formularios y Envío de Datos / Gestión y Administración

**Templates/Contacto:**

* [x] (12.2) El formulario de contacto debe enviar un correo a una dirección válida. (API de Resend, JS, HTML)
* [x] (12.1) Añadir un pin al mapa con una ubicación ficticia (encontrar una API de mapa). (JS, HTML)
* [x] (12.3) Arreglar CSS (Contacto)

**Templates/Signup:**

* [ ] (4.1) Revisar estilos del encabezado. (CSS)
* [x] (4.2) Añadir campos para información: (Bootstrap)

**Templates/AdminDashboard:**

- [x] (13.1) Añadir una sección para la gestión de cursos (guardar, actualizar y eliminar desde la base de datos). (PHP, Slim)

- [x] (13.2) Crear un reporte de todos los cursos en la base de datos. (PHP, Slim)

- [x] (13.3) Permitir filtrar por categoría en el dashboard de administración. (PHP, Slim, JS)

- [x] (13.4) Exportar informes a PDF (encontrar una biblioteca PHP/JS para esto, revisar API de ILovePDF?). (PHP, Slim)
