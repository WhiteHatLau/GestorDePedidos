CREATE DATABASE `clientes`;
USE clientes;


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `primer_apellido` varchar(255) DEFAULT NULL,
  `segundo_apellido` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `cod_postal` int(11) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `articulo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `fecha_anadido` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- ALTER TABLE `usuarios` 
-- ADD COLUMN `nota` varchar(500) DEFAULT NULL;


-- INSERTAR DATOS DE PRUEBA

INSERT INTO `usuarios` (`id`, `proveedor`, `nombre`, `primer_apellido`, `segundo_apellido`, `telefono`, `cod_postal`, `direccion`, `articulo`, `email`, `fecha_anadido`) VALUES
(1, 'Gadis', 'Lau', 'Díaz', 'Méndez', '666999888', 45674, 'Vv', 'Café', 'hola@gmail.com', '2024-10-25');

