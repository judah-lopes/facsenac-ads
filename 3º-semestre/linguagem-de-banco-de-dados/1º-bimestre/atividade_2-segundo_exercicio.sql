-- Criação do schema
CREATE SCHEMA Vendas;

-- Criação da tabela no schema
CREATE TABLE Vendas.duplicata (
	nome CHAR(40),
    numero INTEGER NOT NULL,
    valor DECIMAL(10,2),
    vencimento DATE,
    banco CHAR(10),
    PRIMARY KEY (numero)
);

-- Alteração do tipo da coluna 'banco'
ALTER TABLE Vendas.duplicata 
ALTER COLUMN banco TYPE VARCHAR(40);

-- Inserções iniciais
INSERT INTO Vendas.duplicata (nome, numero, valor, vencimento, banco) VALUES
('abc papelaria', 100100, 5000.00, '2017-01-20', 'itau'),
('livraria fernandes', 100110, 2500.00, '2017-01-22', 'itau'),
('livraria fernandes', 100120, 1500.00, '2016-10-15', 'bradesco'),
('abc papelaria', 100130, 8000.00, '2016-10-15', 'santander');

-- Mais inserções
INSERT INTO Vendas.duplicata (nome, numero, valor, vencimento, banco) VALUES
('ler e saber', 200120, 10500.00, '2018-04-26', 'banco do brasil'),
('livros e cia', 200125, 2000.00, '2018-04-26', 'banco do brasil'),
('ler e saber', 200130, 11000.00, '2018-09-26', 'itau'),
('papelaria silva', 250350, 1500.00, '2018-01-26', 'bradesco'),
('livros mm', 250360, 500.00, '2018-12-18', 'santander'),
('livros mm', 250370, 3400.00, '2018-04-26', 'santander'),
('papelaria silva', 250380, 3500.00, '2018-04-26', 'banco do brasil'),
('livros e cia', 453360, 1500.00, '2018-06-15', 'itau'),
('livros mm', 453365, 5400.00, '2018-06-15', 'bradesco'),
('papelaria silva', 453370, 2350.00, '2017-12-27', 'itau'),
('livros e cia', 453380, 1550.00, '2017-12-27', 'banco do brasil'),
('abc papelaria', 980130, 4000.00, '2016-12-11', 'itau'),
('papel e afins', 985502, 2500.00, '2016-03-12', 'itau');

-- Atualização do número de uma duplicata
UPDATE Vendas.duplicata
SET Numero = 985001
WHERE Numero = 980130;

-- Inserção de novo registro
INSERT INTO Vendas.duplicata (nome, numero, valor, vencimento, banco)
VALUES ('ler e saber', 888132, 2500.00, '2017-03-05', 'itau');

-- Atualização do banco - ignora "USE"
UPDATE Vendas.duplicata
SET banco = 'santander'
WHERE numero = 985002;

-- Remoção de registros
DELETE FROM Vendas.duplicata WHERE numero = 888132;
DELETE FROM Vendas.duplicata WHERE numero = 985001;
DELETE FROM Vendas.duplicata WHERE numero = 985502;

-- Reinserções
INSERT INTO Vendas.duplicata (nome, numero, valor, vencimento, banco) VALUES 
('abc papelaria', 980130, 4000.00, '2016-12-11', 'itau'),
('livraria fernandes', 770710, 2500.00, '2016-11-15', 'santander'),
('abc papelaria', 985001, 3000.00, '2016-09-11', 'itau'),
('papel e afins', 985002, 2500.00, '2016-03-12', 'santander'),
('ler e saber', 888132, 2500.00, '2017-03-05', 'itau');

-- Consultas
SELECT * FROM Vendas.duplicata;
SELECT COUNT(*) FROM Vendas.duplicata;