package academia;

public class Trabalho extends Avaliacao {
    public Trabalho(String nome) {
        super(nome);
    }

    public String getResultado() {
        String auxiliar = super.getResultado();
        if(super.getNotaAluno() >= 5) {
            auxiliar += "Aprovado com nota: " + super.getNotaAluno();
        } else {
            auxiliar += "Reprovado com nota: " + super.getNotaAluno();
        }
        return auxiliar;
    }
}
