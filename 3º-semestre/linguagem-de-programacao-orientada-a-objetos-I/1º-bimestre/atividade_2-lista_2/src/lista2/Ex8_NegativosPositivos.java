package lista2;

public class Ex8_NegativosPositivos {
    private double[] numeros;

    public Ex8_NegativosPositivos(double[] numeros) {
        this.numeros = numeros;
    }

    public int contarNegativos() {
        int cont = 0;
        for (double n : numeros) {
            if (n < 0) cont++;
        }
        return cont;
    }

    public double somarPositivos() {
        double soma = 0;
        for (double n : numeros) {
            if (n > 0) soma += n;
        }
        return soma;
    }
}