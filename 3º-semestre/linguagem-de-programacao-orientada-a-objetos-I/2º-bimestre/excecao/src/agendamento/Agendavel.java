package agendamento;
import excecoes.AgendamentoExeception;

public interface Agendavel {
    void agendarConsulta(String data) throws AgendamentoExeception;
}
