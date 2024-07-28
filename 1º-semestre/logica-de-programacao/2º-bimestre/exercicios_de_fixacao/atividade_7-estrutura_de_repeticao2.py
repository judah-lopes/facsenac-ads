# 1)
c = 42
while c <= 60:
    print(c)
    c = c + 2

# -------------------------------------------------------------------------------
# 2)
c = 0
soma = 0
while c < 10:
    c = c + 1
    idade = int(input('Digite a idade: '))
    soma += idade

print(f'A média das idades é {soma / 10}')

# -------------------------------------------------------------------------------
# 3 - a)
c = 0
while c < 20:
    c = c + 1

# b)
c = 30
while c > 0:
    print(c)
    c = c - 5

# c)

c = 0
votos_a = 0
votos_b = 0

while c < 10:
    c = c + 1
    voto = int(input('Digite o voto (1 ou 2): '))
    if voto == 1:
        votos_a += 1
    elif voto == 2:
        votos_b += 1
    else:
        print('Voto inválido!')

print(f'Votos A: {votos_a}\nVotos B: {votos_b}')

# -------------------------------------------------------------------------------
# 4)
for c in range(10, 31, 1):
    print(c)

# -------------------------------------------------------------------------------
# 5)
for c in range(1, 20, 2):
    print(c)

# -------------------------------------------------------------------------------
# 6 - a)
for c in range(21):
    print(c)

# b)
for c in range(31, 1, -2):
    print(c)

# c)
maiores = 0
for c in range(0, 20, 1):
    idade = int(input('Digite a idade: '))
    if idade >= 18:
        maiores += 1

print(f'{maiores} pessoas são maiores de idade')

# -------------------------------------------------------------------------------
# 7)
for x in range(30, 61, 3):
    print(x)

# -------------------------------------------------------------------------------
# 8)
for x in range(30, 121, 6):
    print(x)

# -------------------------------------------------------------------------------
# 9)
for x in range(400, -1, -50):
    print(x)

# -------------------------------------------------------------------------------
# 10)
p = 0
m = 0
g = 0
for x in range (10):
	tamanho = input(f'qual o tamanho da {x + 1}ª camiseta? ')
	if tamanho.upper() == 'P':
		p += 1
	elif tamanho.upper() == 'M':
		m += 1
	elif tamanho.upper() == 'G':
		g += 1 
	else: 
		print('Tamanho inválido')

print(f'P = {p}\nM = {m}\nG = {g}')

# -------------------------------------------------------------------------------
# 11) 
m = 0
soma_m = 0
f = 0
soma_f = 0

for x in range(10):
    sexo = input(f'Qual o sexo da {x + 1}° pessoa?(M ou F) ')
    idade = int(input(f'Qual a idade da {x + 1}° pessoa? '))
    
    if sexo.upper() == 'M':
        soma_m += idade
        m += 1
    elif sexo.upper() == 'F':
        soma_f += idade
        f += 1
    else:
        print('Sexo inválido')

print(f'M = {soma_m / m}\nF = {soma_f / f}')

# ------------------------------------------------------------------------------- 
# 12)
maior = 0

for x in range(10):
    peso = float(input(f'Digite o peso da {x + 1}° pessoa: '))
    if peso > maior:
        maior = peso

print(f'Maior peso = {maior}')
   