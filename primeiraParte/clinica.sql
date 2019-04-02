--criação do banco ---
CREATE DATABASE  clinica;﻿
--criação das tabelas--
--tabela de convenio--
CREATE TABLE Convenio (
	codigo serial,
	nome varchar(100) NOT NULL,
	CONSTRAINT "ConvenioPK" PRIMARY KEY(codigo)
);
--tabela de paciente--

CREATE TABLE Paciente (
    nome varchar(100) NOT NULL,
    cpf varchar(11),
    telefone varchar(11),
    email varchar(50),
    dataNascimento timestamp NOT NULL,
    rg varchar(10) UNIQUE,
    endereco varchar(100) NOT NULL,
    CONSTRAINT "PacientePK" PRIMARY KEY (cpf)
);
--tabela de medico--

CREATE TABLE Medico (
    nome varchar(100) NOT NULL,
    cpf varchar(11) NOT NULL,
    crm varchar(10),
    salario numeric(7,2) NOT NULL ,
    telefone varchar(11),
    email varchar(50),
    dataNascimento timestamp NOT NULL,
    CONSTRAINT "MedicoPK" PRIMARY KEY (crm)
);
--tabela de consulta--
CREATE TABLE Consulta (
    data_hora timestamp NOT NULL,
    codigo serial,
    crmMedico varchar(10) NOT NULL,
    cpfPaciente varchar(11) NOT NULL,
    codConvenio integer,
    CONSTRAINT "ConsultaPK" PRIMARY KEY (codigo),
    CONSTRAINT "ConsutaMedicoFK" FOREIGN KEY (crmMedico)
		REFERENCES Medico (crm)
		on delete cascade
		on update cascade,
    CONSTRAINT "ConsultaPacienteFK" FOREIGN KEY (cpfPaciente)
		REFERENCES Paciente (cpf)
       		on delete cascade		
		on update cascade,
     CONSTRAINT "ConsultaConvenioFK" FOREIGN KEY(codConvenio)
		REFERENCES Convenio (codigo)
		on delete cascade
		on update cascade
);
--tabela conveniopaciente ---
CREATE TABLE ConvenioPaciente (
	codConvenio integer,
	cpfPaciente varchar(11),
	CONSTRAINT "ConvenioPacientePK" PRIMARY KEY (codConvenio,cpfPaciente),
        CONSTRAINT "ConvenioPacienteConvenioFK" FOREIGN KEY (codConvenio)
		REFERENCES Convenio (codigo)
		on delete cascade
		on update cascade,
        CONSTRAINT "ConvenioPacientePacienteFK" FOREIGN KEY (cpfPaciente)
		REFERENCES Paciente (cpf)
		on delete cascade
		on update cascade
);

--inserts--
--insert convenio--
INSERT INTO Convenio (nome) 
           VALUES
		  ('Unimed'),
		  ('Cartão de Todos'),
	          ('IPE'),
	          ('Uniodonto'),
                  ('Promedcal'),
                  ('BradescoDental');

--insert de pacientes--
INSERT INTO Paciente (nome,cpf,telefone,email,dataNascimento,rg,endereco) 
           VALUES ('Suzana Rodrigues', '08432567512','999798443','suzanar@gmail.com', '20/08/1987','105129045',
           'Avenida Portugal 332 Centro'),
                  ('Paulo Ricardo de Souza', '09789723412','991308326','ricardosouza@gmail.com', '05/09/1980','123567678','Jose da Rosa Martins 2466 Santa Rosa'),
		  ('Felipe de melo', '05295065432','984326567','felipemelo@gmail.com', '02/02/1989','111176569',
           'Rua dos Saveiros 191 Parque Marinha'),
           ('Amanda Carvalho', '09743267812','991576789','amandac@gmail.com', '28/10/1980','105109876',
           'Rua Rio Amazonas 1051 Vila Rural'),
	   ('Ariadne Menezes', '07151104383','981454056','ariadnemenzes@gmail.com', '10/04/2001','410424031',
           'Avenida Presidente Vargas 673 Cidade Nova'),
                  ('João Silveira', '06476134337','991856789','joaosilveira@gmail.com', '23/12/1988','562165022',
                  'Avenida Primeiro de Maio 800 Vila Juncao'),
		  ('Ana Clara Do Valle ', '06607371329','981234567','anaclaravalle@gmail.com', '13/05/1998','543086574',
		   'Rua Altamir de Lacerda Nascimento 846 Vila Hidraulica');
--inserts de médico--
INSERT INTO Medico (nome,cpf,crm,salario,telefone,email,dataNascimento) 
           VALUES ('Renan de Oliveira Barboza', '09843256712','23758',5500,'30283918','renanoliveira@gmail.com','15/03/1980'),
		  ('Abel Souto Cruz', '5925670981','23772',6000,'32329321',
           'abelcruz@gmail.com', '23/09/1979'),
		   ('Angela Tornatore', '05209876523','39743',7000,'999773784',
           'angelatornatore@gmail.com', '25/03/1990'),
            ('Ione Fuhrmeister Roessler', '05209876523','21346',6500,'32220302',
           'ione@gmail.com', '24/11/1975');
--insert consulta---
INSERT INTO Consulta (data_hora,crmmedico,cpfpaciente) VALUES 
		  ('28/11/2018 17:30','23758','06607371329'),
		  ('15/01/2019 18:00', '21346', '06476134337'),
		  ('19/12/2018 14:30', '23772', '08432567512'),
		  ('15/11/2018 16:00', '39743', '05295065432'),
		  ('16/12/2018 13:30', '23758', '07151104383'),
		  ('10/09/2018 15:00', '23772', '07151104383');
--insert ConvenioPaciente---
INSERT INTO ConvenioPaciente (codConvenio,cpfPaciente) VALUES 
				('1','06607371329'),('2','06607371329'),('3','06476134337'),('4','08432567512'),('5','07151104383'),('1','07151104383'),('6','05295065432');

--update para colocar codconvenio em consulta---
UPDATE Consulta
SET codconvenio = 5
WHERE cpfPaciente = '06476134337';
UPDATE Consulta
SET codconvenio = 1
WHERE cpfPaciente = '06607371329';
