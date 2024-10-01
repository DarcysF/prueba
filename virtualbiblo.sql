-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2024 a las 15:39:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `virtualbiblo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authbooks`
--

CREATE TABLE `authbooks` (
  `id_authbook` int(11) NOT NULL,
  `id_book_authbook` int(11) NOT NULL,
  `id_author_authbook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `authors`
--

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `name_author` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `authors`
--

INSERT INTO `authors` (`id_author`, `name_author`) VALUES
(1, 'Gabriel García Márquez'),
(2, 'Miguel de Cervantes'),
(3, 'Candelario Obeso'),
(4, 'Rafael Pombo'),
(5, 'Jose Eustasio Rivera'),
(6, 'Jorge Isaacs'),
(7, 'Antonio Caballero'),
(8, 'Andres Caicedo'),
(9, 'Rafael Chaparro'),
(10, 'Laura Restrepo'),
(11, 'Hector Abad Faciolince'),
(12, 'William Ospina'),
(13, 'Piedad Bonnett'),
(14, 'Juan Gabriel Vasquez'),
(15, 'Emma Reyes'),
(16, 'Luis Fayad'),
(17, 'Santiago Gamboa'),
(18, 'Pilar Quintana'),
(19, 'Fernando Vallejo'),
(20, 'Pablo Montoya'),
(21, 'Angela Becerra'),
(22, 'Mario Mendoza'),
(23, 'Fernando Molano Vargas'),
(24, 'Alfredo Molano Bravo'),
(25, 'Antonio Ungar'),
(26, 'Melba Escobar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id_book` int(11) NOT NULL,
  `imagen_book` varchar(50) NOT NULL,
  `name_book` varchar(100) NOT NULL,
  `price_book` int(11) NOT NULL,
  `amount_book` int(11) NOT NULL,
  `description_book` varchar(900) NOT NULL,
  `year_book` date NOT NULL,
  `state_book` int(2) NOT NULL,
  `rate_book` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id_book`, `imagen_book`, `name_book`, `price_book`, `amount_book`, `description_book`, `year_book`, `state_book`, `rate_book`) VALUES
(1, '../../assets/imagenes/portada2.png', 'Ejemplo 1', 50000, 20, 'Ejemplo 1', '2023-10-06', 1, 0),
(3, '../../assets/imagenes/libroejemplo.png', 'ejemplo 2', 202, 2, 'ejemplo 2', '2023-10-14', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exemplarys`
--

CREATE TABLE `exemplarys` (
  `id_exemplary` int(11) NOT NULL,
  `name_exemplary` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorites`
--

CREATE TABLE `favorites` (
  `id_book_favorite` int(11) NOT NULL,
  `id_user_favorite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generbooks`
--

CREATE TABLE `generbooks` (
  `id_gender_book` int(11) NOT NULL,
  `id_book_generbook` int(11) NOT NULL,
  `id_gener_generbook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `geners`
--

CREATE TABLE `geners` (
  `id_gener` int(11) NOT NULL,
  `name_gener` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `geners`
--

INSERT INTO `geners` (`id_gener`, `name_gener`) VALUES
(1, 'Acción'),
(2, 'Aventuras'),
(3, 'Comedia'),
(4, 'Drama'),
(5, 'Ciencia Ficción'),
(6, 'Fantasía'),
(7, 'Terror'),
(8, 'Misterio'),
(9, 'Romance'),
(10, 'Crimen'),
(11, 'Musical'),
(12, 'Western'),
(13, 'Animación'),
(14, 'Superhéroes'),
(15, 'Guerra'),
(16, 'Biográfica'),
(17, 'Documental'),
(18, 'Deportes'),
(19, 'Fantasía Científica (Sci-Fi)'),
(20, 'Mockumentary');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

CREATE TABLE `languages` (
  `id_lenguage` int(11) NOT NULL,
  `name_lenguage` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `languages`
--

INSERT INTO `languages` (`id_lenguage`, `name_lenguage`) VALUES
(1, 'Inglés'),
(2, 'Español'),
(3, 'Francés'),
(4, 'Alemán'),
(5, 'Italiano'),
(6, 'Portugués'),
(7, 'Chino '),
(8, 'Japonés'),
(9, 'Ruso'),
(10, 'العربية'),
(11, 'Hindī'),
(12, 'Bangla'),
(13, 'Coreano'),
(14, 'Holandés'),
(15, 'Sueco'),
(16, 'Noruego'),
(17, 'Danés'),
(18, 'Griego'),
(19, 'Turco'),
(20, 'Polaco'),
(21, 'Swahili'),
(22, 'Árabe'),
(23, 'Hebreo'),
(24, 'Persa'),
(25, 'Thai'),
(26, 'Vietnamita'),
(27, 'Finlandés'),
(28, 'Húngaro'),
(29, 'Checo'),
(30, 'Eslovaco'),
(31, 'Croata'),
(32, 'Serbio'),
(33, 'Ucraniano'),
(34, 'Árabe'),
(35, 'Persa'),
(36, 'Hindi'),
(37, 'Bengalí'),
(38, 'Punjabi'),
(39, 'Gujarati'),
(40, 'Tamil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lengbooks`
--

CREATE TABLE `lengbooks` (
  `id_lengbook` int(11) NOT NULL,
  `id_book_lengbook` int(11) NOT NULL,
  `id_lenguage_lengbook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

CREATE TABLE `purchases` (
  `id_purchase` int(11) NOT NULL,
  `date_purchase` date NOT NULL,
  `amount_purchase` int(11) NOT NULL,
  `id_user_purchase` int(11) NOT NULL,
  `id_book_purchase` int(11) NOT NULL,
  `id_exemplary_purchase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `readbooks`
--

CREATE TABLE `readbooks` (
  `id_book_readbook` int(11) NOT NULL,
  `id_user_readbook` int(11) NOT NULL,
  `date_readbook` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `name_rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `name_rol`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id_sale` int(11) NOT NULL,
  `id_purchase_sale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `searchbooks`
--

CREATE TABLE `searchbooks` (
  `id_book_searchbook` int(11) NOT NULL,
  `id_user_searchbook` int(11) NOT NULL,
  `date_searchbook` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id_state` int(11) NOT NULL,
  `name_state` varchar(40) NOT NULL,
  `description_state` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id_state`, `name_state`, `description_state`) VALUES
(1, 'Inactivo', 'Cuando el user se encuentra Inactivo'),
(2, 'Activo', 'Cuando el user se encuentra activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types`
--

CREATE TABLE `types` (
  `id_type` int(11) NOT NULL,
  `name_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `types`
--

INSERT INTO `types` (`id_type`, `name_type`) VALUES
(1, 'Fisico'),
(2, 'Electronico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typesbooks`
--

CREATE TABLE `typesbooks` (
  `id_typebook` int(11) NOT NULL,
  `id_book_typebook` int(11) NOT NULL,
  `id_type_typebook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uniquebooks`
--

CREATE TABLE `uniquebooks` (
  `id_uniquebook` int(11) NOT NULL,
  `id_book_uniquebook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `uniquebooks`
--

INSERT INTO `uniquebooks` (`id_uniquebook`, `id_book_uniquebook`) VALUES
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(40) NOT NULL,
  `mail_user` varchar(50) NOT NULL,
  `telephone_user` int(10) NOT NULL,
  `password_user` varchar(20) NOT NULL,
  `id_rol_user` int(11) NOT NULL,
  `id_state_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `authbooks`
--
ALTER TABLE `authbooks`
  ADD PRIMARY KEY (`id_authbook`),
  ADD KEY `authbook_book` (`id_book_authbook`),
  ADD KEY `authbook_author` (`id_author_authbook`);

--
-- Indices de la tabla `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`);

--
-- Indices de la tabla `exemplarys`
--
ALTER TABLE `exemplarys`
  ADD PRIMARY KEY (`id_exemplary`);

--
-- Indices de la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD KEY `favorite_book` (`id_book_favorite`),
  ADD KEY `favorite_user` (`id_user_favorite`);

--
-- Indices de la tabla `generbooks`
--
ALTER TABLE `generbooks`
  ADD PRIMARY KEY (`id_gender_book`),
  ADD KEY `generbook_book` (`id_book_generbook`),
  ADD KEY `generbook_gener` (`id_gener_generbook`);

--
-- Indices de la tabla `geners`
--
ALTER TABLE `geners`
  ADD PRIMARY KEY (`id_gener`);

--
-- Indices de la tabla `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id_lenguage`);

--
-- Indices de la tabla `lengbooks`
--
ALTER TABLE `lengbooks`
  ADD PRIMARY KEY (`id_lengbook`),
  ADD KEY `lengbook_book` (`id_book_lengbook`),
  ADD KEY `lengbook_lenguages` (`id_lenguage_lengbook`);

--
-- Indices de la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id_purchase`),
  ADD KEY `purchase_user` (`id_user_purchase`),
  ADD KEY `purchase_book` (`id_book_purchase`),
  ADD KEY `purchase_exemplary` (`id_exemplary_purchase`);

--
-- Indices de la tabla `readbooks`
--
ALTER TABLE `readbooks`
  ADD KEY `fk_book_readbook` (`id_book_readbook`),
  ADD KEY `fk_user_readbook` (`id_user_readbook`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sale`),
  ADD KEY `sale_purchase` (`id_purchase_sale`);

--
-- Indices de la tabla `searchbooks`
--
ALTER TABLE `searchbooks`
  ADD KEY `fk_id_bookbook` (`id_book_searchbook`),
  ADD KEY `fk_id_userbook` (`id_user_searchbook`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id_state`);

--
-- Indices de la tabla `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id_type`);

--
-- Indices de la tabla `typesbooks`
--
ALTER TABLE `typesbooks`
  ADD PRIMARY KEY (`id_typebook`),
  ADD KEY `id_book_typebook` (`id_book_typebook`),
  ADD KEY `id_type_typebook` (`id_type_typebook`);

--
-- Indices de la tabla `uniquebooks`
--
ALTER TABLE `uniquebooks`
  ADD PRIMARY KEY (`id_uniquebook`),
  ADD UNIQUE KEY `unique_book` (`id_book_uniquebook`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_id_state_user` (`id_state_user`),
  ADD KEY `fk_id_rol_user` (`id_rol_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `authbooks`
--
ALTER TABLE `authbooks`
  MODIFY `id_authbook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `exemplarys`
--
ALTER TABLE `exemplarys`
  MODIFY `id_exemplary` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `generbooks`
--
ALTER TABLE `generbooks`
  MODIFY `id_gender_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `geners`
--
ALTER TABLE `geners`
  MODIFY `id_gener` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `languages`
--
ALTER TABLE `languages`
  MODIFY `id_lenguage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `lengbooks`
--
ALTER TABLE `lengbooks`
  MODIFY `id_lengbook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sale` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id_state` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `types`
--
ALTER TABLE `types`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `typesbooks`
--
ALTER TABLE `typesbooks`
  MODIFY `id_typebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `uniquebooks`
--
ALTER TABLE `uniquebooks`
  MODIFY `id_uniquebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `authbooks`
--
ALTER TABLE `authbooks`
  ADD CONSTRAINT `authbook_author` FOREIGN KEY (`id_author_authbook`) REFERENCES `authors` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authbook_book` FOREIGN KEY (`id_book_authbook`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorite_book` FOREIGN KEY (`id_book_favorite`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_user` FOREIGN KEY (`id_user_favorite`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `generbooks`
--
ALTER TABLE `generbooks`
  ADD CONSTRAINT `generbook_book` FOREIGN KEY (`id_book_generbook`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `generbook_gener` FOREIGN KEY (`id_gener_generbook`) REFERENCES `geners` (`id_gener`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lengbooks`
--
ALTER TABLE `lengbooks`
  ADD CONSTRAINT `lengbook_book` FOREIGN KEY (`id_book_lengbook`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lengbook_lenguage` FOREIGN KEY (`id_lenguage_lengbook`) REFERENCES `languages` (`id_lenguage`);

--
-- Filtros para la tabla `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchase_book` FOREIGN KEY (`id_book_purchase`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_exemplary` FOREIGN KEY (`id_exemplary_purchase`) REFERENCES `exemplarys` (`id_exemplary`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_user` FOREIGN KEY (`id_user_purchase`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `readbooks`
--
ALTER TABLE `readbooks`
  ADD CONSTRAINT `fk_book_readbook` FOREIGN KEY (`id_book_readbook`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_readbook` FOREIGN KEY (`id_user_readbook`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sale_purchase` FOREIGN KEY (`id_purchase_sale`) REFERENCES `purchases` (`id_purchase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `searchbooks`
--
ALTER TABLE `searchbooks`
  ADD CONSTRAINT `fk_id_bookbook` FOREIGN KEY (`id_book_searchbook`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_userbook` FOREIGN KEY (`id_user_searchbook`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `typesbooks`
--
ALTER TABLE `typesbooks`
  ADD CONSTRAINT `book_typebook` FOREIGN KEY (`id_book_typebook`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type_book_type` FOREIGN KEY (`id_type_typebook`) REFERENCES `types` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `uniquebooks`
--
ALTER TABLE `uniquebooks`
  ADD CONSTRAINT `unique_book` FOREIGN KEY (`id_book_uniquebook`) REFERENCES `books` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_id_rol_user` FOREIGN KEY (`id_rol_user`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `fk_id_state_user` FOREIGN KEY (`id_state_user`) REFERENCES `states` (`id_state`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
