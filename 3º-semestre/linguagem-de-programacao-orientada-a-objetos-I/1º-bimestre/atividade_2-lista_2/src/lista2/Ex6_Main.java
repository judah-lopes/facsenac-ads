package lista2;

import java.util.Scanner;

public class Ex6_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int[] entrada = new int[6];

        for (int i = 0; i < entrada.length; i++) {
            System.out.print("Digite um número: ");
            entrada[i] = sc.nextInt();
        }

        Ex6_Inverso vetor = new Ex6_Inverso(entrada);
        vetor.imprimirInverso();

        sc.close();
    }
}