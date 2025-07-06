package exercicio3;

public class Ex3_Main {
    public static void main(String[] args) {
        Funcionario gerente = new Gerente("Marcos", 8000);
        Funcionario analista = new Analista("Clara", 5000);
        Funcionario estagiario = new Estagiario("Lucas", 2000);

        System.out.println("-----");
        gerente.exibirResumo();
        System.out.println("-----");
        analista.exibirResumo();
        System.out.println("-----");
        estagiario.exibirResumo();
    }
}
