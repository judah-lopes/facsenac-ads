package lista2;

public class Ex3_VetorQuadrado {
    private double[] numeros;
    private int[] quadrados;

    public Ex3_VetorQuadrado(int tamanho) {
        numeros = new double[tamanho];
        quadrados = new int[tamanho];
    }

    public void preencher(double[] valores) {
        for (int i = 0; i < valores.length; i++) {
            numeros[i] = valores[i];
            quadrados[i] = (int)(valores[i] * valores[i]);
        }
    }

    public void imprimir() {
        System.out.print("Originais: ");
        for (double n : numeros) System.out.print(n + " ");
        System.out.print("\nQuadrados: ");
        for (double q : quadrados) System.out.print(q + " ");
        System.out.println();
    }
}