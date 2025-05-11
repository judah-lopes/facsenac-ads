package lista1;

import java.util.Scanner;

public class Ex4_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        Ex4_Intervalos intervalo = new Ex4_Intervalos();
        int valor;

        while (true) {
            System.out.print("Digite um número (negativo para sair): ");
            valor = sc.nextInt();
            if (valor < 0) break;
            intervalo.classificar(valor);
        }

        intervalo.imprimirResultados();
        sc.close();
    }
}
