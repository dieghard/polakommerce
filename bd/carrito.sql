/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 100421
Source Host           : localhost:3306
Source Database       : carrito

Target Server Type    : MYSQL
Target Server Version : 100421
File Encoding         : 65001

Date: 2021-09-11 16:12:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(400) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(400) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'Frutas', 'Frutas de estación', 'Frutas Especialmente Seleccionadas', 'img/categorias/frutas.jpg', '-1');
INSERT INTO `categorias` VALUES ('2', 'Verduras', 'Verduras Seleccionadas', 'Verduras Seleccionadas', 'img/categorias/verduras.jpg', '-1');
INSERT INTO `categorias` VALUES ('3', 'Otra Categoria', 'Otra Categoria', null, 'img/categorias/otracategoria.jpg', '-1');

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cuit` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `localidad` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `provincia` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_postal` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono_ws` varchar(100) COLLATE utf8_spanish2_ci DEFAULT '',
  `facebook_link` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `instagram_link` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pinterest_link` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `maneja_mercado_pago` tinyint(4) DEFAULT NULL,
  `mercado_pago_access_token` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `mercado_pago_key` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `realiza_envios_gratis` double DEFAULT NULL,
  `email_is_smtp` tinyint(4) DEFAULT -1,
  `email_host` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email_smtp_auth` tinyint(4) DEFAULT -1,
  `email_username` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email_password` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email_smtpSecure` varchar(10) COLLATE utf8_spanish2_ci DEFAULT 'TLS',
  `email_port` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paginaEnabled` tinyint(4) DEFAULT -1,
  `cliengo_chat_token_1` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cliengo_chat_token_2` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES ('1', 'Colum El Verdulero', 'Emilio Genoud 702', null, 'BienAlSur', 'Santa Cruz', 'X6132', 'gitano@columelverdulero.com.ar', '3385522998', '+5493385505100', 'https://www.facebook.com/columelverdulero', '#', '#', '#', 'img/logo.png', '-1', 'TEST-8883022316865038-082121-a29106f851ba358ef8c612a202e7c1e0-811503701', 'TEST-f23a2997-302e-41c4-ad53-2355f4effee7', '6000', '-1', 'smtp.gmail.com', '-1', 'markiewiczdiego@gmail.com', '', 'TLS', '587', '-1', '59aee209e4b0574792f3f52a', '59aee218e4b0edbe887265d3');

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaHora` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha` date DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dni` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pais` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `numero` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamento` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codigo_postal` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pagado` varchar(2) COLLATE utf8_spanish2_ci DEFAULT '',
  `subtotal` float DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `codigoDescuento` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '2021-09-08 19:29:32', '2021-09-09', 'Diego', 'Markiewicz', '28119270', 'Argentina', '9 De Julio ', ' 749', '', 'General Levalle', '6132', '03385522998', 'dieghard@gmail.com', '', 'NUEVO', '', '100', '0', '100', 'SI');
INSERT INTO `pedidos` VALUES ('2', '2021-09-10 22:28:57', '2021-09-11', 'Diego', 'Markiewicz', '28119270', 'ARGENTINA', '9 de Julio', '749', '', 'General Levalle', '6132', '3385522998', 'dieghard@gmail.com', '', 'NUEVO', '', '310', '0', '310', 'SI');
INSERT INTO `pedidos` VALUES ('3', '2021-09-10 22:30:41', '2021-09-11', 'Diego', 'Markiewicz', '28119270', 'ARGENTINA', '9 de Julio', '749', '', 'General Levalle', '6132', '3385522998', 'dieghard@gmail.com', '', 'NUEVO', '', '310', '0', '310', 'SI');
INSERT INTO `pedidos` VALUES ('4', '2021-09-10 22:32:49', '2021-09-11', 'Diego', 'Markiewicz', '28119270', 'Argentina', '9 De Julio 749', '', '', 'General Levalle', '6132', '03385522998', 'dieghard@gmail.com', '', 'NUEVO', '', '210', '0', '210', 'SI');
INSERT INTO `pedidos` VALUES ('5', '2021-09-10 22:37:17', '2021-09-11', 'Diego', 'Markiewicz', '28119270', 'Argentina', '9 De Julio 749', '', '', 'General Levalle', '6132', '03385522998', 'dieghard@gmail.com', '', 'NUEVO', '', '210', '0', '210', 'SI');

-- ----------------------------
-- Table structure for pedidos_det
-- ----------------------------
DROP TABLE IF EXISTS `pedidos_det`;
CREATE TABLE `pedidos_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `descuento` float DEFAULT NULL,
  `porcentaje_descuento` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedidos_det_pedidos_1` (`pedido_id`),
  KEY `fk_productoid` (`producto_id`),
  CONSTRAINT `fk_pedidos_det_pedidos_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `fk_productoid` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of pedidos_det
-- ----------------------------
INSERT INTO `pedidos_det` VALUES ('1', '1', '3', '1', '30', '30', '0', '0', '30');
INSERT INTO `pedidos_det` VALUES ('2', '1', '13', '2', '30', '60', '0', '0', '60');
INSERT INTO `pedidos_det` VALUES ('3', '1', '1', '1', '10', '10', '0', '0', '10');
INSERT INTO `pedidos_det` VALUES ('4', '2', '13', '3', '30', '90', '0', '0', '90');
INSERT INTO `pedidos_det` VALUES ('5', '2', '3', '1', '30', '30', '0', '0', '30');
INSERT INTO `pedidos_det` VALUES ('6', '2', '2', '3', '20', '60', '0', '0', '60');
INSERT INTO `pedidos_det` VALUES ('7', '2', '1', '4', '10', '40', '0', '0', '40');
INSERT INTO `pedidos_det` VALUES ('8', '2', '7', '3', '30', '90', '0', '0', '90');
INSERT INTO `pedidos_det` VALUES ('9', '3', '13', '3', '30', '90', '0', '0', '90');
INSERT INTO `pedidos_det` VALUES ('10', '3', '3', '1', '30', '30', '0', '0', '30');
INSERT INTO `pedidos_det` VALUES ('11', '3', '2', '3', '20', '60', '0', '0', '60');
INSERT INTO `pedidos_det` VALUES ('12', '3', '1', '4', '10', '40', '0', '0', '40');
INSERT INTO `pedidos_det` VALUES ('13', '3', '7', '3', '30', '90', '0', '0', '90');
INSERT INTO `pedidos_det` VALUES ('14', '4', '3', '7', '30', '210', '0', '0', '210');
INSERT INTO `pedidos_det` VALUES ('15', '5', '3', '7', '30', '210', '0', '0', '210');

-- ----------------------------
-- Table structure for perfiles
-- ----------------------------
DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of perfiles
-- ----------------------------
INSERT INTO `perfiles` VALUES ('1', 'ADMINISTRADOR');
INSERT INTO `perfiles` VALUES ('2', 'USUARIO');
INSERT INTO `perfiles` VALUES ('3', 'CLIENTE');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `vig` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagenPresentacion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `empresa` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idioma` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `edad` varchar(3) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `categoriaID` int(11) DEFAULT NULL,
  `rubroID` int(11) DEFAULT NULL,
  `enCarrusel` varchar(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `productoDestacado` varchar(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` varchar(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `conStock` tinyint(4) DEFAULT NULL,
  `conDescuento` varchar(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `peso` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `informacion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Rubros` (`rubroID`),
  KEY `fk_categorias` (`categoriaID`),
  CONSTRAINT `fk_Rubros` FOREIGN KEY (`rubroID`) REFERENCES `rubros` (`id`),
  CONSTRAINT `fk_categorias` FOREIGN KEY (`categoriaID`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'Ajo', null, '10', null, 'ajo_1.jpg', null, null, null, '1', '1', null, null, '-1', '0', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('2', 'Berenjena', null, '20', null, 'berenjenas_1.jpeg', null, null, null, '1', '2', null, null, '-1', '-1', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('3', 'Brocolli', null, '30', null, 'brocolo_1.jpg', null, null, null, '3', '1', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('4', 'Lechuga', null, '40', null, 'lechuga_1.jpg', null, null, null, '2', '2', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('5', 'Manzana Roja', null, '10', null, 'manzana-roja-2.jpg', null, null, null, '2', '1', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('6', 'Manzana Verde', null, '20', null, 'manzana-verde-1.jpg', null, null, null, '2', '2', null, null, '-1', '-1', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('7', 'Morron', null, '30', null, 'morron_1.jpg', null, null, null, '1', '1', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('8', 'Peras', null, '40', null, 'peras_1.jpg', null, null, null, '2', '2', null, null, '-1', '-1', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('9', 'Uvas', null, '50', null, 'uvas_1.jpg', null, null, null, '2', '1', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('10', 'Zanhorias', null, '60', null, 'Zanahorias_1.jpg', null, null, null, '3', '2', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('11', 'Zapallos', null, '10', null, 'zapallo_1.jpg', null, null, null, '2', '1', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('12', 'Remolachas', null, '20', null, 'remolacha_1.jpg', null, null, null, '1', '2', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('13', 'Espinacas', null, '30', null, 'espinacas_1.jpg', null, null, null, '2', '1', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');
INSERT INTO `productos` VALUES ('14', 'Papas', null, '30', null, 'papas_1.jpg', null, null, null, '1', '2', null, null, '-1', '10', null, '100', null, 'Peso expresados en gramos');

-- ----------------------------
-- Table structure for productos_fotos_videos
-- ----------------------------
DROP TABLE IF EXISTS `productos_fotos_videos`;
CREATE TABLE `productos_fotos_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productoId` int(11) DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fv_productos` (`productoId`),
  CONSTRAINT `fk_fv_productos` FOREIGN KEY (`productoId`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of productos_fotos_videos
-- ----------------------------
INSERT INTO `productos_fotos_videos` VALUES ('1', '1', 'fotos/ajo_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('2', '2', 'berenjenas_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('3', '3', 'brocoli_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('4', '4', 'lechuga_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('5', '5', 'manzana-roja-3.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('6', '6', 'manzana-verde-2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('7', '7', 'morron_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('8', '8', 'peras_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('9', '9', 'remolacha_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('10', '10', 'uvas_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('11', '11', 'Zanahorias_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('12', '12', 'zapallo_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('13', '13', 'espinacas_2.jpg', null);
INSERT INTO `productos_fotos_videos` VALUES ('14', '1', 'ajo_3.jpg', null);

-- ----------------------------
-- Table structure for rubros
-- ----------------------------
DROP TABLE IF EXISTS `rubros`;
CREATE TABLE `rubros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of rubros
-- ----------------------------
INSERT INTO `rubros` VALUES ('1', 'Frutas', 'Frutas', 'Las mejores Frutas', null, '-1');
INSERT INTO `rubros` VALUES ('2', 'verduras', 'Verduras', 'Verde que te quiero Verde', null, '-1');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresaid` int(11) DEFAULT NULL,
  `nombreyapellido` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `perfilID` int(11) DEFAULT NULL,
  `activo` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_EmpresaUsuario` (`empresaid`),
  KEY `fk_UserPerfil` (`perfilID`),
  CONSTRAINT `fk_EmpresaUsuario` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`id`),
  CONSTRAINT `fk_UserPerfil` FOREIGN KEY (`perfilID`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
