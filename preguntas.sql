--En esta archivo se declara la consulta que se introducira en la query en la bd que se esta utilizando (en este caso MySQL)

--se crea una base de datos llamada trivia y la usamos por defecto
CREATE DATABASE trivia;
USE trivia;

--se crea la tabla de preguntas con las columnas requeridas
CREATE TABLE preguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pregunta TEXT NOT NULL,
    opcion1 VARCHAR(255) NOT NULL,
    opcion2 VARCHAR(255) NOT NULL,
    opcion3 VARCHAR(255) NOT NULL,
    opcion4 VARCHAR(255) NOT NULL,
    correcta INT NOT NULL
);

--se insertan las preguntas con las opciones de respuesta y el numero de la respuesta correcta 
INSERT INTO preguntas (pregunta, opcion1, opcion2, opcion3, opcion4, correcta)
VALUES
('¿Cuál es el planeta más cercano al Sol?', 'Venus', 'Mercurio', 'Tierra', 'Marte', 2),
('¿Quién escribió Don Quijote?', 'Miguel de Cervantes', 'Gabriel García Márquez', 'Pablo Neruda', 'Mario Vargas Llosa', 1),
('¿Cuál es el río más largo del mundo?', 'Nilo', 'Amazonas', 'Yangtsé', 'Misisipi', 2),
('¿En qué año llegó el hombre a la Luna?', '1965', '1969', '1975', '1980', 2),
('¿Cuál es la capital de Australia?', 'Sídney', 'Melbourne', 'Canberra', 'Brisbane', 3);

--se crea la tabla ranking donde estaran los usuarios y sus puntajes
CREATE TABLE ranking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    puntuacion INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);