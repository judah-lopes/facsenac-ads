package exercicio3;

public class Gerente extends Funcionario {
    public Gerente(String nome, double salarioBase) {
        super(nome, salarioBase);
    }

    @Override
    public double calcularSalario() {
        return salarioBase * 1.2; // 20% de adicional
    }

    @Override
    public void exibirResumo() {
        System.out.println("Nome: " + nome);
        System.out.println("Cargo: Gerente");
        System.out.printf("Salário: R$ %.2f\n", calcularSalario());
    }
}