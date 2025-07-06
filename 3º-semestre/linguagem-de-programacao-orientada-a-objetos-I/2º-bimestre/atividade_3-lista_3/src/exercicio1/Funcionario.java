package exercicio1;

public class Funcionario {
    protected String nome;
    protected double salario;

    public Funcionario(String nome, double salario) {
        this.nome = nome;
        this.salario = salario;
    }

    public void addAumento(double valor) {
        this.salario += valor;
    }

    public double ganhoAnual() {
        return this.salario * 12;
    }

    public void exibeDados() {
        System.out.println("Nome: " + nome);
        System.out.printf("Salário: R$ %.2f%n", salario);
    }
}
