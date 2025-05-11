package lista2;

import java.util.Scanner;

public class Ex7_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        double[] notas = new double[15];

        for (int i = 0; i < notas.length; i++) {
            System.out.print("Nota do aluno " + (i + 1) + ": ");
            notas[i] = sc.nextDouble();
        }

        Ex7_MediaAlunos media = new Ex7_MediaAlunos(notas);
        System.out.printf("Média geral: %.2f\n", media.calcularMedia());

        sc.close();
    }
}