CREATE DATABASE tecnoweb;


USE tecnoweb;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla membresias
CREATE TABLE membresias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,          -- Nombre de la membresía
    descripcion TEXT,                      -- Descripción completa
    precio DECIMAL(10, 2) NOT NULL,        -- Precio de la membresía
    duracion INT NOT NULL,                 -- Duración en días
    accesos_incluidos TEXT,                -- Accesos incluidos (lista o descripción)
    accesos_no_incluidos TEXT              -- Accesos no incluidos (lista o descripción)
);
-- Tabla horarios
CREATE TABLE horarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dia VARCHAR (50) NOT NULL,
    ejercicio VARCHAR(100) NOT NULL,       -- Tipo de ejercicio (por ejemplo, Yoga, Pesas)
    hora_inicio TIME NOT NULL,             -- Hora de inicio
    hora_fin TIME NOT NULL                 -- Hora de fin
);
-- Tabla entrenadores
CREATE TABLE entrenadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,          -- Nombre completo del entrenador
    especialidad VARCHAR(100) NOT NULL,    -- Especialidad (por ejemplo, Cardio, Yoga)
    experiencia TEXT                       -- Experiencia detallada del entrenador
);

-- tabla pagos
CREATE TABLE pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- ID único del pago
    user_id INT NOT NULL,                       -- Usuario que realiza el pago
    membresia_id INT NOT NULL,                  -- Membresía asociada al pago
    monto DECIMAL(10, 2) NOT NULL,              -- Monto pagado
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora del pago
    metodo_pago ENUM('Efectivo', 'Tarjeta', 'Transferencia', 'Otros') NOT NULL, -- Método de pago
    estado ENUM('Pendiente', 'Completado', 'Cancelado') DEFAULT 'Completado', -- Estado del pago
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE, -- Relación con usuarios
    FOREIGN KEY (membresia_id) REFERENCES membresias(id) ON DELETE CASCADE -- Relación con membresías
);
