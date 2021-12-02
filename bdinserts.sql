--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario`(`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES 
('1','admin','21232f297a57a5a743894a0e4a801fc3','admin@admin',null)

--
-- Volcado de datos para la tabla ``
--

INSERT INTO `rol`(`idrol`, `rodescripcion`) VALUES 
('1','administrador'), 
('2','deposito'),
('3','cliente')

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol`(`idusuario`, `idrol`) VALUES ('1','1')



--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');


--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
('Administrador', 'Dueño', NULL, NULL),
('Deposito', 'Emepleado', NULL, NULL),
('Cliente', 'Comprador', NULL, NULL),
('home', ' menu publico', NULL, NULL);