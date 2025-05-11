package lista1;

public class Ex5_ParImparMedia {
    private int pares = 0, impares = 0, total = 0;
    private int somaPares = 0, somaTotal = 0;

    public void adicionar(int valor) {
        if (valor % 2 == 0) {
            pares++;
            somaPares += valor;
        } else {
            impares++;
        }
        somaTotal += valor;
        total++;
    }

    public double mediaPares() {
        return pares > 0 ? (double) somaPares / pares : 0;
    }

    public double mediaGeral() {
        return total > 0 ? (double) somaTotal / total : 0;
    }

    public int getPares() { return pares; }
    public int getImpares() { return impares; }
}
