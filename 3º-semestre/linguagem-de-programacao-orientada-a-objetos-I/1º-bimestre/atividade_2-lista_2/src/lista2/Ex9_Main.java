package lista2;

import java.util.Scanner;

public class Ex9_Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        int[] numeros = new int[5];

        for (int i = 0; i < numeros.length; i++) {
            System.out.print("Digite um número: ");
            numeros[i] = sc.nextInt();
        }

        Ex9_MaiorMenor analise = new Ex9_MaiorMenor(numeros);
        System.out.println("Posição do maior valor: " + analise.posicaoMaior());
        System.out.println("Posição do menor valor: " + analise.posicaoMenor());

        sc.close();
    }
}