package lista2;

public class Ex5_MaiorValor {
    private int[] numeros;

    public Ex5_MaiorValor(int[] numeros) {
        this.numeros = numeros;
    }

    public int getMaior() {
        int maior = numeros[0];
        for (int n : numeros) {
            if (n > maior) {
                maior = n;
            }
        }
        return maior;
    }

    public int getPosicaoMaior() {
        int maior = numeros[0];
        int pos = 0;
        for (int i = 1; i < numeros.length; i++) {
            if (numeros[i] > maior) {
                maior = numeros[i];
                pos = i;
            }
        }
        return pos;
    }

    public void imprimir() {
        for (int n : numeros) {
            System.out.print(n + " ");
        }
        System.out.println();
    }
}

