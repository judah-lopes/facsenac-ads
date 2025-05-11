package lista2;

import java.util.Scanner;

public class Ex8_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        double[] valores = new double[10];

        for (int i = 0; i < valores.length; i++) {
            System.out.print("Digite um número real: ");
            valores[i] = sc.nextDouble();
        }

        Ex8_NegativosPositivos analise = new Ex8_NegativosPositivos(valores);
        System.out.println("Números negativos: " + analise.contarNegativos());
        System.out.println("Soma dos positivos: " + analise.somarPositivos());

        sc.close();
    }
}