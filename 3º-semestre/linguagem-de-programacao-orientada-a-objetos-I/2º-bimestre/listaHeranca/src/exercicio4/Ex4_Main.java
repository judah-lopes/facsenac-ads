package exercicio4;

import java.util.ArrayList;

public class Ex4_Main {
    public static void main(String[] args) {
        ArrayList<Pessoa> pessoas = new ArrayList<>();

        pessoas.add(new Professor("Eduarda", "123.456.789-00", "Matemática"));
        pessoas.add(new Aluno("João Pedro", "987.654.321-00", "2024001"));
        pessoas.add(new TecnicoAdministrativo("Márcio", "111.222.333-44", "TI"));

        System.out.println("---- Lista de Pessoas na Universidade ----");
        for (Pessoa p : pessoas) {
            p.exibirDados();
            System.out.println("-----------------------------------------");
        }
    }
}
