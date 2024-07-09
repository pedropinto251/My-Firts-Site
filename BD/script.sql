-- Banco de dados: dsos
USE master;
GO

-- Drop do banco de dados se existir
--IF EXISTS (SELECT name FROM sys.databases WHERE name = 'dsos')
    DROP DATABASE dsos;
--GO

-- Criar o banco de dados
CREATE DATABASE dsos;
GO

-- Usar o banco de dados
USE dsos;
GO

-- Definir tabelas
CREATE TABLE Usuarios (
  id INT PRIMARY KEY NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL
);

CREATE TABLE aluno (
  id INT PRIMARY KEY NOT NULL, 
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL
);
CREATE TABLE docentes (
  id INT PRIMARY KEY NOT NULL,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  CoordenadorCursoID INT NOT NULL -- Adicionando a coluna CoordenadorCursoID
);

CREATE TABLE empresas (
  id INT PRIMARY KEY NOT NULL,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  pessoa_contacto VARCHAR(255) NOT NULL
);

CREATE TABLE admin (
  id INT NOT NULL,
  nome VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL
);

CREATE TABLE Alertas (
  id_destinatario INT PRIMARY KEY NOT NULL,
  Tipo VARCHAR(20) NOT NULL,
  DestinatarioID INT NOT NULL,
  Mensagem TEXT NOT NULL,
  DataHoraEnvio DATETIME NOT NULL
);
CREATE TABLE Login (
  id_login INT PRIMARY KEY NOT NULL,
  tipo VARCHAR(20) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Senha VARCHAR(255) NOT NULL,
  id INT NOT NULL,
  CONSTRAINT FK_Login_Alertas FOREIGN KEY (id) REFERENCES Alertas(id_destinatario)
);

CREATE TABLE Propostas (
  id INT PRIMARY KEY NOT NULL,
  Titulo VARCHAR(255) NOT NULL,
  Descricao TEXT NOT NULL,
  ResponsavelID INT NOT NULL,
  Estado VARCHAR(20) NOT NULL,
  ArquivoPDF VARCHAR(255) NOT NULL,
  DataSubmissao DATE NOT NULL,
  DataAprovacao DATE NOT NULL,
  AlertaEnviado CHAR(3) NOT NULL,
  CONSTRAINT FK_Propostas_docentes_new FOREIGN KEY (ResponsavelID) REFERENCES docentes(id)
);


CREATE TABLE Candidaturas (
  id INT PRIMARY KEY NOT NULL,
  ProjetoEstagioID INT NOT NULL,
  AlunoID INT NOT NULL,
  Estado VARCHAR(20) NOT NULL,
  CONSTRAINT FK_Candidaturas_Propostas_new FOREIGN KEY (ProjetoEstagioID) REFERENCES Propostas(id),
  CONSTRAINT FK_Candidaturas_aluno FOREIGN KEY (AlunoID) REFERENCES aluno(id)
);

-- ...
CREATE TABLE Check01 (
  ID INT PRIMARY KEY NOT NULL,
  id_projeto INT NOT NULL,
  Descricao TEXT NOT NULL,
  Campo2 VARCHAR(255) NOT NULL,
  Avaliacao BIT NOT NULL
);
CREATE TABLE Projeto (
  Id_projeto INT PRIMARY KEY NOT NULL,
  AlunoID INT NOT NULL,
  Projeto VARCHAR(255) NOT NULL,
  DataSubmissao DATE NOT NULL,
  CONSTRAINT FK_Projeto_Check01 FOREIGN KEY (Id_projeto) REFERENCES Check01(ID)
);

CREATE TABLE Cursos (
  IDCurso INT PRIMARY KEY NOT NULL,
  NomeCurso VARCHAR(255) NOT NULL,
  DepartamentoArea VARCHAR(100) NOT NULL,
  CoordenadorCursoID INT NOT NULL,
  CONSTRAINT FK_docentes_Cursos FOREIGN KEY (CoordenadorCursoID) REFERENCES docentes(id)
);



CREATE TABLE Vagas (
  IDVaga INT PRIMARY KEY NOT NULL,
  ProjetoEstagioID INT NOT NULL,
  NumeroVagas INT NOT NULL,
  DescricaoVaga TEXT NOT NULL,
  CONSTRAINT FK_Propostas_Vagas FOREIGN KEY (ProjetoEstagioID) REFERENCES Propostas(id)
);

-- Adicionar restrições de chave estrangeira
ALTER TABLE aluno ADD CONSTRAINT FK_aluno_Usuarios FOREIGN KEY (id) REFERENCES Usuarios(id);
ALTER TABLE docentes ADD CONSTRAINT FK_docentes_Usuarios FOREIGN KEY (id) REFERENCES Usuarios(id);
ALTER TABLE empresas ADD CONSTRAINT FK_empresas_Usuarios FOREIGN KEY (id) REFERENCES Usuarios(id);
ALTER TABLE admin ADD CONSTRAINT FK_admin_Usuarios FOREIGN KEY (id) REFERENCES Usuarios(id);
ALTER TABLE Login ADD CONSTRAINT FK_Login_Usuarios FOREIGN KEY (id) REFERENCES Usuarios(id);
ALTER TABLE Propostas ADD CONSTRAINT FK_Propostas_docentes FOREIGN KEY (ResponsavelID) REFERENCES docentes(id);
ALTER TABLE Candidaturas ADD CONSTRAINT FK_Candidaturas_Propostas FOREIGN KEY (ProjetoEstagioID) REFERENCES Propostas(id);


