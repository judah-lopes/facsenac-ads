package impressora;

public class ImpressoraColorida extends Impressora {
    
    public ImpressoraColorida() {
        super.imprimir(10);
        super.imprimir("R$", 10);
        System.out.println("Definindo local de logs da aplic");
    }

    public String confLog() {
        return "/var/log/Impressora";
    }

    public void imprimir(String texto) {
        System.out.println("Imprimindo documento colorido: " + texto);
    }
}
