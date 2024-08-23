# EXERCÍCIO 1 ----------------
valores = [float(input(f"Insira o {n+1}º valor: ")) for n in range(3)]
soma = sum(valores[:2])

print(f"{soma} {'é maior' if soma > valores[2] else 'não é maior'} que {valores[2]}")

# EXERCÍCIO 2 --------------
nome = input("Insira seu nome: ")
sexo = input("Insira seu sexo (M ou F): ")
estado_civil = int(("Qual seu estado civil? \n 1 - SOLTEIRO(A) \n 2 - CASADO(A) \n 3 - VIUVO(A) \n 4 - DIVORCIADO(A)"))

if sexo.upper() == 'F' and estado_civil == 2:
    tempo_de_casadx = int(input("Insira seu tempo de casamento (em anos): "))

# EXERCÍCIO 3 ---------------
numero = int(input("Insira um número: "))
print(f"{numero} é {'par' if numero % 2 == 0 else 'ímpar'}")

# EXERCÍCIO 4 ---------------
numero_1, numero_2 = int(input("Insira um número: ")), int(input("Insira outro número: "))
c = numero_1 + numero_2 if numero_1 == numero_2 else numero_1 * numero_2

print(c)

# EXERCÍCIO 5 ---------------
number = float(input("Insira um número: "))
print(number * (2 if number > 0 else 3))

# EXERCÍCIO 6 ---------------
bool1, bool2 = bool(int(input("0 ou 1: "))), bool(int(input("0 ou 1: ")))

print(f"Ambos são {'VERDADEIROS' if bool1 and bool2 else 'FALSOS' if not bool1 and not bool2 else 'Um é VERDADEIRO e o outro FALSO'}")

# EXERCÍCIO 7 ---------------
nombre = int(input("Insira um número: "))
print(nombre + (5 if nombre % 2 == 0 else 8))

# EXERCÍCIO 8 ---------------

dias_da_semana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"]

numero = int(input("Digite um número de 1 a 7: "))

if 1 <= numero <= 7:
    print(dias_da_semana[numero - 1])
else:
    print("Número inválido! Por favor, digite um número de 1 a 7.")