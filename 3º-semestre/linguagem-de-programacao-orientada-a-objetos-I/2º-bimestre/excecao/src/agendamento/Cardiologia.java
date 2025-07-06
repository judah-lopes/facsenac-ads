package agendamento;

import java.time.LocalDate;

import excecoes.AgendamentoExeception;

public class Cardiologia extends Consulta implements Agendavel{
    
    public Cardiologia(String nome, String cpf) {
        super(nome, cpf);
    }
    
    @Override
    public void agendarConsulta(String data) throws AgendamentoExeception {
        LocalDate dia = LocalDate.parse(data);
        if (dia.getDayOfWeek() == 6 || dia.getDayOfWeek() == 7) {
            throw new AgendamentoExeception("Cardiologia só em dias úteis.");
        }

        System.out.println("Consulta agendada com sucesso para o dia" + data + "!");
    }

    @Override
    public String getNomeEspecialidade() {
        return "Cardiologia";
    }
    
}
