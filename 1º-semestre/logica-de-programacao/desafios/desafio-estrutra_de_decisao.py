nome = input('Digite seu nome: ')
salario_base = float(input('Digite seu salário bruto: '))
print(f'Cargos:\n1 - Analista\n2 - Técnico\n3 - Auxiliar')
cargo = int(input('Selecione seu cargo (1 - 3): '))
tempo_de_servico = float(input('Digite seu tempo de serviço (em anos): '))
quantidade_dependentes = int(input('Digite a quantidade de dependentes: '))

def calcular_salario_liquido():
    def calcular_salario_bruto():
        def calc_gratificacao_tempo():
            return salario_base * 0.01 * tempo_de_servico

        def calc_gratificacao_cargo():
            if cargo == 1:
                return salario_base * 0.25
            elif cargo == 2:
                return salario_base * 0.15
            elif cargo == 3:
                return salario_base * 0.1
            return 0

        salario_bruto = salario_base + calc_gratificacao_tempo() + calc_gratificacao_cargo()
        return salario_bruto

    def calcular_despesas(salario_bruto):
        def calc_inss():
            if salario_bruto <= 1320:
                return salario_bruto * 0.075 
            elif salario_bruto <= 2571.29:
                return 1320 * 0.075 + (salario_bruto - 1320) * 0.09
            elif salario_bruto <= 3856.94:
                return 1320 * 0.075 + (2571.29 - 1320) * 0.09 + (salario_bruto - 2571.29) * 0.12
            elif salario_bruto <= 7507.49:
                return 1320 * 0.075 + (2571.29 - 1320) * 0.09 + (3856.94 - 2571.29) * 0.12 + (salario_bruto - 3856.94) * 0.14
            return 0

        def calc_ir(salario_calc_ir):
            if salario_calc_ir <= 1903.98:
                return 0
            elif salario_calc_ir <= 2826.65:
                return salario_calc_ir * 0.075 - 142.80
            elif salario_calc_ir <= 3751.05:
                return salario_calc_ir * 0.15 - 354.80
            elif salario_calc_ir <= 4664.68:
                return salario_calc_ir * 0.225 - 636.13
            else:
                return salario_calc_ir * 0.275 - 869.36

        inss = calc_inss()
        salario_calc_ir = salario_bruto - inss - quantidade_dependentes * 189.59
        ir = calc_ir(salario_calc_ir)
        total_despesas = inss + ir
        return inss, ir, total_despesas

    salario_bruto = calcular_salario_bruto()
    inss, ir, total_despesas = calcular_despesas(salario_bruto)
    salario_liquido = salario_bruto - total_despesas

    return salario_liquido, salario_bruto, inss, ir, total_despesas

def cargo_por_extenso(cargo):
    if cargo == 1:
        return 'Analista'
    elif cargo == 2:
        return 'Técnico'
    elif cargo == 3:
        return 'Auxiliar'
    return 'Cargo inválido'

def imprimir_resumo():
    cargo_extenso = cargo_por_extenso(cargo)
    salario_liquido, salario_bruto, inss, ir, total_despesas = calcular_salario_liquido()

    print(f'Nome: {nome}')
    print(f'Cargo por extenso: {cargo_extenso}')
    print(f'Salário base: R${salario_base:.2f}')
    print(f'Salário bruto: R${salario_bruto:.2f}')
    print(f'Desconto INSS: R${inss:.2f}')
    print(f'Desconto IR: R${ir:.2f}')
    print(f'Total de despesas: R${total_despesas:.2f}')
    print(f'Salário líquido: R${salario_liquido:.2f}')

imprimir_resumo()
