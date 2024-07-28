# CONJUNTOS

lib = {"Vasco", "Botafogo", "Palmeiras", "Flamengo", "Santos", "Bragantino"}
bra = {"Goiás", "Santos", "Vasco", "Gama", "Flamengo"}

# a) 
ambos = lib + bra

# b) 
lib_apenas = lib - bra

# c)
bra_apenas = bra - lib

# d)
lib_ou_bra = lib | bra

print("a) Times que ganharam a Libertadores e o Brasileirão:")
print(ambos)

print("\nb) Times que ganharam a Libertadores e não ganharam o Brasileirão:")
print(lib_apenas)

print("\nc) Times que ganharam o Brasileirão e não ganharam a Libertadores:")
print(bra_apenas)

print("\nd) Times que ganharam a Libertadores ou o Brasileirão:")
print(lib_ou_bra)

# --------------------------------------------------------------
# VETORES

def ler_precos():
    precos = []
    for i in range(10):
        preco = float(input(f"Digite o preço do {i+1}° produto: "))
        precos.append(preco)
    return precos

precos = ler_precos()

soma = sum(precos)
maior_preco = max(precos)
menor_preco = min(precos)

print(f"\nSomatório dos preços: R$ {soma:.2f}")
print(f"Maior preço: R$ {maior_preco:.2f}")
print(f"Menor preço: R$ {menor_preco:.2f}")

# --------------------------------------------------------------
# MATRIZES

def ler_matriz():
    matriz = []
    for i in range(4):
        linha = []
        for j in range(4):
            elemento = int(input(f"Digite o elemento da posição [{i + 1}][{j + 1}]: "))
            linha.append(elemento)
        matriz.append(linha)
    return matriz

def diagonal_secundaria(matriz):
    print("Elementos da diagonal secundária:")
    for i in range(4):
        print(matriz[i][3 - i], end=' ')
    print()

def imprimir_matriz(matriz):
    print("Matriz 4x4:")
    for linha in matriz:
        for elemento in linha:
            print(elemento, end=' ')
        print()  


matriz = ler_matriz()
imprimir_matriz(matriz)
diagonal_secundaria(matriz)