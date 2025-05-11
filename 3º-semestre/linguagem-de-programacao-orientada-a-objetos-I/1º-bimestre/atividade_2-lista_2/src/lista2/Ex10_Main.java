package lista2;

import java.util.Scanner;

public class Ex10_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int[] valores = new int[10];

        for (int i = 0; i < valores.length; i++) {
            System.out.print("Digite um número: ");
            valores[i] = sc.nextInt();
        }

        Ex10_Repetidos verificador = new Ex10_Repetidos(valores);
        verificador.verificarRepetidos();

        sc.close();
    }
}