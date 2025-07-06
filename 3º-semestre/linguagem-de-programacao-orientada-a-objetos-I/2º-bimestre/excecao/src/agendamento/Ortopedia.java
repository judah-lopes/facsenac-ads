package agendamento;

public class Ortopedia extends Especialidade{

    public Ortopedia(String nomeMedico, String pacienteCpf) {
        super(nomeMedico, pacienteCpf);
    }
    
    @Override
    public void agendarConsulta(String data) throws AgendamentoExeception {
        if(super.getPacienteCpf().length() != 11) {
            throw new AgendamentoExeception("Apenas números");
        }

        System.out.println("Consulta agendada com sucesso para o dia" + data + "!");
    }

    @Override
    public String getNomeEspecialidade() {
        return "Ortopedia";
    }
}
