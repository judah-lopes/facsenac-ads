package veiculo;

public class Moto extends Veiculo{

    private int cilindradas;
    private boolean compartimento;
    
    

	public Moto(String placa, String cor, String marca, 
            String modelo, int rodas, String categoria,
            int cilindradas, boolean compartimento) {
		super(placa, cor, marca, modelo, rodas, categoria);
		// TODO Auto-generated constructor stub
        this.cilindradas=cilindradas;
        this.compartimento=compartimento;
	}
	
}