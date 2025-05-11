package lista2;

public class Ex4_ContadorPares {
    private int[] numeros;

    public Ex4_ContadorPares(int[] numeros) {
        this.numeros = numeros;
    }

    public int contarPares() {
        int cont = 0;
        for (int n : numeros) {
            if (n % 2 == 0) {
                cont++;
            }
        }
        return cont;
    }
}
