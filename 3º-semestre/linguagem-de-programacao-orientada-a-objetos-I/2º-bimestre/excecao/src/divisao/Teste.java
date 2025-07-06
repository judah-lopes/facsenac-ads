package divisao;

import java.util.InputMismatchException;
import java.util.Scanner;

public class Teste {
    public static void main(String[] args) {
        int a = 10;
        int b = 1;
        Scanner entrada = new Scanner(System.in);
        try {
            System.out.println(a / b);

            String nome = "Pedro";
            System.out.println(nome.charAt(0));

            System.out.print("Digite algo: ");
            while(true) {
                try { 
                    int valor = entrada.nextInt();
                    if (valor != 0) {
                        break;
                    }
                } catch (InputMismatchException e) {
                    System.out.println("Digite um valor inteiro (difeterente de 0): ");
                    entrada.nextLine();
                }
            }
        } catch (ArithmeticException erro) {
            //System.err.println(erro.getMessage()); <-- só mostra o erro
            erro.printStackTrace();  // mostra erro + de onde vem
        
        } catch (NullPointerException e) {
            e.printStackTrace();
        
        // } catch (InputMismatchException e) {
        //     System.out.println("Digite um valor inteiro");
        //     e.printStackTrace();
        // }
    }
}