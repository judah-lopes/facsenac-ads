-- Criar o schema
CREATE SCHEMA longa_vida;

-- Criar tabela plano
CREATE TABLE longa_vida.plano(
	numero VARCHAR(2) PRIMARY KEY,
	descricao VARCHAR(30),
	valor DECIMAL(10,2)
);

-- Inserções na tabela plano
INSERT INTO longa_vida.plano(numero, descricao, valor) VALUES
('B1', 'BASICO 1', 200),
('B2', 'BASICO 2', 150),
('B3', 'BASICO 3', 100),
('E1', 'EXECUTIVO 1', 350),
('E2', 'EXECUTIVO 2', 300),
('E3', 'EXECUTIVO 3', 250),
('M1', 'MASTER 1', 500),
('M2', 'MASTER 2', 450),
('M3', 'MASTER 3', 500);

-- Criar tabela associado
CREATE TABLE longa_vida.associado(
	plano VARCHAR(2) NOT NULL,
 	nome VARCHAR(40) PRIMARY KEY,
 	endereco VARCHAR(35),
  	cidade VARCHAR(20),
  	estado VARCHAR(2),
  	CEP VARCHAR(9)
);

-- Inserções na tabela associado
INSERT INTO longa_vida.associado(plano, nome, endereco, cidade, estado, CEP) VALUES
('B1', 'JOSE ANTONIO DA SILVA', 'R. FELIPE DO AMARAL, 3450', 'COTIA', 'SP', '06700-000'),
('B1', 'MARIA DA SILVA SOBRINHO', 'R. FELIPE DE JESUS, 1245', 'DIADEMA', 'SP', '09960-170'),
('B1', 'PEDRO JOSE DE OLIVEIRA', 'R. AGRIPINO DIAS, 155', 'COTIA', 'SP', '06700-011'),
('B2', 'ANTONIA DE FERNANDES', 'R. PE EZEQUIEL, 567', 'DIADEMA', 'SP', '09960-175'),
('B2', 'ANTONIO DO PRADO', 'R. INDIO TABAJARA, 55', 'GUARULHOS', 'SP', '07132-999'),
('B3', 'WILSON SENA', 'R. ARAPIRACA, 1234', 'OSASCO', 'SP', '06293-001'),
('B3', 'SILVIA DE ABREU', 'R. DR JOAO DA SILVA, 5', 'SANTO ANDRE', 'SP', '09172-112'),
('E1', 'ODETE DA CONCEICAO', 'R. VOLUNTARIOS DA PATRIA, 10', 'SAO PAULO', 'SP', '02010-550'),
('E2', 'JOAO CARLOS MACEDO', 'R. VISTA ALEGRE, 500', 'SAO PAULO', 'SP', '04343-990'),
('E3', 'CONCEICAO DA SILVA', 'AV. VITORINO DO AMPARO, 11', 'MAUA', 'SP', '09312-998'),
('E3', 'PAULO BRUNO AMARAL', 'R. ARGENZIO BRILHANTE, 88', 'BARUERI', 'SP', '06460-990'),
('E3', 'WALDENICE DE OLIVEIRA', 'R. OURO VELHO, 12', 'BARUERI', 'SP', '06460-998'),
('E3', 'MARCOS DO AMARAL', 'R. DO OUVIDOR, 67', 'GUARULHOS', 'SP', '07031-555'),
('E3', 'MURILO DE SANTANA', 'R. PRATA DA CASA', 'BARUERI', 'SP', '06455-111'),
('M1', 'LUIZA ONOFRE FREITAS', 'R. VICENTE DE ABREU, 55', 'SANTO ANDRE', 'SP', '09060-667'),
('M2', 'MELISSA DE ALMEIDA', 'R. FERNANDO ANTONIO, 2345', 'SAO PAULO', 'SP', '04842-987'),
('M2', 'JOAO INACIO DA CONCEICAO', 'R. PENELOPE CHARMOSA, 34', 'SUZANO', 'SP', '08670-888'),
('B3', 'AUGUSTA DE ABREU', 'AV. RIO DA SERRA, 909', 'SANTO ANDRE', 'SP', '09061-333'),
('B3', 'ILDA DE MELO DA CUNHA', 'AV. POR DO SOL, 546', 'SANTO ANDRE', 'SP', '09199-444'),
('B3', 'MARCOS DA CUNHA', 'AV. PEDROSO DE MORAES, 546', 'SAO PAULO', 'SP', '04040-444');

-- Atualizar CEP
UPDATE longa_vida.associado
SET CEP = '06460-999'
WHERE nome = 'PAULO BRUNO AMARAL';

-- Atualizar Endereco
UPDATE longa_vida.associado
SET endereco = 'R. PRATA DA CASA'
WHERE nome = 'MURILO DE SANTANA';

-- Atualizar plano
UPDATE longa_vida.associado
SET plano = 'M1'
WHERE nome = 'MURILO DE SANTANA';

-- Verificar tudo
SELECT * FROM longa_vida.associado;
SELECT * FROM longa_vida.plano;


-- --------- EXERCÍCIOS --------
-- 1. Quais campos das tabelas associado e plano devem ser utilizados para efetuar o relacionamento entre as tabelas?

--		Resposta:  Deve-se utilizar o campo "plano" da tabela associado e o campo "numero" da tabela plano.

-- 2. Extrair uma relação geral de todos os associados e os planos que eles possuem.
SELECT A.nome AS nome, P.descricao AS plano
FROM longa_vida.associado A
JOIN longa_vida.plano P ON A.plano = P.numero;

-- 3. Quantos associados possuem o plano B1?
SELECT COUNT(*) AS qtd_b1
FROM longa_vida.associado A
WHERE A.plano = 'B1';

-- 4. Apresente uma relação com todos os nomes, planos e valores de todos os registros de associados.
SELECT A.nome AS nome, A.plano AS plano, P.valor AS valor
FROM longa_vida.associado A
JOIN longa_vida.plano P ON A.plano = P.numero;

-- 5. Quais são os associados que moram em COTIA ou em DIADEMA?
SELECT A.nome, A.cidade 
FROM longa_vida.associado A
WHERE A.cidade IN ('COTIA', 'DIADEMA');

-- 6. Apresente o nome, plano e valor dos associados que moram em BARUERI e possuem o plano M1.
SELECT A.nome AS nome, A.plano AS plano, P.valor AS valor
FROM longa_vida.associado A
JOIN longa_vida.plano P ON A.plano = P.numero
WHERE A.cidade = 'BARUERI' AND A.plano = 'M1';

-- 7. Apresente uma relação com nome, plano e valor de todos os associados residentes em São Paulo
SELECT A.nome AS nome, A.plano AS plano, P.valor AS valor
FROM longa_vida.associado A
JOIN longa_vida.plano P ON A.plano = P.numero
WHERE A.cidade = 'SAO PAULO';

-- 8. Apresente uma relação completa de todos os campos de ambas as tabelas em que o associado possua SILVA no nome.
SELECT *
FROM longa_vida.associado A
JOIN longa_vida.plano P ON A.plano = P.numero
WHERE A.nome LIKE '%SILVA%';

-- 9. Devido ao aumento do índice IGPM, a empresa reajustou os valores dos planos básicos em 10%, dos planos
UPDATE longa_vida.plano 
SET valor = valor * 1.1
WHERE descricao LIKE '%BASICO%';

-- 10. O associado PEDRO JOSE DE OLIVEIRA alterou seu plano de B1 para E3. Faça a devida atualização.
UPDATE longa_vida.associado
SET plano = 'E3'
WHERE nome = 'PEDRO JOSE DE OLIVEIRA';