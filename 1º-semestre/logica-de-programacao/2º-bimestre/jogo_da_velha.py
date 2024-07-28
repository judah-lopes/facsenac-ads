# Projeto: Jogo da Velha
# Disciplina: Lógica de Programação
# Participantes:
# Amanda Cristiny O. Melo
# Carlos Henrique dos Santos,
# Felipe M. Ventura,
# Letycia Silva de Aguiar,
# Maria Clara R. B. Pinheiro,
# Otávio Mendes Santos,
# Pedro Judah G. N. Lopes,
# Rafael R. Da Silva.

def criar_matriz():
    return [[1, 2, 3], [4, 5, 6], [7, 8, 9]] 

def imprimir_matriz(mat):
    for lin in range(3):
        print(mat[lin][0], "|", mat[lin][1], "|", mat[lin][2])  
        if lin < 2:                                          
            print("-" * 9)

def registrarJogada(mat, posicao, jogador):
    for lin in range(3):
        for col in range(3):
            if mat[lin][col] == posicao:
                mat[lin][col] = jogador
    return mat

def trocarJogador(jogador):
    if jogador == 'X':
        return 'O' 
    else:
        return 'X'

def posicaoOcupada(mat, posicao):
    for lin in range(3):
        for col in range(3):
            if mat[lin][col] == posicao:
                return False
    return True

def verificarGanhador(mat, jogador):
    # Verificar linhas
    for linha in mat:
        if linha.count(jogador) == 3:
            return True
    
    # Verificar colunas
    for col in range(3):
        if mat[0][col] == mat[1][col] == mat[2][col] == jogador:
            return True
    
    # Verificar diagonais
    if mat[0][0] == mat[1][1] == mat[2][2] == jogador:
        return True
    if mat[0][2] == mat[1][1] == mat[2][0] == jogador:
        return True
    
    return False

print("*** JOGO DA VELHA *** \n")
print("Desafie o seu colega no jogo da velha.\n")
print("Regras:")
print(" a) O primeiro jogador participará com a letra X e o segundo com a letra O.")
print(" b) Os números de 1 a 9 representam os espaços que estão livres.")
print("    Você só poderá escolher as posições livres.")

matriz = criar_matriz()  
jogador = "X"  
c = 0

while c < 9:
    print()
    imprimir_matriz(matriz)
    print()

    posicao = int(input(f"(Jogador {jogador}) Informe a posição desejada: "))
    
    if posicaoOcupada(matriz, posicao):
        print("\n Você não pode escolher uma posição que já está ocupada. Tente novamente.")
        continue

    matriz = registrarJogada(matriz, posicao, jogador) 
    
    if verificarGanhador(matriz, jogador):  
        imprimir_matriz(matriz)
        print(f"\n Parabéns, jogador {jogador}! Você venceu!")
        break
    
    jogador = trocarJogador(jogador)  
    c += 1

if c == 9:
    print("\n O jogo empatou!")

imprimir_matriz(matriz)
print("\n Fim de jogo.")