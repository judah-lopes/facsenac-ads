package veiculo;

public class Carro extends Veiculo{
	private int portas,cavalos;
	public Carro(String placa, String cor, String marca, String modelo, int rodas, String categoria, int portas, int cavalos) {
		super(placa, cor, marca, modelo, rodas, categoria);
		this.portas=portas;
		this.cavalos=cavalos;
		
	}//FIM CONSTRUTOR
	
	public void acelerar() {
		super.acelerar();
		if(super.getCategoria().equals("ESPORTIVO"))
		{
			System.out.println("Um Carro esportivo não leva mais que 6 segundos!!");
		}
		else if (super.getCategoria().equals("COMPACTO")) {
			System.out.println("Não leva mais de 10 Segundos");
		}
		else if (super.getCategoria().equals("MEDIO")) {
			System.out.println("Não leva mais de 10 Segundos");}
		
		else if (super.getCategoria().equals("POPULAR")) {
			System.out.println("Não leva mais de 14 Segundos");}
	}//FIM ACELERAR
	
	public int getPortas() {
		return portas;
	}
	public void setPortas(int portas) {
		this.portas = portas;
	}
	public int getCavalos() {
		return cavalos;
	}
	public void setCavalos(int cavalos) {
		this.cavalos = cavalos;
	}

}//Fim Class