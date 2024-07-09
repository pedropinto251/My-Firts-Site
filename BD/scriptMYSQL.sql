-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS dsos;
USE dsos;

-- Definir tabelas
CREATE TABLE usuarios1 (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    senha VARCHAR(255),
    morada varchar(100) NOT NULL,
    codigo_postal varchar(30) NOT NULL,
    cidade varchar(50) NOT NULL,
    nif int NOT NULL,
    tipo_usuario ENUM('aluno', 'docente', 'empresa', 'admin')

);

CREATE TABLE aluno (
  id INT PRIMARY KEY  AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  CONSTRAINT FK_aluno_Usuarios FOREIGN KEY (id) REFERENCES Usuarios1(id)
);

CREATE TABLE docentes (
  id INT PRIMARY KEY  AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  CoordenadorCursoID INT NOT NULL,
  CONSTRAINT FK_docentes_Usuarios FOREIGN KEY (id) REFERENCES Usuarios1(id)
);

CREATE TABLE empresas (
  id INT PRIMARY KEY  AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  pessoa_contacto VARCHAR(255) NOT NULL,
  CONSTRAINT FK_empresas_Usuarios FOREIGN KEY (id) REFERENCES Usuarios1(id)
);

CREATE TABLE admin (
  id INT  AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  CONSTRAINT FK_admin_Usuarios FOREIGN KEY (id) REFERENCES Usuarios1(id)
);

CREATE TABLE Alertas (
  id_destinatario INT PRIMARY KEY AUTO_INCREMENT,
  Tipo VARCHAR(20) NOT NULL,
  DestinatarioID INT NOT NULL,
  Mensagem TEXT NOT NULL,
  DataHoraEnvio DATETIME NOT NULL
);

CREATE TABLE Login (
  id_login INT PRIMARY KEY AUTO_INCREMENT,
  tipo VARCHAR(20) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  id INT NOT NULL,
  CONSTRAINT FK_Login_Alertas FOREIGN KEY (id) REFERENCES Alertas(id_destinatario)
);

CREATE TABLE Propostas (
  id INT PRIMARY KEY  AUTO_INCREMENT,
  Titulo VARCHAR(255) NOT NULL,
  Descricao TEXT NOT NULL,
  ResponsavelID INT NOT NULL,
  Estado VARCHAR(20) NOT NULL,
  ArquivoPDF VARCHAR(255) NOT NULL,
  DataSubmissao DATE NOT NULL,
  DataAprovacao DATE,
  AlertaEnviado CHAR(3) NOT NULL,
  CONSTRAINT FK_Propostas_docentes_new FOREIGN KEY (ResponsavelID) REFERENCES docentes(id)
);

CREATE TABLE Candidaturas (
  id INT PRIMARY KEY  AUTO_INCREMENT,
  ProjetoEstagioID INT NOT NULL,
  AlunoID INT NOT NULL,
  ArquivoPDF VARCHAR(255) NOT NULL,
  Estado VARCHAR(20) NOT NULL,
  CONSTRAINT FK_Candidaturas_Propostas_new FOREIGN KEY (ProjetoEstagioID) REFERENCES Propostas(id),
  CONSTRAINT FK_Candidaturas_aluno FOREIGN KEY (AlunoID) REFERENCES aluno(id)
);

CREATE TABLE Check01 (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_projeto INT NOT NULL,
  Descricao TEXT NOT NULL,
  Campo2 VARCHAR(255) NOT NULL,
  Avaliacao INT (20),
  DataApresentacao DATe
);

CREATE TABLE Projeto (
  Id_projeto INT PRIMARY KEY  AUTO_INCREMENT,
  AlunoID INT NOT NULL,
  Projeto VARCHAR(255) NOT NULL,
  DataSubmissao DATE NOT NULL,
  PDF VARCHAR(255),
);

CREATE TABLE Cursos (
  IDCurso INT PRIMARY KEY  AUTO_INCREMENT,
  NomeCurso VARCHAR(255) NOT NULL,
  DepartamentoArea VARCHAR(100) NOT NULL,
  CoordenadorCursoID INT NOT NULL,
  CONSTRAINT FK_docentes_Cursos FOREIGN KEY (CoordenadorCursoID) REFERENCES docentes(id)
);

CREATE TABLE Vagas (
  IDVaga INT PRIMARY KEY  AUTO_INCREMENT,
  ProjetoEstagioID INT NOT NULL,
  NumeroVagas INT NOT NULL,
  DescricaoVaga TEXT NOT NULL,
  CONSTRAINT FK_Propostas_Vagas FOREIGN KEY (ProjetoEstagioID) REFERENCES Propostas(id)
);

-- Inserir dados na tabela Usuarios1
INSERT INTO Usuarios1 (nome, email, senha, morada, codigo_postal, cidade, nif, tipo_usuario)
VALUES
  ('Usuário Aluno', 'aluno@email.com', 'senha_aluno', 'Rua Aluno, 123', '12345-678', 'Cidade Aluno', 123456789, 'aluno'),
  ('Usuário Docente', 'docente@email.com', 'senha_docente', 'Rua Docente, 456', '98765-432', 'Cidade Docente', 987654321, 'docente'),
  ('Usuário Empresa', 'empresa@email.com', 'senha_empresa', 'Rua Empresa, 789', '54321-876', 'Cidade Empresa', 987654322, 'empresa'),
  ('Usuário Admin', 'admin@email.com', 'senha_admin', 'Rua Admin, 101', '11111-222', 'Cidade Admin', 111222333, 'admin');

-- Inserir dados na tabela aluno
INSERT INTO aluno (nome, Email, Senha)
VALUES
  ('Aluno 1', 'aluno1@email.com', 'senha_aluno1'),
  ('Aluno 2', 'aluno2@email.com', 'senha_aluno2');

-- Inserir dados na tabela docentes
INSERT INTO docentes (nome, Email, Senha, CoordenadorCursoID)
VALUES
  ('Docente 1', 'docente1@email.com', 'senha_docente1', 1),
  ('Docente 2', 'docente2@email.com', 'senha_docente2', 2);

-- Inserir dados na tabela empresas
INSERT INTO empresas (nome, Email, Senha, pessoa_contacto)
VALUES
  ('Empresa 1', 'empresa1@email.com', 'senha_empresa1', 'Contato 1'),
  ('Empresa 2', 'empresa2@email.com', 'senha_empresa2', 'Contato 2');

-- Inserir dados na tabela admin
INSERT INTO admin (nome, Email, Senha)
VALUES
  ('Admin 1', 'admin1@email.com', 'senha_admin1'),
  ('Admin 2', 'admin2@email.com', 'senha_admin2');
-- Inserir dados na tabela Alertas
INSERT INTO Alertas (Tipo, DestinatarioID, Mensagem, DataHoraEnvio)
VALUES
  ('Alerta Tipo A', 1, 'Mensagem de alerta para o usuário 1', NOW()),
  ('Alerta Tipo B', 2, 'Mensagem de alerta para o usuário 2', NOW());

-- Inserir dados na tabela Propostas
INSERT INTO Propostas (Titulo, Descricao, ResponsavelID, Estado, ArquivoPDF, DataSubmissao, DataAprovacao, AlertaEnviado)
VALUES
  ('Proposta 1', 'Descrição da proposta 1', 1, 'Aprovado', 'caminho/arquivo1.pdf', '2024-01-12', '2024-01-15', 'Sim'),
  ('Proposta 2', 'Descrição da proposta 2', 2, 'Pendente', 'caminho/arquivo2.pdf', '2024-01-13', NULL, 'Não');

-- Inserir dados na tabela Candidaturas
INSERT INTO Candidaturas (ProjetoEstagioID, AlunoID, Estado)
VALUES
  (1, 1, 'Aprovada'),
  (2, 1, 'Pendente');

-- Inserir dados na tabela Check01
INSERT INTO Check01 (id_projeto, Descricao, Campo2, Avaliacao, DataApresentacao)
VALUES
  (1, 'Check01 Projeto 1', 'Campo 2 Projeto 1', 1, NULL),
  (2, 'Check01 Projeto 2', 'Campo 2 Projeto 2', 0, NULL);

-- Inserir dados na tabela Projeto
INSERT INTO Projeto (AlunoID, Projeto, DataSubmissao)
VALUES
  (1, 'Projeto Aluno 1', '2024-01-14'),
  (1, 'Projeto Aluno 2', '2024-01-15');

-- Inserir dados na tabela Cursos
INSERT INTO Cursos (NomeCurso, DepartamentoArea, CoordenadorCursoID)
VALUES
  ('Curso A', 'Departamento A', 1),
  ('Curso B', 'Departamento B', 2);

-- Inserir dados na tabela Vagas
INSERT INTO Vagas (ProjetoEstagioID, NumeroVagas, DescricaoVaga)
VALUES
  (1, 2, 'Vaga 1 para Projeto 1'),
  (2, 1, 'Vaga 1 para Projeto 2');