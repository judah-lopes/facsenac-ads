package exercicio3;

public class Analista extends Funcionario {
    public Analista(String nome, double salarioBase) {
        super(nome, salarioBase);
    }

    @Override
    public double calcularSalario() {
        return salarioBase * 1.1; // 10% de adicional
    }

    @Override
    public void exibirResumo() {
        System.out.println("Nome: " + nome);
        System.out.println("Cargo: Analista");
        System.out.printf("Salário: R$ %.2f\n", calcularSalario());
    }
}
