package academia;

public class Projeto extends Avaliacao {
    public Projeto(String nome) {
        super(nome);
    }

    public String getResultado() {
        String auxiliar = super.getResultado();
        if(super.getNotaAluno() >= 6) {
            auxiliar += "Aprovado com nota: " + super.getNotaAluno();
        } else {
            auxiliar += "Reprovado com nota: " + super.getNotaAluno();
        }
        return auxiliar;
    }
}
