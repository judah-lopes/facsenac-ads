package exercicio3;

public class Funcionario {
    protected String nome;
    protected double salarioBase;

    public Funcionario(String nome, double salarioBase) {
        this.nome = nome;
        this.salarioBase = salarioBase;
    }

    public double calcularSalario() {
        return salarioBase;
    }

    public void exibirResumo() {
        System.out.println("Nome: " + nome);
        System.out.println("Cargo: Funcionário");
        System.out.printf("Salário: R$ %.2f\n", calcularSalario());
    }
}
