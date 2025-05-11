package lista1;

public class Ex8_Fatorial {
    public long calcularFatorial(int a) {
        long fatorial = 1;
        System.out.print(a + "! = ");
        for (int i = a; i > 0; i--) {
            System.out.print(i);
            if (i > 1) System.out.print(" x ");
            fatorial *= i;
        }
        System.out.println(" = " + fatorial);

        // Comentário: A multiplicação é feita do número até 1, acumulando o resultado.
        return fatorial;
    }
}
