package impressora;

public class Impressora_Main {
    
    public static void main(String[] args) {
        Impressora impressora = new Impressora();
        ImpressoraColorida impressoraColorida = new ImpressoraColorida();
        impressora.imprimir(10);
        impressora.imprimir("R$", 10);
        impressoraColorida.imprimir(10);
        impressoraColorida.imprimir("R$", 10);
        System.out.println(impressoraColorida.confLog());
    }
    
}
