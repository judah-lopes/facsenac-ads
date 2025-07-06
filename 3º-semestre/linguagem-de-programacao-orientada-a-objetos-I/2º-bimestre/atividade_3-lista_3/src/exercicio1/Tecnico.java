package exercicio1;

public class Tecnico extends Assistente {
    private double bonusSalarial;

    public Tecnico(String nome, double salario, String matricula, double bonusSalarial) {
        super(nome, salario, matricula);
        this.bonusSalarial = bonusSalarial;
    }

    @Override
    public double ganhoAnual() {
        return (salario + bonusSalarial) * 12;
    }

    @Override
    public void exibeDados() {
        System.out.println("Cargo: Técnico");
        super.exibeDados();
        System.out.printf("Bônus Salarial: R$ %.2f%n", bonusSalarial);
    }
}
