package lista1;

import java.util.Scanner;

public class Ex7_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.print("Digite um número de 1 a 10: ");
        int n = sc.nextInt();

        if (n >= 1 && n <= 10) {
            Ex7_Tabuada tabuada = new Ex7_Tabuada();
            tabuada.mostrarTabuada(n);
        } else {
            System.out.println("Número inválido.");
        }

        sc.close();
    }
}
