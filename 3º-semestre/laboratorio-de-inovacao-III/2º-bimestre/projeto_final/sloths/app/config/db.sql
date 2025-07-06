-- Apaga o banco de dados se ele já existir, para começar do zero (opcional, cuidado ao usar)
-- DROP SCHEMA IF EXISTS sloths;

-- Cria o banco de dados do projeto
CREATE SCHEMA IF NOT EXISTS sloths CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Seleciona o banco de dados para usar nos comandos seguintes
USE sloths;

-- -----------------------------------------------------
-- Tabela `usuarios`
-- Armazena os dados de login e perfil dos usuários.
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
  senha VARCHAR(255) NOT NULL,
  genero ENUM('M', 'F', 'O') NOT NULL,
  data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Tabela `pomodoro_sessoes`
-- Registra cada sessão de Pomodoro completada pelo usuário.
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS pomodoro_sessoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data_sessao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tipo_sessao ENUM('Foco', 'Descanso Curto', 'Descanso Longo') NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Tabela `lembretes`
-- Armazena os lembretes (to-do list) de cada usuário.
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS lembretes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    data_lembrete DATETIME NULL,
    concluido BOOLEAN NOT NULL DEFAULT 0,
    cor VARCHAR(7) NOT NULL DEFAULT '#ffffff',
    data_criacao TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Tabela `eventos`
-- Armazena os eventos do calendário.
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    cor VARCHAR(7) NOT NULL DEFAULT '#6a5acd',
    data_inicio DATETIME NOT NULL,
    data_fim DATETIME NOT NULL,
    data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Exemplo de como criar um usuário administrador manualmente (opcional)
-- Lembre-se que a senha precisa ser gerada com password_hash() do PHP.
-- INSERT INTO `usuarios` (`nome`, `email`, `role`, `senha`, `genero`) VALUES ('Admin', 'admin@sloths.com', 'admin', '$2y$10$seu_hash_de_senha_aqui', 'O');