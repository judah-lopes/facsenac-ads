package lista1;

public class Ex4_Intervalos {
    private int[] contadores = new int[4];

    public void classificar(int valor) {
        if (valor >= 0 && valor <= 25) contadores[0]++;
        else if (valor <= 50) contadores[1]++;
        else if (valor <= 75) contadores[2]++;
        else if (valor <= 100) contadores[3]++;
    }

    public void imprimirResultados() {
        System.out.println("[0-25]: " + contadores[0]);
        System.out.println("[26-50]: " + contadores[1]);
        System.out.println("[51-75]: " + contadores[2]);
        System.out.println("[76-100]: " + contadores[3]);

        // Comentário: Os valores são classificados conforme os intervalos usando simples condições.
    }
}
