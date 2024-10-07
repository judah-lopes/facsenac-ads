# EXERCÍCIO 1 ----------------
contagem, soma = 0, 0
for i in range(500):
    if i % 2 == 1 and i % 3 == 0:
        soma += i
        contagem += 1

print(f'\nSoma = {soma}, total de numéros = {contagem}')

# EXERCÍCIO 2 ----------------
alturas = [float(input(f'Digite a {i + 1}° altura: ')) for i in range(5)]

maior, menor = max(alturas), min(alturas)

print(f'\nA maior altura é: {maior}, a menor altura é: {menor}')

# EXERCÍCIO 3 ----------------
valores, contador_positivos, contador_negativos = [], 0, 0
while True:
    try:
        valor = float(input('Insira um valor (ou 0 para parar): '))
        if valor == 0:
            break
        else:
            valores.append(valor)
    except ValueError:
        print('Valor inválido! Insira um número.')

for i in valores:
    if i > 0:
        contador_positivos += 1
    elif i < 0:
        contador_negativos += 1

porcentagem_positivos = (contador_positivos / len(valores)) * 100
porcentagem_negativos = (contador_negativos / len(valores)) * 100

media = sum(valores) / len(valores)

print(f'\nMedia aritmetica = {media:.1f}\nPorcentagem de positivos = {porcentagem_positivos:.2f}%\nPorcentagem de negativos = {porcentagem_negativos:.2f}%')

# EXERCÍCIO 4 ----------------
numeros, intervalo_1, intervalo_2, intervalo_3, intervalo_4 = [], [], [], [], []
while True:
    try:
        numero = float(input('Insira um numero positivo (ou negativo para parar): '))
        if numero < 0:
            break
        else:
            numeros.append(numero)
    except ValueError:
        print('Valor inválido! Insira um número.')

for i in numeros:
    if 0 >= i <= 25:
        intervalo_1.append(i)
    elif 26 >= i <= 50:
        intervalo_2.append(i)
    elif 51 >= i <= 75:
        intervalo_3.append(i)
    elif 76 >= i <= 100:
        intervalo_4.append(i)
    else:
        print('Numero inválido!')

print(f'\nIntervalo 1: {len(intervalo_1)} resultados (0 - 25)\nIntervalo 2: {len(intervalo_2)} resultados (26 - 50)\nIntervalo 3: {len(intervalo_3)} resultados (51 - 75)\nIntervalo 4: {len(intervalo_4)} resultados (76 - 100)')

# EXERCÍCIO 5 ----------------
nums, pares, contador_impares = [], [], 0
while True:
    try:
        num = float(input('Insira um número positivo (ou 0 para parar): '))
        if num == 0:
            break
        elif num < 0:
            print('Número inválido! Insira um número positivo.')
        else:
            nums.append(num)
    except ValueError:
        print('Valor inválido! Insira um número.')

for i in nums:
    if i % 2 == 0: 
        pares.append(i)
    else:
        contador_impares += 1

media_pares = sum(pares) / len(pares)
media_total = sum(nums) / len(nums)

print(f'\nTotal de impares = {contador_impares}\nTotal de pares = {len(pares)}\nMedia dos pares = {media_pares:.1f}\nMedia geral = {media_total:.1f}\n\nO programa diferencia números pares verificando se o módulo (resto da divisão) é 0. Se for, é par, senão, é impar.')

# EXERCÍCIO 6 ----------------
for i in range(100, 200):
    if i % 2 == 1:
        print(i, end=' ')

print('\nO programa calcula os números impares de 100 a 200, por meio de um laço de repetição "for", verificando se o módulo (resto da divisão) é 1. Se for, é impar, senão, é par.')

# EXERCÍCIO 7 ----------------
number = int(input('Insira um número de 0 a 10: '))    

for i in range(1, 11):
    print(f'{number} x {i} = {number * i}')

print('\nO programa calcula a tabuada do número inserido, por meio de um laço de repetição "for" que percorre em um intervalo de 10 vezes, sempre usando o número da vez para múltiplicar o número inserido pelo usuário.\nA formtação foi feita usando as f-strings.\n')

# EXERCÍCIO 8 ----------------
valur = int(input('Insira um número: '))
fatorial = 1

for i in range(valur, 0, -1):
    fatorial *= i

print(f'{valur}! = {fatorial}\nAgora, o número inserido é multiplicado pelo número da vez no laço de repetição que vai decrescendo conforme definido pelo intervalo do range ser negativo')                                                                                                                                                                                                                                                                                                                        

# ---------------------------------------------------------------------

#      1. Desenvolva um algoritmo que, dentro de um intervalo específico de números (de 1
# a 500), selecione e some os números que atendam a dois critérios: serem ímpares e
# também múltiplos de três. Além disso, exiba o total de números que atenderam a
# esses critérios.

#      2. Escreva um algoritmo que leia a altura de 5 participantes de uma pesquisa. Após a
# leitura, o programa deve identificar e exibir as alturas máxima e mínima registradas.
# Explique como o algoritmo determina esses valores ao longo da execução.

#      3. Crie um programa que solicite ao usuário uma quantidade indefinida de valores
# numéricos. O programa deve calcular e exibir a média aritmética dos números
# inseridos, além de contar quantos desses números são positivos e quantos são
# negativos. Finalmente, calcule e apresente a porcentagem de números positivos e
# negativos. Considere que o usuário deve inserir pelo menos um número positivo e
# um negativo.

#      4. Desenvolva um programa que receba uma série de números de forma contínua até
# que um valor negativo seja inserido. O programa deve contar quantos números caem
# dentro dos seguintes intervalos: [0-25], [26-50], [51-75], [76-100]. Depois que o valor
# negativo for inserido, exiba o total de números contados em cada intervalo e faça
# uma breve análise dos resultados.

#      5. Implemente um programa que leia uma sequência de números positivos,
# encerrando a leitura quando o número zero for inserido. O programa deve contar
# quantos números pares e ímpares foram inseridos, além de calcular a média dos
# números pares e a média geral dos números lidos. Inclua uma explicação de como o
# programa diferencia números pares de ímpares.

#      6. Crie um programa que gere e exiba todos os números ímpares situados entre 100 e
# 200. Explique como o programa decide se um número é ímpar e como ele percorre o
# intervalo especificado.

#      7. Escreva um programa que solicite ao usuário um valor N, entre 1 e 10, e calcule a
# tabuada desse número. A tabuada deve ser exibida de maneira organizada,
# mostrando cada operação de multiplicação, de 0 a 10, e o respectivo resultado.
# Discuta como o programa realiza o cálculo da tabuada e formata os resultados.

#      8. Desenvolva um programa que receba um valor inicial A e imprima a sequência de
# operações necessárias para calcular o fatorial de A, além de exibir o resultado final
# do cálculo. Como exemplo, mostre a sequência de multiplicações e o resultado final
# para o fatorial de 5. Explique como o programa gerencia o processo de multiplicação
# em sequência