package lista1;

import java.util.Scanner;

public class Ex3_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        Ex3_AnaliseNumeros analise = new Ex3_AnaliseNumeros();
        double valor;

        do {
            System.out.print("Digite um número (0 para sair): ");
            valor = sc.nextDouble();
            if (valor != 0) {
                analise.adicionar(valor);
            }
        } while (valor != 0);

        System.out.printf("Média: %.2f\n", analise.calcularMedia());
        System.out.printf("%% Positivos: %.2f\n", analise.percentualPositivos());
        System.out.printf("%% Negativos: %.2f\n", analise.percentualNegativos());

        // Comentário: O programa conta positivos/negativos e usa a fórmula porcentagem = (parte / total) * 100
        sc.close();
    }
}