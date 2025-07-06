package exercicio1;

public class Assistente extends Funcionario {
    private String matricula;

    public Assistente(String nome, double salario, String matricula) {
        super(nome, salario);
        this.matricula = matricula;
    }

    public String getMatricula() {
        return matricula;
    }

    public void setMatricula(String matricula) {
        this.matricula = matricula;
    }

    @Override
    public void exibeDados() {
        super.exibeDados();
        System.out.println("Matrícula: " + matricula);
    }
}
