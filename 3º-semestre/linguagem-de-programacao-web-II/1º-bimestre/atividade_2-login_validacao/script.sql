CREATE DATABASE login_app;

USE login_app;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255)
)

SELECT * FROM usuarios;

INSERT INTO usuarios(id, email, senha) VALUES
(1, 'usuario1@email.com', 'usuario1'),
(2, 'usuario2@email.com', 'usuario2'),
(3, 'usuario3@email.com', 'usuario3'),
(4, 'usuario4@email.com', 'usuario4'),
(5, 'usuario5@email.com', 'usuario5'),
(6, 'usuario6@email.com', 'usuario6'),
(7, 'usuario7@email.com', 'usuario7'),
(8, 'usuario8@email.com', 'usuario8'),
(9, 'usuario9@email.com', 'usuario9'),
(10, 'usuario10@email.com', 'usuario10');