package impressora;

public class Impressora {
    
    public void imprimir() {
        System.out.println("Imprimindo...");
    }
    public void imprimir(int numPaginas) {
        System.out.println("Imprimindo " + numPaginas + " paginas!");
    }

    public void imprimir(String moeda, int qtdCedulas) {
        System.out.println("Imprimindo " + qtdCedulas + " cedulas de " + moeda);
    }

    public int calcTroco(int v1, int v2) {
        return v1 - v2;
    }
}
