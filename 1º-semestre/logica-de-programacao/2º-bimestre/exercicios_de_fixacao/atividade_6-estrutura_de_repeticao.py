# 1 - A)
c = 0

while c > 0:
    print(c)
    c = c - 1

print("Acabou!")

# ------------------------
# 1 - B)
x = 2

for x in range(0, 101, 2):
    print(x)

print("Acabou!")

# ------------------------
# 1 - C)
for x in range(1, 102, 2):
    print(x)

print("Acabou!")

# ------------------------
# 1 - D)
for x in range(31, 4, -2):
    print(x)

print("Acabou!")

# ------------------------
# 1 - E)
for x in range(7, 71, 7):
    print(x)

print("Acabou!")

# -----------------------------------------------------
# 2 - A)
soma = 0

for x in range(30):
    preco = float(input(f'Digite o preço do {x + 1}° produto: '))
    soma += preco

print(f'Valor total a pagar: R${soma: .2f}')
    
print("Acabou!")

# ------------------------
# 2 - B)
homem = 0
mulher = 0

for x in range(20):
    sexo = input(f'Digite o sexo da {x + 1}° pessoa: ')
    if sexo.upper() == 'M':
        homem += 1
    else:
        mulher += 1

print(f'Homens: {homem}\nMulheres: {mulher}')        
# -----------------------------------------------------
# 3 - A)
for x in range(2, 251, 2):
    print(x)

print("Acabou!")

# ------------------------
# 3 - B)
for x in range(5, 556, 5):
    print(x)

print("Acabou!")

# ------------------------
# 3 - C)
soma = 0

for x in range(10):
    preco = float(input(f'Digite o preço do produto {x + 1}: '))
    soma += preco

print(f'Soma: {soma: .2f}')

# ------------------------
# 3 - D)
crianca = 0
jovem = 0
adulto = 0

for x in range(20):
    idade = int(input(f'Digite a idade da {x + 1}° pessoa: '))
    if idade <= 13:
        crianca += 1
    elif idade > 14 and idade <= 24:
        jovem += 1
    elif idade > 24:
        adulto += 1
    else:
        print('Idade inválida!')

print(f'Criancas: {crianca}\nJovens: {jovem}\nAdultos: {adulto}')

# -----------------------
# 3 - E)
maior = 0.0

for x in range(5):
    preco = float(input(f'Digite o valor do {x + 1}° produto: '))

    if preco > maior: 
        maior = preco

print(f'O maior é R${maior: .2f}')

# -----------------------
# 3 - F)
homem = 0
notas_homem = 0.0
mulher = 0
notas_mulher = 0.0

for x in range(10):
    sexo = input(f'Digite o sexo da {x + 1}° pessoa: ')
    nota = float(input(f'Digite a nota da {x + 1}° pessoa: '))
    if sexo.upper() == 'M':
        homem += 1
        notas_homem += nota
    else:
        mulher += 1
        notas_mulher += nota

media_homem = notas_homem / homem
media_mulher = notas_mulher / mulher

print(f'Media de notas dos homens: {media_homem: .2f}\nMedia de notas das mulheres: {media_mulher: .2f}')
