package lista2;

public class Ex1_Vetor {
    private int[] elementos = new int[6];

    public Ex1_Vetor() {
        elementos = new int[]{1, 0, 5, -2, -5, 7};
    }

    public int somaSelecionada() {
        return elementos[0] + elementos[1] + elementos[5];
    }

    public void modificarPosicao4() {
        elementos[4] = 100;
    }

    public void imprimir() {
        for (int n : elementos) {
            System.out.print(n + " ");
        }
        System.out.println();
    }
}
