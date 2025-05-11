package lista2;

import java.util.Scanner;

public class Ex4_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int[] valores = new int[10];

        for (int i = 0; i < valores.length; i++) {
            System.out.print("Digite um número: ");
            valores[i] = sc.nextInt();
        }

        Ex4_ContadorPares contador = new Ex4_ContadorPares(valores);
        System.out.println("Quantidade de pares: " + contador.contarPares());

        sc.close();
    }
}