package lista1;

import java.util.Scanner;

public class Ex8_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.print("Digite um número para calcular o fatorial: ");
        int a = sc.nextInt();

        Ex8_Fatorial f = new Ex8_Fatorial();
        f.calcularFatorial(a);

        sc.close();
    }
}
