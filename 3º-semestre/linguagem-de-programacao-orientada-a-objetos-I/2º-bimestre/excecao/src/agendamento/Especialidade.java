package agendamento;

public abstract class Especialidade implements Agendavel{ //Classe abstrata não pode ser instanciada
                                                          // não é obrigada a implementar a interface
    protected String nomeMedico;                          // mas se implementar, precisa implementar 
    protected String pacienteCpf;                         // todos os métodos da interface

    public Especialidade(String nomeMedico, String pacienteCpf){ // Classe concreta PRECISA implementar todos 
        this.nomeMedico = nomeMedico;                            // os métodos da interface
        this.pacienteCpf = pacienteCpf;
    }

    public abstract String getNomeEspecialidade();

    // getters e setters
    public String getNomeMedico() {
        return this.nomeMedico;
    }

    public void setNomeMedico(String nomeMedico) {
        this.nomeMedico = nomeMedico;
    }

    public String getPacienteCpf() {
        return this.pacienteCpf;
    }
    
    public void setPacienteCpf(String pacienteCpf) {
        this.pacienteCpf = pacienteCpf;
    }
}
