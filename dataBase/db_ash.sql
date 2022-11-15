-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2022 a las 00:41:02
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_ash`
--
CREATE DATABASE IF NOT EXISTS `db_ash` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_ash`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `brand` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `type`, `brand`) VALUES
(1, 'remeras', 'Adidas'),
(2, 'remeras', 'Nike'),
(3, 'remeras', 'TuEstampado'),
(4, 'buzos', 'Adidas'),
(5, 'buzos', 'TuEstampado'),
(6, 'buzos', 'Nike'),
(7, 'camperas', 'Adidas'),
(8, 'camperas', 'Montages');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `score` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `author` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `comment`, `score`, `id_product`, `author`) VALUES
(1, 'Buenisima la campera, es original.', 5, 1010, 'fede'),
(27, 'Buenisima la remera, muy buena calidad', 5, 1000, 'zoe'),
(29, 'Me gusto, aunque podria ser mejor calidad.', 4, 1010, 'zoe'),
(31, 'Tremenda campera, me la compre porque ahora me voy de viaje a qatar', 5, 1010, 'rappa'),
(32, 'Buena remera, el talle me quedo un poco grande', 3, 1000, 'rappa'),
(33, 'Muy buena, volveria a comprar, exelete atencion', 5, 1000, 'admin'),
(34, 'Esta campera es tremenda, no me la saco ni para dormir', 5, 1010, 'admin'),
(35, 'Buenisima, exelente calidad', 5, 1004, 'admin'),
(37, 'Mala calidad', 1, 1000, 'fede'),
(38, 'Buenisimo re calentito y comodo', 5, 1006, 'fede');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_types` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `stock`, `id_types`) VALUES
(1000, 'Remera Carita', '100% algodon, maxima calidad', 'img-products/carita.png', 3199, 11, 3),
(1001, 'Remera Pug', '100 % algodón ideal para cualquier tipo de uso.', 'img-products/pug.png', 3300, 1, 3),
(1002, 'Remera Cielo', '100 % algodón ideal para cualquier tipo de uso.', 'img-products/cielo.png', 3200, 5, 3),
(1003, 'Remera Mario', '100 % algodón ideal para cualquier tipo de uso.', 'img-products/mario.png', 3500, 8, 3),
(1004, 'Buzo Mono', '100% algodón ideal para el dia a dia, super abrigados.', 'img-products/b_mono.png', 5400, 6, 5),
(1005, 'Buzo Carita', '100% algodón ideal para el dia a dia, super abrigados.', 'img-products/b_carita.png', 5600, 12, 5),
(1006, 'Buzo Silvestre', '100% algodón ideal para el dia a dia, super abrigados.', 'img-products/b_silvestre.png', 4500, 5, 5),
(1007, 'Buzo Arcade', '100% algodón ideal para el dia a dia, super abrigados.', 'img-products/b_arcade.png', 5600, 5, 5),
(1008, 'Campera Escalada', 'Super resistente y abrigada. 100% impermeable.', 'img-products/c_escalada.png', 12300, 1, 8),
(1009, 'Campera Deportiva', 'Super resistente y abrigada. 100% impermeable.', 'img-products/c_deporte.png', 14900, 16, 8),
(1010, 'Campera Seleccion Argentina', 'Para alentar a la seleccion en Qatar, no te la vas a querer sacar nunca.', 'img-products/c_seleccion.png', 13500, 32, 7),
(1011, 'Buzo Adidas Pomelo', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_pomelo.png', 8900, 1, 4),
(1012, 'Buzo Adidas Classic', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_adidasClassic.png', 13200, 23, 4),
(1013, 'Buzo Adidas Original', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_adidasOriginal.png', 10200, 14, 4),
(1014, 'Buzo Adidas Training', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_training.png', 13200, 19, 4),
(1015, 'Buzo Nike Jordan', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_jordan.png', 11400, 14, 6),
(1016, 'Buzo Nike Just Do It', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_justDoIt.png', 9600, 6, 6),
(1017, 'Buzo Nike Air', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_nikeAir.png', 7900, 15, 6),
(1018, 'Buzo Nike Running', '100% algodón ideal para el dia a dia. Super comodo.', 'img-products/b_nikeRunning.png', 9900, 22, 6),
(1019, 'Remera Nike Tomate', 'Excelente para usarla todos los dias y estar vestido con estilo.', 'img-products/nike_tomate.png', 5600, 14, 2),
(1020, 'Remera Nike Rombo', 'Excelente para usarla todos los dias y estar vestido con estilo.', 'img-products/nike_rombo.png', 4500, 7, 2),
(1021, 'Remera Nike FC', 'Excelente para usarla todos los dias y estar vestido con estilo.', 'img-products/nike_fc.png', 5400, 14, 2),
(1022, 'Remera Nike Classic', 'Excelente para usarla todos los dias y estar vestido con estilo.', 'img-products/nike_classic.png', 6500, 13, 2),
(1023, 'Remera Adidas Pelotitas', 'Excelente para usarla todos los dias o entrenar y estar vestido con estilo.', 'img-products/adidas_pelotita.png', 5700, 15, 1),
(1024, 'Remera Adidas en Movimiento', 'Excelente para usarla todos los dias y estar vestido con estilo.', 'img-products/adidas_movimiento.png', 5400, 12, 1),
(1026, 'Remera Adidas Entrenamiento', 'Excelente para usarla todos los dias y estar vestido con estilo.', 'img-products/adidas_militar.png', 5300, 6, 1),
(1027, 'Remera Adidas Mel', 'Excelente para usarla todos los dias y estar vestido con estilo.', 'img-products/adidas_mel.png', 4300, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `userName` varchar(15) NOT NULL,
  `password` varchar(300) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `userName`, `password`, `admin`) VALUES
(1, 'Agustin', 'Gonzalorena', 'admin', '$2a$12$FHerOlkuEPQnEQvNTTv70eRyCo6ZFdXpqOztHt9qR1r9gdVGUwto.', 1),
(3, 'Fede', 'Novelli', 'fede', '$2y$10$pQOzVi9ML4Fy6YDRac1i6.o4R9rxJdv.cTiRktVDgWWA8KkZoBfza', 0),
(34, 'Francisco', 'Rappazzini', 'rappa', '$2y$10$pQOzVi9ML4Fy6YDRac1i6.o4R9rxJdv.cTiRktVDgWWA8KkZoBfza', 1),
(40, 'Zoé', 'Casabone', 'zoe', '$2y$10$pQOzVi9ML4Fy6YDRac1i6.o4R9rxJdv.cTiRktVDgWWA8KkZoBfza', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `author` (`author`),
  ADD KEY `author_2` (`author`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`id_types`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100012;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_types`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
