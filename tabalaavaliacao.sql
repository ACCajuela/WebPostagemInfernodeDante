-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para tabelaavaliacao
CREATE DATABASE IF NOT EXISTS `tabelaavaliacao` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tabelaavaliacao`;

-- Copiando estrutura para tabela tabelaavaliacao.fichapersonagem
CREATE TABLE IF NOT EXISTS `fichapersonagem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario_Ficha` int NOT NULL,
  `vida` int NOT NULL,
  `vitalidade` int NOT NULL,
  `maldicao` int NOT NULL,
  `astucia` int NOT NULL,
  `presteza` int NOT NULL,
  `violacao` int NOT NULL,
  `auge` int NOT NULL,
  `crueldade` int NOT NULL,
  `obstinacao` int NOT NULL,
  `historia` text NOT NULL,
  `imagem` longblob,
  `classe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `item` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome_personagem` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_Ficha` (`id_usuario_Ficha`),
  CONSTRAINT `fichapersonagem_ibfk_1` FOREIGN KEY (`id_usuario_Ficha`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tabelaavaliacao.fichapersonagem: ~9 rows (aproximadamente)
INSERT INTO `fichapersonagem` (`id`, `id_usuario_Ficha`, `vida`, `vitalidade`, `maldicao`, `astucia`, `presteza`, `violacao`, `auge`, `crueldade`, `obstinacao`, `historia`, `imagem`, `classe`, `item`, `nome_personagem`) VALUES
	(9, 12, 50, 50, 3, 0, 3, 7, 2, 4, 1, 'jack', _binary 0x4172726179, 'Ira', 'jack', 'Jack'),
	(10, 14, 50, 80, 10, 0, 0, 0, 10, 0, 0, 'a', _binary 0x4172726179, 'Luxúria', 'a', 'd'),
	(11, 12, 50, 50, 10, 10, 0, 0, 0, 0, 0, 'sabe como é', _binary 0x4172726179, 'Ira', 'Aquele lá', 'Ajuda'),
	(14, 19, 50, 60, 3, 2, 3, 5, 3, 2, 2, 'Lá atrás eu era eu, muito eu, muito eu mesmo', _binary 0x4172726179, 'Traição', 'Um espelho para me olhar sempre', 'Murta'),
	(15, 20, 50, 50, 10, 10, 0, 0, 0, 0, 0, 'mes', _binary 0x4172726179, 'Ira', 'mes', 'med'),
	(16, 12, 80, 50, 10, 0, 10, 0, 0, 0, 0, 'asssa', _binary 0x4172726179, 'Gula', 'sa', 'Jack'),
	(17, 12, 80, 50, 10, 0, 10, 0, 0, 0, 0, 'asssa', _binary 0x4172726179, 'Gula', 'sa', 'Jack'),
	(18, 12, 70, 30, 0, 0, 0, 0, 10, 10, 0, 'a', _binary 0x4172726179, 'Violência', 'a', 'a'),
	(19, 12, 50, 50, 3, 0, 3, 7, 2, 4, 1, 'Uma vez........', _binary 0x4172726179, 'Ira', 'Um cajado', 'edson');

-- Copiando estrutura para tabela tabelaavaliacao.postagens
CREATE TABLE IF NOT EXISTS `postagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `conteudo` text NOT NULL,
  `data_postagem` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('rascunho','publicado') DEFAULT 'rascunho',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `postagens_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tabelaavaliacao.postagens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela tabelaavaliacao.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_usuario` enum('admin','usuario') DEFAULT 'usuario',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tabelaavaliacao.usuarios: ~11 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_criacao`, `tipo_usuario`) VALUES
	(1, 'monoIra', 'iraMono@gmail.com', 'a1f40dde008947c3294735ab29a793c4', '2024-10-07 14:13:23', 'usuario'),
	(2, 'monoLuxuria', 'luxuriaMono@gmail.com', '5eb96e41c7d48fd2d9c39d86042afa93', '2024-10-07 14:13:23', 'usuario'),
	(3, 'monoGula', 'gulaMono@gmail.com', '020635bcbe08599b0bb92d507c28e30d', '2024-10-07 14:13:23', 'usuario'),
	(4, 'monoAvareza', 'avarezaMono@gmail.com', 'ae4f1fcddedfb8185467f7f99172db21', '2024-10-07 14:13:23', 'usuario'),
	(5, 'monoHeresia', 'heresiaMono@gmail.com', 'c18c21c49cf1546fba3924989a39be8b', '2024-10-07 14:13:23', 'usuario'),
	(6, 'monoViolencia', 'violenciaMono@gmail.com', 'e1ee7f4af9ba9b0405db4ac68983045e', '2024-10-07 14:13:23', 'usuario'),
	(7, 'monoFraude', 'fraudeMono@gmail.com', 'de52c4ec676a8f936b2643a89fb3a9b3', '2024-10-07 14:13:23', 'usuario'),
	(8, 'monoTraicao', 'traicaoMono@gmail.com', 'bd111ae83d8a5f5af874355b85381314', '2024-10-07 14:13:23', 'usuario'),
	(9, '2@g.com', '2@gom', 'b5b037a78522671b89a2c1b21d9b80c6', '2024-10-08 15:28:24', 'usuario'),
	(10, 'Devil', 'anthenorfer@gmail.com', 'f06ef74b99855dac134ec595819ba929', '2024-10-08 15:28:36', 'usuario'),
	(11, 'sdada', 'devilmonkey@gmail.com', '7f602fd80bc547f6c648b45b38853818', '2024-10-08 15:37:56', 'usuario'),
	(12, 'anthenor', 'anthenofer@gmail.com', 'f862c0901ab70cc4a03c353ea7e2f3bb', '2024-10-09 04:02:34', 'usuario'),
	(13, 'Devils', 'devilmonkey8@gmail.com', 'f862c0901ab70cc4a03c353ea7e2f3bb', '2024-10-09 18:51:14', 'usuario'),
	(14, 'ana', 'ana@gmail.com', '276b6c4692e78d4799c12ada515bc3e4', '2024-10-09 18:58:01', 'usuario'),
	(15, 'd', 'd@gmail.com', '8277e0910d750195b448797616e091ad', '2024-10-09 19:38:10', 'usuario'),
	(16, 'acaba', 'acaba@please.com', '39baa59de2ccb3e64b6261c00a8a3ac7', '2024-10-09 19:47:40', 'usuario'),
	(17, 'r', 'r@gmail.com', '4b43b0aee35624cd95b910189b3dc231', '2024-10-09 20:24:01', 'usuario'),
	(18, 'victor', 'victor@gmail.com', 'ffc150a160d37e92012c196b6af4160d', '2024-10-09 22:50:30', 'usuario'),
	(19, 'murta', 'murta@gmail.com', '8f895c6de003d6e7a665d197101cc18d', '2024-10-09 23:54:07', 'usuario'),
	(20, 'rillory', 'rillory@gmail.com', '8100240622c5494b0cb9086f15957813', '2024-10-10 00:02:07', 'usuario'),
	(21, 'mes', 'mes@gmail.com', 'd2db8a610f8c7c0785d2d92a6e8c450e', '2024-10-10 00:05:33', 'usuario'),
	(22, 'ed', 'ed@gmail.com', 'b5f3729e5418905ad2b21ce186b1c01d', '2024-10-10 00:27:07', 'usuario'),
	(23, 'edson2', 'edson@gmail.com', 'b5f3729e5418905ad2b21ce186b1c01d', '2024-10-10 00:28:01', 'usuario');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
