package lista1;

import java.util.Scanner;

public class Ex5_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        Ex5_ParImparMedia analise = new Ex5_ParImparMedia();
        int valor;

        do {
            System.out.print("Digite um número (0 para sair): ");
            valor = sc.nextInt();
            if (valor > 0) {
                analise.adicionar(valor);
            }
        } while (valor != 0);

        System.out.println("Pares: " + analise.getPares());
        System.out.println("Ímpares: " + analise.getImpares());
        System.out.printf("Média dos pares: %.2f\n", analise.mediaPares());
        System.out.printf("Média geral: %.2f\n", analise.mediaGeral());

        // Comentário: Números pares são os que têm resto 0 ao dividir por 2 (valor % 2 == 0)
        sc.close();
    }
}
