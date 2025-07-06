package veiculo;

public class Veiculo {
	private String placa, cor, marca, modelo, categoria;
	private int rodas;

	// Construtor
	public Veiculo(String placa, String cor, String marca, String modelo, int rodas, String categoria) {
		this.placa = placa;
		this.cor = cor;
		this.marca = marca;
		this.modelo = modelo;
		this.rodas = rodas;
		this.categoria=categoria;
	} // FIM CONSTRUTOR

	public void acelerar() {
		System.out.println ("Quantidade de Segundos de 0 a 100!");
	}
	
	
	public String getCategoria() {
		return categoria;
	}

	public void setCategoria(String categoria) {
		this.categoria = categoria;
	}

	public void exibirInfo() {
		System.out.println ("*Informações do Veiculo*");
		System.out.println ("Marca:"+this.marca);
		System.out.println ("Modelo:"+this.modelo);
		System.out.println ("Placa:"+this.placa);
		System.out.println ("Cor:"+this.cor);
		System.out.println ("Quantidade de rodas:"+this.rodas);
		System.out.println ("Qual Categoria?"+ this.categoria);
	}// FIM METODO
	
	public String getPlaca() {
		return placa;
	}

	public void setPlaca(String placa) {
		this.placa = placa;
	}

	public String getCor() {
		return cor;
	}

	public void setCor(String cor) {
		this.cor = cor;
	}

	public String getMarca() {
		return marca;
	}

	public void setMarca(String marca) {
		this.marca = marca;
	}

	public String getModelo() {
		return modelo;
	}

	public void setModelo(String modelo) {
		this.modelo = modelo;
	}

	public int getRodas() {
		return rodas;
	}

	public void setRodas(int rodas) {
		this.rodas = rodas;
	}
	
}