package lista2;

import java.util.Scanner;

public class Ex3_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        double[] entrada = new double[5];

        for (int i = 0; i < entrada.length; i++) {
            System.out.print("Digite um número real: ");
            entrada[i] = sc.nextDouble();
        }

        Ex3_VetorQuadrado vetor = new Ex3_VetorQuadrado(5);
        vetor.preencher(entrada);
        vetor.imprimir();

        sc.close();
    }
}