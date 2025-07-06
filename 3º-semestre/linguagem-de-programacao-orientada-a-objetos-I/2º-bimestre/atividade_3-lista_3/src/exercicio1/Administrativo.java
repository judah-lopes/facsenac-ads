package exercicio1;

public class Administrativo extends Assistente {
    private String turno;
    private double adicionalNoturno;

    public Administrativo(String nome, double salario, String matricula, String turno, double adicionalNoturno) {
        super(nome, salario, matricula);
        this.turno = turno.toLowerCase();
        this.adicionalNoturno = adicionalNoturno;
    }

    @Override
    public double ganhoAnual() {
        double salarioFinal = salario;
        if (turno.equals("noite")) {
            salarioFinal += adicionalNoturno;
        }
        return salarioFinal * 12;
    }

    @Override
    public void exibeDados() {
        System.out.println("Cargo: Administrativo");
        super.exibeDados();
        System.out.println("Turno: " + turno);
        if (turno.equals("noite")) {
            System.out.printf("Adicional Noturno: R$ %.2f%n", adicionalNoturno);
        }
    }
}
