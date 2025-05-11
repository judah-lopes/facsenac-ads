package lista2;

public class Ex2_Leitura {
    private int[] numeros;

    public Ex2_Leitura(int tamanho) {
        numeros = new int[tamanho];
    }

    public void preencher(int[] valores) {
        for (int i = 0; i < numeros.length; i++) {
            numeros[i] = valores[i];
        }
    }

    public void imprimir() {
        for (int n : numeros) {
            System.out.print(n + " ");
        }
        System.out.println();
    }
}