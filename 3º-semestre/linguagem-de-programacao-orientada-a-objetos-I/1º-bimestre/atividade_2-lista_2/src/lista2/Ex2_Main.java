package lista2;

import java.util.Scanner;
public class Ex2_Main {
	public static void main(String[] args) {
    Scanner sc = new Scanner(System.in);
    int[] entrada = new int[6];

    for (int i = 0; i < entrada.length; i++) {
        System.out.print("Digite um número: ");
        entrada[i] = sc.nextInt();
    }

    Ex2_Leitura vetor = new Ex2_Leitura(6);
    vetor.preencher(entrada);
    vetor.imprimir();

    sc.close();
    }
}