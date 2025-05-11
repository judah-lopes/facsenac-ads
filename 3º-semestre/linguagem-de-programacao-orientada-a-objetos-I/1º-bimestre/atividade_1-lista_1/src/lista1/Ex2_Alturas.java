package lista1;

public class Ex2_Alturas {
    private double[] alturas;

    public Ex2_Alturas(double[] alturas) {
        this.alturas = alturas;
    }

    public double alturaMaxima() {
        double max = alturas[0];
        for (double a : alturas) {
            if (a > max) max = a;
        }
        return max;
    }

    public double alturaMinima() {
        double min = alturas[0];
        for (double a : alturas) {
            if (a < min) min = a;
        }
        return min;
    }
}
