package lista1;

import java.util.Scanner;

public class Ex2_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        double[] alturas = new double[5];

        for (int i = 0; i < alturas.length; i++) {
            System.out.print("Altura " + (i + 1) + ": ");
            alturas[i] = sc.nextDouble();
        }

        Ex2_Alturas analise = new Ex2_Alturas(alturas);
        System.out.println("Maior altura: " + analise.alturaMaxima());
        System.out.println("Menor altura: " + analise.alturaMinima());

        // Comentário: O algoritmo compara cada altura com os valores atuais de maior e menor, atualizando conforme necessário.
        sc.close();
    }
}
