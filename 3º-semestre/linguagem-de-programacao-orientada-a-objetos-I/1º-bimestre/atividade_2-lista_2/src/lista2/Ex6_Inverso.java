package lista2;

public class Ex6_Inverso {
    private int[] numeros;

    public Ex6_Inverso(int[] numeros) {
        this.numeros = numeros;
    }

    public void imprimirInverso() {
        for (int i = numeros.length - 1; i >= 0; i--) {
            System.out.print(numeros[i] + " ");
        }
        System.out.println();
    }
}
