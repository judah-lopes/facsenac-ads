package exercicio4;

public class Professor extends Pessoa {
    private String areaAtuacao;

    public Professor(String nome, String cpf, String areaAtuacao) {
        super(nome, cpf);
        this.areaAtuacao = areaAtuacao;
    }

    @Override
    public void exibirDados() {
        super.exibirDados();
        System.out.println("Área de Atuação: " + areaAtuacao);
    }
}
