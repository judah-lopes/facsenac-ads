-- ----------- PERGUNTAS -----------

-- 1. Listar nome, vencimento e valor de cada duplicata da tabela.
SELECT D.nome, D.vencimento, D.valor
FROM Vendas.duplicata D;

-- 2. Apresentar o número das duplicatas depositadas no banco Itaú.
SELECT D.numero, D.banco
FROM Vendas.duplicata D
WHERE D.banco = 'itau';

-- 3. Apresentar o número de duplicatas depositadas no banco Itaú - quantidade 'count'

SELECT COUNT(*) AS qtd_itau
FROM Vendas.duplicata D
WHERE D.banco = 'itau';

-- 4. Quais são as duplicatas (número, vencimento, valor e nome) que vencem no ano de 2017.
SELECT D.numero, D.vencimento, D.valor, D.nome
FROM Vendas.duplicata D
WHERE EXTRACT(YEAR FROM D.vencimento) = 2017;

-- 5. Apresentar as duplicatas (número, vencimento, valor e nome) que não estão depositadas nos bancos Itaú e Santander.
SELECT D.numero, D.vencimento, D.valor, D.nome, D.banco
FROM Vendas.duplicata D
WHERE D.banco <> 'itau' AND D.banco <> 'santander';

-- 6. Quanto é o valor da divida o cliente PAPELARIA SILVA, e quais são as duplicatas?
SELECT D.numero, D.valor,
	(SELECT SUM(D1.valor) 
	 FROM Vendas.duplicata D1
	 WHERE D1.nome = 'papelaria silva') AS divida_total
FROM Vendas.duplicata D
WHERE D.nome = 'papelaria silva';

-- 7. Retirar da tabela a duplicata 770710 do cliente LIVRARIA FERNANDES, por ter sido devidamente quitada.
DELETE FROM Vendas.duplicata D WHERE D.numero = 770710;

-- 8. Apresentar uma listagem em ordem alfabética por nome do cliente de todos os campos da tabela.
SELECT * FROM Vendas.duplicata D
ORDER BY D.nome;

-- 9. Apresentar uma listagem em ordem de data de vencimento com o nome do cliente, banco, valor e vencimento.
SELECT D.nome, D.banco, D.valor, D.vencimento
FROM Vendas.duplicata D
ORDER BY D.vencimento;

-- 10. As duplicatas do Banco do Brasil foram transferidas para o Santander.
UPDATE Vendas.duplicata
SET banco = 'santander'
WHERE banco = 'banco do brasil';

-- 11. Quais são os clientes que possuem suas duplicatas depositadas no Banco Bradesco?
SELECT D.nome
FROM Vendas.duplicata D
WHERE D.banco = 'bradesco';

-- 12. Qual é a previsão de recebimento no período de 01/01/2016 até 31/12/2016?
SELECT SUM(D.valor) AS previsao
FROM Vendas.duplicata D
WHERE EXTRACT(YEAR FROM D.vencimento) = 2016;

-- 13. Quanto a empresa tem para receber no período de 01/08/2016 até 30/08/2016?
SELECT SUM(D.valor) AS prev_ago
FROM Vendas.duplicata D
WHERE D.vencimento BETWEEN '2016-08-01' AND '2016-08-30';

-- 14. Quais foram os itens adquiridos pelo cliente ABC PAPELARIA?
SELECT * FROM vendas.duplicata D
WHERE D.nome = 'abc papelaria';

-- 15. Acrescentar uma multa de 15% para todos os títulos que se encontram vencidos no período de 01/01/2016 até 31/12/2016.
UPDATE vendas.duplicata
SET valor = valor * 1.15
WHERE EXTRACT(YEAR FROM vencimento) = 2016;

-- 16. Acrescentar uma multa de 5% para todos os títulos vencidos entre 01/01/2017 e 31/05/2017 que sejam docliente LER E SABER.
UPDATE Vendas.duplicata
SET valor = valor * 1.05
WHERE vencimento BETWEEN '2017-01-01' AND '2017-05-31';

-- 17. Qual é a média aritmética dos valores das duplicatas do ano de 2016?
SELECT ROUND(AVG(D.valor),2) AS media_2016
FROM Vendas.duplicata D
WHERE EXTRACT(YEAR FROM D.vencimento) = 2016;

-- 18. Exiba as duplicatas e nome dos respectivos clientes que possuem duplicatas com valor superior a 10000,00?
SELECT * FROM Vendas.duplicata D
WHERE D.valor > 10000;

-- 19. Qual o valor total das duplicatas lançadas para o banco Santander?
SELECT SUM(D.valor) AS total_santander
FROM Vendas.duplicata D
WHERE D.banco = 'santander';

-- 20. Quais são os clientes que possuem suas duplicatas depositadas nos Bancos Bradesco ou Itaú?
SELECT * FROM Vendas.duplicata D
WHERE D.banco = 'bradesco' OR D.banco = 'itau'
ORDER BY D.banco;