package exercicio2;

public class CarroAutonomo extends Veiculo {
    private int nivelAutonomia; // de 1 a 5

    public CarroAutonomo(String marca, int anoFabricacao, int nivelAutonomia) {
        super(marca, anoFabricacao);
        this.nivelAutonomia = nivelAutonomia;
    }

    @Override
    public void exibirDados() {
        super.exibirDados();
        System.out.println("Nível de Autonomia: " + nivelAutonomia);
    }
}
