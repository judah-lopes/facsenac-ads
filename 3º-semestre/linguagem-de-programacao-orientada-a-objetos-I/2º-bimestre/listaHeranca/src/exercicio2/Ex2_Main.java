package exercicio2;

import java.util.ArrayList;

public class Ex2_Main {
    public static void main(String[] args) {
        ArrayList<Veiculo> veiculos = new ArrayList<>();

        veiculos.add(new CarroAutonomo("Tesla", 2022, 5));
        veiculos.add(new Drone("FIMI", 2023, 8));

        for (Veiculo v : veiculos) {
            System.out.println("-----");
            v.exibirDados();
        }
    }
}
