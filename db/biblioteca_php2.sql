-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 01:14:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca_php2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `idAutor` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apePaterno` varchar(15) NOT NULL,
  `apeMaterno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`, `apePaterno`, `apeMaterno`) VALUES
(1, 'Gabriel', 'Garcia', 'Marquez'),
(5, 'Antoine', 'de Saint', 'Exupéry'),
(6, 'Luis', 'García', 'Márquez'),
(7, 'George', 'Orwell', ''),
(8, 'Jane', 'Austen', ''),
(9, 'J.K. Rowling', '', ''),
(10, 'J:R.R.', 'Tolkien', ''),
(11, 'Herman', 'Melville', ''),
(12, 'F. Scott', 'Fitzgerald', ''),
(13, 'Rudyard', 'Kipling', ''),
(14, 'Victor', 'Hugo', ''),
(15, 'Fyodor', 'Dostoyevsky', ''),
(16, 'Ernest', 'Hemingway', ''),
(17, 'Emily', 'Bronte', ''),
(18, 'Ray', 'Bradbury', ''),
(19, 'Sun', 'Tzu', ''),
(20, 'Paulo', 'Coelho', ''),
(21, 'Ana', 'Frank', ''),
(22, 'Franz', 'Kafka', ''),
(23, 'Mark', 'Twain', ''),
(24, 'Homero', '', ''),
(25, 'Alexandre', 'Dumas', ''),
(26, 'Isabel', 'Allende', ''),
(27, 'León', 'Tolstói', ''),
(28, 'J.D. Salinger', '', ''),
(29, 'Cassandra', 'Clare', ''),
(30, 'Viktor ', 'Frankl', ''),
(31, 'Suzanne', 'Collins', ''),
(32, 'Miguel', 'de Cervantes', ''),
(33, 'John', 'Katzenbach', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorlibro`
--

CREATE TABLE `autorlibro` (
  `idAutor` int(11) NOT NULL,
  `idLibro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autorlibro`
--

INSERT INTO `autorlibro` (`idAutor`, `idLibro`) VALUES
(32, 8),
(8, 9),
(1, 10),
(11, 11),
(7, 12),
(5, 13),
(12, 14),
(13, 15),
(14, 16),
(15, 17),
(16, 18),
(17, 19),
(18, 20),
(19, 21),
(9, 22),
(20, 23),
(21, 24),
(22, 25),
(15, 26),
(23, 27),
(24, 28),
(25, 29),
(26, 30),
(27, 31),
(10, 32),
(28, 33),
(29, 34),
(30, 35),
(31, 36),
(33, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `idLibro` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `isbn` int(11) NOT NULL,
  `editorial` varchar(25) NOT NULL,
  `paginas` int(11) NOT NULL,
  `fotos` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idLibro`, `titulo`, `isbn`, `editorial`, `paginas`, `fotos`, `descripcion`) VALUES
(8, 'Don Quijote de la Mancha', 978, 'Espasa Calpe', 1080, '../img/libro3.jpg', 'La historia de un hidalgo que se vuelve loco y decide convertirse en caballero andante.'),
(9, 'Orgullo y Prejuicio', 978, 'Alianza Editorial', 352, 'orgullo.png', 'Elizabeth Bennet y Mr. Darcy mientras superan sus prejuicios y orgullo para descubrir el verdadero amor en un contexto social rígido.'),
(10, 'Cien años de soledad', 978, 'Editorial Sudamericana', 432, '../img/libro1.jpg', 'La historia de la familia Buendia en el pueblo ficticio de Macondo, llena de realismo mágico.'),
(11, 'Moby Dick', 978, 'Penguin Classics', 585, '', 'La obsesión del capitán Ahab por cazar a la ballena blanca, Moby Dick.'),
(12, '1984', 978, 'Debolsillo', 328, '../img/george.png', 'Una novela distópica sobre un régimen totalitario que controla la vida de sus ciudadanos.'),
(13, 'El principito', 978, 'Salamandra', 96, '../img/pricipito.png', 'La historia de un niño que viaja por diferentes planetas y aprende lecciones sobre la vida.'),
(14, 'El gran Gatsby', 978, 'Anagrama', 180, '../img/gatsby.png', 'Un retrato de la vida en la América de los años 20. centrado en el misterioso Jay Gatsby.'),
(15, 'El libro de la selva', 978, 'Cátedra', 224, '../img/selva.png', 'La historia de Mowgli, un niño criado por lobos en la selva india.'),
(16, 'Los miserables', 978, 'Alianza Editorial', 1488, '../img/miserables.png', 'Una épica novela sobre la lucha por la redención en la Francia del siglo XIX.'),
(17, 'Crimen y castigo', 978, 'Ediciones Akal', 544, '../img/crimen.png', 'La historia de un joven estudiante que comete un crimen y sus consecuencias psicológicas.'),
(18, 'El viejo y el mar', 978, 'Debolsillo', 128, '../img/viejomar.png', 'Un relato sobre un viejo pescador y su lucha con un enorme marlín.'),
(19, 'Cumbres borrascosas', 978, 'Ediciones Cátedra', 416, '../img/cumbres.png', 'Una historia de amor y venganza entre dos familias en la Inglaterra rural.'),
(20, 'Fahrenheit 451', 978, 'RBA Libros', 158, '../img/faren.png', 'Una distopía donde los libros están prohibidos y los \"bomberos\" los queman.'),
(21, 'El arte de la guerra', 978, 'Ediciones del Ser', 272, '../img/arteguerra.png', 'Un antiguo tratado sobre estrategia militar y filosofía.'),
(22, 'Harry Potter y la piedra filosofal', 978, 'Salamandra', 223, '../img/harry.png', 'La primera entrega de la saga de Harry Potter, un joven mago en un mundo mágico.'),
(23, 'El alquimista', 978, 'Planeta', 208, '../img/alquimista.png', 'La búsqueda de un joven pastor por su \"leyenda\" y su sueño.'),
(24, 'El diario de Ana Frank', 978, 'Lumen', 283, '../img/ana.png', 'El diario de una niña judía que se esconde durante la ocupación nazi en los Países Bajos.'),
(25, 'La metamorfosis', 978, 'Ediciones Akal', 796, '../img/metamor.png', 'La historia de Gregor Samsa, quien se despierta transformado en un insecto.'),
(26, 'Los hermanos Karamazov', 978, 'Ediciones Akal', 796, '../img/karama.png', 'Un estudio profundo sobre la moral, la fe y  la familia en el contexto ruso.'),
(27, 'Las aventuras de Tom Sawyer', 978, 'Cátedra', 274, '../img/tom.png', 'Las travesuras de un joven niño en el río Misisipi.'),
(28, 'La odisea', 978, 'Alianza Editorial', 480, '../img/odisea.png', 'La épica historia del viaje de Odiseo de regreso a Ítaca después de la guerra de Troya.'),
(29, 'El conde de Montecristo', 978, 'El conde de Montecristo', 1240, '../img/montecristo.png', 'Una novela sobre la venganza de un hombre injustamente encarcelado.'),
(30, 'La casa de los espíritus', 978, 'Plaza & Janés', 480, '../img/casaespiritus.png', 'La saga de la familia Trueba, con elementos de realismo mágico.'),
(31, 'Ana Karenina', 978, 'Alianza Editorial', 864, '../img/karenina.png', 'Una exploración de la vida y el amor en la Rusia aristocrática.'),
(32, 'El señor de los anillos', 978, 'Minotauro', 1216, '../img/anillos.png', 'Una épica historia de la lucha entre el bien y el mal en la Tierra Media.'),
(33, 'El guardián entre el centeno', 978, 'Alfaguara', 277, '../img/guardian.png', 'La historia de Holden Caulfield, un joven que busca su lugar en el mundo.'),
(34, 'Cazadores de sombras: Ciudad de hueso', 978, 'Destino', 488, '../img/hueso.png', 'Una mescla de fantasía y aventura en un mundo lleno de sombras.'),
(35, 'El hombre en busca de sentido', 978, 'Herder', 200, '../img/sentido.png', 'Un relato sobre la búsqueda de significado en medio del sufrimiento.'),
(36, 'Los juegos del hambre', 978, 'Molino', 384, '../img/hambre.png', 'En un futuro distópico, los jóvenes deben luchar en un mortal juego de supervivencia.'),
(37, 'El psicoanalista', 978, 'Ediciones B', 528, '../img/psicoanalista.png', 'Un thriller psicológico sobre un psicoanalista atrapado en juego mortal.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indices de la tabla `autorlibro`
--
ALTER TABLE `autorlibro`
  ADD KEY `idAutor` (`idAutor`),
  ADD KEY `idLibro` (`idLibro`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`idLibro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `idLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autorlibro`
--
ALTER TABLE `autorlibro`
  ADD CONSTRAINT `autorlibro_ibfk_1` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`idAutor`),
  ADD CONSTRAINT `autorlibro_ibfk_2` FOREIGN KEY (`idLibro`) REFERENCES `libro` (`idLibro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
