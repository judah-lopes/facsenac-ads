package academia;

public class Prova extends Avaliacao {
    public Prova(String nome) {
        super(nome); // chamando o construtor da superclasse
    }

    public String getResultado() {
        String auxiliar = super.getResultado();
        if(super.getNotaAluno() >= 7) {
            auxiliar += "Aprovado com nota: " + super.getNotaAluno();
        } else {
            auxiliar += "Reprovado com nota: " + super.getNotaAluno();
        }
        return auxiliar;
    }
}
