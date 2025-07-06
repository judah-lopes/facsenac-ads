package exercicio3;

public class Estagiario extends Funcionario {
    public Estagiario(String nome, double salarioBase) {
        super(nome, salarioBase);
    }

    @Override
    public void exibirResumo() {
        System.out.println("Nome: " + nome);
        System.out.println("Cargo: Estagiário");
        System.out.printf("Salário: R$ %.2f\n", calcularSalario());
    }
}
