-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-11-2023 a las 23:22:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_shoespot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `nombre_Usuario` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `nombre_Usuario`, `password`) VALUES
(1, 'webadmin', '$2y$10$CfqL3wkMaGivOE1Fiy7lEuo.AZZ/NxVygLz30kN2ht7XmMtYCJKgu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marcas` int(11) NOT NULL,
  `nombre_marca` varchar(45) NOT NULL,
  `fecha_creacion` varchar(45) DEFAULT NULL,
  `loc_fabrica` varchar(45) DEFAULT NULL,
  `url_imagen` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marcas`, `nombre_marca`, `fecha_creacion`, `loc_fabrica`, `url_imagen`) VALUES
(22, 'nike', '1987', 'España', 'https://content.asos-media.com/-/media/homepages/unisex/brands-logos/256x256/nike-hp-logos-256x256.jpg'),
(23, 'adidas', '1970', 'Alemania', 'https://cdn-icons-png.flaticon.com/256/731/731962.png'),
(24, 'vans', '1982', 'España', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-wo_4iwxWnSjcs-MljjbrtJ3NOIT27OyFa0Nsmq7WGfVQAQY5QO8o-5I-04fPrt8wo6o&usqp=CAU'),
(25, 'rebook', '1982', 'Argentina', 'https://logospng.org/download/reebok/logo-reebok-256.png'),
(26, 'puma', '1987', 'Argentina', 'https://logospng.org/download/puma/logo-puma-icon-256.png'),
(27, 'jimmy choo', '1986', 'Japón', 'https://d2q79iu7y748jz.cloudfront.net/s/_squarelogo/256x256/495de0f1168c9cbaa7553f6fa1eb222a'),
(28, 'new balance', '1997', 'Francia', 'https://planetabasketstore.com/images/companies/1/teste/Brands%20logo/text%20logo/New_Balance_Black_Logo_256.png?1596622716491'),
(36, 'topper', '1987', 'Argentina', 'http://nuevamutualcamioneros.com/wp-content/uploads/2019/08/topper.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(45) DEFAULT NULL,
  `color` varchar(45) NOT NULL,
  `talle` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `precio` double NOT NULL,
  `url_imagenP` varchar(500) DEFAULT NULL,
  `id_marca_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_producto`, `color`, `talle`, `tipo`, `precio`, `url_imagenP`, `id_marca_fk`) VALUES
(21, 'Zapatillas', 'rojo', 39, 'urbana', 43000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzzKtEWGIrbvP6Yf0woBkxacdQbjyXH3ZYOg&usqp=CAU', 26),
(22, 'Zapatillas', 'rojo', 45, 'Deportivas', 32000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4fawK8wsXtQDoifzDrX2rbxK_F9sB_H4GDA&usqp=CAU', 26),
(23, 'zapatos', 'blanco', 38, 'formal', 56000, 'https://img.eobuwie.cloud/eob_product_256w_256h(8/7/a/7/87a752ab0d5e2bb39c8c2ffeed801d4843812fc0_01_5904862690506_RW.jpg,jpg)/tacon-de-aguja-deezee-kl-q2277-6-golden.jpg', 27),
(30, 'Zapatillas', 'negro', 45, 'Deportivas', 32000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4fawK8wsXtQDoifzDrX2rbxK_F9sB_H4GDA&usqp=CAU', 26);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD KEY `id_marcas` (`id_marcas`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca_fk` (`id_marca_fk`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marcas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca_fk`) REFERENCES `marcas` (`id_marcas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
