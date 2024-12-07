<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Salud y Bienestar</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            margin: 0;
            background-image: url('imagen.png'); /* Imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .content-overlay {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            background: rgba(0, 0, 0, 0.5); /* Fondo oscuro semitransparente */
            padding: 20px;
        }

        .container {
            color: #000;
            border-radius: 10px;
            padding: 20px;
            max-width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #2980B9;
            border-color: #2980B9;
        }

        .btn-primary:hover {
            background-color: #1A5276;
            border-color: #1A5276;
        }

        .bg-section {
            margin-top: 20px;
            padding: 30px;
            background: rgba(44, 62, 80, 0.8); /* Fondo oscuro */
            color: #fff;
            border-radius: 8px;
        }

        .bg-section h1 {
            font-size: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
  <!-- Menú de navegación -->
  <?php require_once 'menu.php'; ?>

    <div class="content-overlay">
        <!-- Sección principal con la información de la empresa -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>BIENVENIDOS A NUESTROS SITIO</h1>
            </div>

            <!-- Información sobre la empresa -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <h2 class="section-title">Sobre nosotros</h2>
                    <p>En nuestra empresa, nos dedicamos a proporcionar los mejores servicios y productos para que disfrutes de una experiencia única. Contamos con un equipo altamente calificado y comprometido con la calidad.</p>
                    <p>Ofrecemos diversas opciones de membresía, clases con instructores altamente capacitados y entrenadores especializados que te ayudarán a alcanzar tus objetivos.</p>
                </div>
                <div class="col-md-6">
                    <h3 class="section-title">Nuestros valores</h3>
                    <ul>
                        <li>Compromiso con la calidad</li>
                        <li>Atención personalizada</li>
                        <li>Innovación constante</li>
                        <li>Trabajo en equipo</li>
                        <li>Respeto y confianza</li>
                    </ul>
                </div>
            </div>

            <!-- Llamado a la acción -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <p>Únete hoy mismo a nuestra comunidad y empieza tu viaje hacia <br>
                     un estilo de vida más saludable y activo. 
                     <br>¡Estamos aquí para apoyarte!</p>
                    <a href="membresias.php" class="btn btn-primary">Descubre nuestras Membresías</a>
                </div>
            </div>
        </div>

        <!-- Sección con fondo atractivo -->
        <div class="bg-section text-center">
            <h1>¡Haz ejercicio con nosotros!</h1>
            <p>Transforma tu cuerpo y mente con nuestros servicios.</p>
        </div>
    </div>
</body>
</html>
