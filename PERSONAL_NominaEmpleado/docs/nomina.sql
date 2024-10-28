-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 08:28:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nomina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'isidro', '$2y$10$W7dUvGt3.Q18c/DeuT0RBengsaxU3CU2Y5cRUIExtZ6PKiNktH6..', 'Isidro', 'Marroquin', 'hazel.jpg', '2024-03-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(130, 27, '2024-05-01', '08:00:00', 1, '17:00:00', 9),
(131, 27, '2024-05-02', '08:00:00', 1, '17:00:00', 9),
(132, 27, '2024-05-03', '08:00:00', 1, '17:00:00', 9),
(133, 27, '2024-05-04', '08:00:00', 1, '17:00:00', 9),
(134, 27, '2024-05-05', '08:00:00', 1, '17:00:00', 9),
(135, 27, '2024-05-06', '08:00:00', 1, '17:00:00', 9),
(136, 27, '2024-05-07', '08:00:00', 1, '17:00:00', 9),
(137, 27, '2024-05-08', '08:00:00', 1, '17:00:00', 9),
(138, 27, '2024-05-09', '08:00:00', 1, '17:00:00', 9),
(139, 27, '2024-05-10', '08:00:00', 1, '17:00:00', 9),
(140, 27, '2024-05-11', '08:00:00', 1, '17:00:00', 9),
(141, 27, '2024-05-12', '08:00:00', 1, '17:00:00', 9),
(142, 27, '2024-05-13', '08:00:00', 1, '17:00:00', 9),
(143, 27, '2024-05-14', '08:00:00', 1, '17:00:00', 9),
(144, 27, '2024-05-15', '08:00:00', 1, '17:00:00', 9),
(145, 27, '2024-05-16', '08:00:00', 1, '17:00:00', 9),
(146, 27, '2024-05-17', '08:00:00', 1, '17:00:00', 9),
(147, 27, '2024-05-18', '08:00:00', 1, '17:00:00', 9),
(148, 27, '2024-05-19', '08:00:00', 1, '17:00:00', 9),
(149, 27, '2024-05-20', '08:00:00', 1, '17:00:00', 9),
(150, 27, '2024-05-21', '08:00:00', 1, '17:00:00', 9),
(151, 27, '2024-05-22', '08:00:00', 1, '17:00:00', 9),
(152, 27, '2024-05-23', '08:00:00', 1, '17:00:00', 9),
(153, 27, '2024-05-24', '08:00:00', 1, '17:00:00', 9),
(154, 27, '2024-05-25', '08:00:00', 1, '17:00:00', 9),
(155, 27, '2024-05-26', '08:00:00', 1, '17:00:00', 8.5),
(156, 27, '2024-05-27', '08:00:00', 1, '17:00:00', 8.5),
(157, 27, '2024-05-28', '08:00:00', 1, '17:00:00', 8.5),
(158, 27, '2024-05-29', '08:00:00', 1, '17:00:00', 8.5),
(159, 27, '2024-05-30', '08:00:00', 1, '17:00:00', 8.5),
(160, 27, '2024-05-31', '08:00:00', 1, '17:00:00', 8.5),
(170, 28, '2024-06-16', '15:03:37', 0, '00:00:00', 0),
(171, 27, '2024-06-19', '23:20:27', 0, '23:21:36', 5.3333333333333);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(6, 'AFP', 7.25),
(7, 'ISSS', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `usu_correo` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `usu_pass` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `address`, `birthdate`, `usu_correo`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`, `usu_pass`) VALUES
(26, 'EWJ471530826', 'Isidro Alexander ', 'Marroquin Echeverria', 'San Martin, San Salvador', '2000-09-22', 'nayeli9953@gmail.com', 'Male', 1, 5, 'm2.jpeg', '2024-04-01', 'IDprQF2nJLjB+3oReZwaGOsVHDHNfFvX9o9qycLJ48E='),
(27, 'KOC132409756', 'Juan', 'Antares', 'Soyapango', '2000-09-22', 'alexandermarqn@gmail.com', 'Male', 1, 2, 'marlin4.jpeg', '2024-04-06', 'QLMUO3YwVNu1va3ybu37H/7D5UYk/auPfgHOXdzcWxU='),
(28, 'MQF408657193', 'Marjorie', 'Cabrera', 'San salvador', '2003-02-14', 'marroquin9953@gmail.com', 'Female', 1, 2, 'samsung_logo_icon_181348.png', '2024-06-09', 'UpwUliwABK2H9lagX9vgtZPUw41ZsPnTn+Q2K5/9OfA='),
(30, 'PLJ405267893', 'Luis', 'Cid', 'Cerron Grande\r\nCabañas, jutiapa', '2000-09-22', 'tsh36106@gmail.com', 'Male', 1, 2, 'Stuff-Best-Smartphone-Lead.webp', '2024-06-25', '/BlAb+PED+bBeY0Ia00p7I1XClFh6QXxn3nefxgvLzw=');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `overtime`
--

INSERT INTO `overtime` (`id`, `employee_id`, `hours`, `rate`, `date_overtime`) VALUES
(6, '26', 1.5, 1.5, '2024-04-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `position`
--

INSERT INTO `position` (`id`, `description`, `rate`) VALUES
(1, 'Coordinador de presupuestos', 1.89),
(5, 'Vigilante', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(2, '08:00:00', '17:00:00'),
(5, '03:00:00', '09:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT de la tabla `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
