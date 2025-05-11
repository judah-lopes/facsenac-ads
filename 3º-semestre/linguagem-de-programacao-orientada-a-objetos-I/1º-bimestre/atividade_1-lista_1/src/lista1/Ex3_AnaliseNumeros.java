package lista1;

public class Ex3_AnaliseNumeros {
    private int positivos = 0;
    private int negativos = 0;
    private int total = 0;
    private double soma = 0;

    public void adicionar(double valor) {
        if (valor > 0) positivos++;
        else if (valor < 0) negativos++;
        soma += valor;
        total++;
    }

    public double calcularMedia() {
        return soma / total;
    }

    public double percentualPositivos() {
        return (double) positivos / total * 100;
    }

    public double percentualNegativos() {
        return (double) negativos / total * 100;
    }
}
