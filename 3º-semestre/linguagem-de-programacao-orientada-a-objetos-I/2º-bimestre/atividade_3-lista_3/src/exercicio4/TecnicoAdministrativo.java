package exercicio4;

public class TecnicoAdministrativo extends Pessoa {
    private String setor;

    public TecnicoAdministrativo(String nome, String cpf, String setor) {
        super(nome, cpf);
        this.setor = setor;
    }

    @Override
    public void exibirDados() {
        super.exibirDados();
        System.out.println("Setor: " + setor);
    }
}
