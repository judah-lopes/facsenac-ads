package agendamento;

public class MarcarConsulta {
    
    public static void main(String[] args) {
        
        Cardiologia cardio = new Cardiologia("João", "12345678900");
        Ortopedia orto = new Ortopedia("Maria", "987.654.321-00");
        
        try {
            cardio.agendarConsulta("2025-06-28");
        } catch (AgendamentoExeception e) {
            e.printStackTrace();
        }
6
        try {
            orto.agendarConsulta("2025-06-30");
        } catch (AgendamentoExeception e) {
            e.printStackTrace();
        }
    }
}
