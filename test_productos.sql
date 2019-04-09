
create schema test_tienda;
use test_tienda;
--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `producto` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `precio` float(10) NOT NULL,
  `proveedor` varchar(30) NOT NULL,
  `stock` int NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


  CREATE TABLE `usuario` (
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `rol` varchar(3) NOT NULL,
  
  PRIMARY KEY (nombre)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `producto` (`codigo`, `titulo`,`descripcion`, `foto`, `precio`, `proveedor`, `stock`, `estado`) VALUES
('12508', 'Camisa Armani','Camisa escocesa Talle M. Marca: Armani. Color: blanco','camisa-dibujo.jpg', 1000, 'ABC Prendas', 20, 'A'),
('12507', 'Camisa', 'Camisa Lisa Talle M.', 'camisa1.jpg', 500, 'ABC Prendas', 20, 'I'),
('12509', 'Jean', 'Jean Talle 42. Marca: Levis. Color: jean', 'jean.jpg', 2000, 'Levprov', 10, 'A');


delete from usuario;
update usuario set rol = 'A' where nombre = 'admin';