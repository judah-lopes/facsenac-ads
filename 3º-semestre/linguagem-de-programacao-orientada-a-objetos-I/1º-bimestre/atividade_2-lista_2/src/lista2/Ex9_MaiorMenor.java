package lista2;

public class Ex9_MaiorMenor {
    private int[] valores;

    public Ex9_MaiorMenor(int[] valores) {
        this.valores = valores;
    }

    public int posicaoMaior() {
        int maior = valores[0];
        int pos = 0;
        for (int i = 1; i < valores.length; i++) {
            if (valores[i] > maior) {
                maior = valores[i];
                pos = i;
            }
        }
        return pos;
    }

    public int posicaoMenor() {
        int menor = valores[0];
        int pos = 0;
        for (int i = 1; i < valores.length; i++) {
            if (valores[i] < menor) {
                menor = valores[i];
                pos = i;
            }
        }
        return pos;
    }
}