# EXERCÍCIO 1 - GERENCIAMENTO DE ALUNOS
class Aluno:
    def __init__(self, nome, idade):
        self.nome = nome
        self.idade = idade
        self.notas = []
        
    def adicionar_nota(self, nota):
        self.notas.append(nota)
        
    def media_notas(self):
        if len(self.notas) > 0:
            return sum(self.notas) / len(self.notas)
        else:
            return 0
        
    def exibir_dados(self):
        media = self.media_notas()
        return f"Nome: {self.nome}, Idade: {self.idade}, Média das notas: {media:.2f}"

alunos = []
for i in range(3):
    nome = input("Digite o nome do aluno: ")
    idade = int(input("Digite a idade do aluno: "))
    aluno = Aluno(nome, idade)
    alunos.append(aluno)

for aluno in alunos:
    while True:
        nota = input(f"Digite uma nota para o aluno {aluno.nome} (ou 'sair' para finalizar): ")
        if nota.lower() == 'sair':
            break
        aluno.adicionar_nota(float(nota))

for aluno in alunos:
    print(aluno.exibir_dados())

# ===============================================
# EXERCÍCIO 2 - CATALOGOS DE LIVROS

class Livro:
    def __init__(self, titulo, autor, ano_publicacao, genero):
        self.titulo = titulo
        self.autor = autor
        self.ano_publicacao = ano_publicacao
        self.genero = genero

class Biblioteca:
    def __init__(self):
        self.catalogo = {}
        
    def adicionar_livro(self, livro):
        if livro.genero not in self.catalogo:
            self.catalogo[livro.genero] = set()
        self.catalogo[livro.genero].add(livro.titulo)
        
    def remover_livro(self, titulo):
        for genero, livros in self.catalogo.items():
            if titulo in livros:
                livros.remove(titulo)
                break
            
    def listar_livros_por_genero(self, genero):
        if genero in self.catalogo:
            return self.catalogo[genero]
        return "Gênero não encontrado"

# Programa
biblioteca = Biblioteca()
while True:
    opcao = input("Escolha uma opção:\n[1] Adicionar livro\n[2] Listar por gênero\n[3] Sair: ")
    if opcao == '1':
        titulo = input("Digite o título do livro: ")
        autor = input("Digite o autor do livro: ")
        ano_publicacao = int(input("Digite o ano de publicação: "))
        genero = input("Digite o gênero do livro: ")
        livro = Livro(titulo, autor, ano_publicacao, genero)
        biblioteca.adicionar_livro(livro)
    elif opcao == '2':
        genero = input("Digite o gênero: ")
        print(biblioteca.listar_livros_por_genero(genero))
    elif opcao == '3':
        break

# ===============================================
# EXERCÍCIO 3 - CADASTRO DE FUNCIONARIOS

class Funcionario:
    def __init__(self, nome, departamento, salario):
        self.nome = nome
        self.departamento = departamento
        self.salario = salario

class Empresa:
    def __init__(self):
        self.funcionarios = []
        
    def adicionar_funcionario(self, funcionario):
        self.funcionarios.append(funcionario)
        
    def excluir_funcionario(self, nome):
        self.funcionarios = [f for f in self.funcionarios if f.nome != nome]
        
    def listar_funcionarios_por_departamento(self, departamento):
        for f in self.funcionarios:
            if f.departamento == departamento:
                return f.nome

# Programa
empresa = Empresa()
while True:
    opcao = input("Escolha uma opção: [1] Adicionar funcionário, [2] Listar por departamento, [3] Remover funcionário, [4] Sair: ")
    if opcao == '1':
        nome = input("Digite o nome do funcionário: ")
        departamento = input("Digite o departamento: ")
        salario = float(input("Digite o salário: "))
        funcionario = Funcionario(nome, departamento, salario)
        empresa.adicionar_funcionario(funcionario)
    elif opcao == '2':
        departamento = input("Digite o departamento: ")
        print(empresa.listar_funcionarios_por_departamento(departamento))
    elif opcao == '3':
        nome = input("Digite o nome do funcionário: ")
        empresa.excluir_funcionario(nome)
    elif opcao == '4':
        break

# ===============================================
# EXERCÍCIO 4 - CONTROLE DE ESTOQUE

class Produto:
    def __init__(self, codigo, nome, quantidade):
        self.codigo = codigo
        self.nome = nome
        self.quantidade = quantidade

class Estoque:
    def __init__(self):
        self.produtos = {}
        
    def adicionar_produto(self, produto):
        self.produtos[produto.codigo] = produto
        
    def remover_produto(self, codigo):
        if codigo in self.produtos:
            del self.produtos[codigo]
            
    def listar_produtos(self):
        for p in self.produtos.values():
            return f"Código: {p.codigo}\nNome: {p.nome}\nQuantidade: {p.quantidade}"
    
    def verificar_estoque(self):
        for p in self.produtos.values():
            if p.quantidade > 10:
                return p.nome

# Programa
estoque = Estoque()
while True:
    opcao = input("Escolha uma opção: [1] Adicionar produto\n[2] Remover produto\n[3] Listar produtos\n[4] Verificar estoque\n[5] Sair: ")
    if opcao == '1':
        codigo = input("Digite o código do produto: ")
        nome = input("Digite o nome do produto: ")
        quantidade = int(input("Digite a quantidade do produto: "))
        produto = Produto(codigo, nome, quantidade)
        estoque.adicionar_produto(produto)
    elif opcao == '2':
        codigo = input("Digite o código do produto: ")
        estoque.remover_produto(codigo)
    elif opcao == '3':
        print(estoque.listar_produtos())
    elif opcao == '4':
        print(estoque.verificar_estoque())
    elif opcao == '5':
        break

