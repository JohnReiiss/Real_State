-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/07/2025 às 13:16
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `real_state`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `neighborhood` varchar(100) NOT NULL,
  `owner_whatsapp` varchar(20) NOT NULL,
  `owner_email` varchar(100) NOT NULL,
  `property_status` varchar(50) NOT NULL,
  `rent_value` decimal(10,2) DEFAULT NULL,
  `sale_value` decimal(10,2) DEFAULT NULL,
  `garage_spaces` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `condominium` tinyint(1) NOT NULL DEFAULT 0,
  `condominium_value` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `images` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `property`
--

INSERT INTO `property` (`id`, `type`, `address`, `city`, `postal_code`, `neighborhood`, `owner_whatsapp`, `owner_email`, `property_status`, `rent_value`, `sale_value`, `garage_spaces`, `bedrooms`, `bathrooms`, `area`, `condominium`, `condominium_value`, `created_at`, `images`, `user_id`) VALUES
(16, 'Casa', 'Travessa Berlim', 'Bragança Paulista', '12919-240', 'Jardim Europa', '(13) 97186-7085', 'imobiliaria123nara@gmail.com', 'aluguel', 3000.00, NULL, 2, 3, 2, 120, 1, 670.00, '2025-03-12 14:44:22', 'home american.jpg,modern kitchen.jpg,quarto apt2.jpeg', 1),
(17, 'Apartamento', 'Alameda Suíça', 'Bragança Paulista', '12919-170', 'Jardim Europa', '(11) 97169-8421', 'imobiliaria123nara@gmail.com', 'aluguel', 2600.00, NULL, 1, 3, 2, 137, 1, 780.00, '2025-03-12 17:46:14', 'condominio-apartamentos.jpg,armario-de-cozinha-modulado-para-apartamento-valor.jpg,Apartamento_3_Quartos_Morar_Construtora.jpg', 1),
(18, 'Apartamento', 'Avenida Atlântica 2440', 'Balneário Camboriú', '88330-907', 'Centro', '(49) 99975-0193', 'imobiliaria123nara@gmail.com', 'venda', NULL, 4000000.00, 2, 3, 2, 155, 1, 2150.00, '2025-03-12 18:17:03', 'apto bc.jpeg,importancia-da-decoracao-2-1024x563.jpg,one tower bc.jpeg,quarto bc.jpeg,sala-e-cozinha-integrada-5.jpg', 1),
(19, 'Casa', 'Rua Xesque', 'Extrema', '37640-000', 'Ponte Alta', '(35)998599975', 'imobiliaria123nara@gmail.com', 'venda', NULL, 1580000.00, 4, 5, 3, 212, 1, 930.00, '2025-03-12 18:24:50', 'photo-1613490493576-7fde63acd811.jpg,blog-4-3.png,Casas-modernas-decorada-com-cozinha-estilo-industrial-Foto-Erica-Salguero.jpg', 1),
(20, 'Cobertura', 'Rua Georg Telewny', 'Guarujá', '11446-450', 'Balneario Praia do Perequê', '(18) 97113-3695', 'imobiliaria123nara@gmail.com', 'venda', NULL, 3000000.00, 2, 3, 2, 145, 1, 1700.00, '2025-03-12 18:36:14', 'CasaDeValentina_Projetos_CoberturaBeira-Mar_JuarezFariasJrArquitetura_MCAEstudio-4.jpg.optimal.jpg,Apartamento_1_Quarto_Morar_Construtora-1.jpeg,quarto-apartamento.jpg', 1),
(21, 'Casa', 'Avenida das Lagostas', 'Florianópolis', '88053-350', 'Jurerê Internacional', '(49) 99716-0600', 'imobiliaria123nara@gmail.com', 'aluguel', 5500.00, NULL, 3, 4, 2, 174, 1, 1120.00, '2025-03-18 16:29:55', 'Casa_B_facahda_01-PS.jpg,quartos-de-casal-modernos-e-luxuosos.jpg,decoracao-banheiro-simples-banheiro-grande-com-pastilha-verde-laurasantos3-96128-proportional-height_cover_medium.jpg,large-american-style-kitchen-interior-with-granite-2021-09-03-12-20-35-utc-min.jpg,1226480674-quintal-com-piscina-e-churrasqueira-moderna-foto-arq-e-design.jpg', 1),
(22, 'Apartamento', 'Avenida Paulista', 'São Paulo', '01310-300', 'Bela Vista', '(14) 99961-6905', 'imobiliaria123nara@gmail.com', 'venda', NULL, 6000000.00, 2, 2, 3, 150, 1, 3247.00, '2025-03-18 16:41:13', 'IMG_0018-960x640.jpg,15429974145bf845a6f39ee_1542997414_3x2_md.jpg,areacomumdecondominio1.jpg,cozinha-de-luxo-saiba-como-inovar-e-sair-do-tradicional-2-1024x683.jpg,dicas_de_decoracao_para_quarto_de_casal_em_apartamento_pequeno_67c6_768x500.jpeg,FITNESS-scaled-1.jpg,ideias-de-decoracao-de-sala-estar-800x533.jpg,quarto-apartamento-pequeno.jpg', 1),
(23, 'Cobertura', '19111 Fisher Island Dr Unit', 'Miami', '33109-000', 'Miami Beach', '(18) 99569-8723', 'imobiliaria123nara@gmail.com', 'aluguel', 3396090.00, NULL, 3, 4, 3, 210, 1, 832042.00, '2025-03-18 16:51:59', '37b3f5c895cc016269123723.jpg,moveis-planejados-para-banheiro-de-apartamento-pequeno-orcar.png,b6100c4ff360557ca4e94356d9a6277e.jpg,quarto-de-casal-piso-vinilico-escuro-6-1.jpg,cozinha-planejada-de-apartamento-veja-dicas-para-decorar-1024x683.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'John Reiiss', 'johnatan.reiiss@icloud.com', '$2y$10$BHnnJKXWe.7IavuqQERhAehtqum5foYkr/2zK7WIO02xn0UTsfpuG', 'user', '2025-03-11 17:57:06'),
(2, 'usuario de teste', 'usuariodeteste@gmail.com', '$2y$10$gqPr1m9PPoIomwJICi7HBOmlAWumdgTWz1p.RTEb4q85FKMFdEyLS', '', '2025-07-18 19:29:47');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Índices de tabela `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
