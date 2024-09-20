
# limite = int(input('digite o limite: '))
# init = 2

# if init >= limite:
#     init = 0

# for i in range(init, limite):
#     print(i)

# # -----------------------------------------------------------------------------
# # Exercício 2 - lista de frutas
frutas = [input('digite uma fruta: ') for i in range(3)]
for fruta in frutas:
    print(f'Qual a fruta? {fruta}')

# -----------------------------------------------------------------------------
# Exercício 3 - soma dos quadrados
soma = 0
multi = 1
for i in range(1, 11):
   soma = soma + i**2
   multi = multi * i**2

print(f'a soma é {soma}')
print(f'a multiplicação é {multi}')

# -----------------------------------------------------------------------------
# Exercício 4 - Senha
#senha = input('digite a senha: ')
#contador= 0
#while senha != '1234':
#    contador+=1
#    if contador == 3:
#        print('Acesso bloqueado')
#        break
#    senha= input ('Digite a senha novamente: ')
#if contador !=3:
#    print('Acesso permitido')

# -----------------------------------------------------------------------------
# Exercício 5 - números primos de um intervalo
#for num in range (2,20):
#    primo= True
#    i=2
#    while i <= num //2:
#        if num % i==0:
#            primo=False 
#            break
#        i+=1
#    if primo:
#        print(f'{num} é primo')