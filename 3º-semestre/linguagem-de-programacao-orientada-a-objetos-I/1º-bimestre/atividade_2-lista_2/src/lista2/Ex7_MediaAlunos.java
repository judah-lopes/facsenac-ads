package lista2;

public class Ex7_MediaAlunos {
    private double[] notas;

    public Ex7_MediaAlunos(double[] notas) {
        this.notas = notas;
    }

    public double calcularMedia() {
        double soma = 0;
        for (double nota : notas) {
            soma += nota;
        }
        return soma / notas.length;
    }
}