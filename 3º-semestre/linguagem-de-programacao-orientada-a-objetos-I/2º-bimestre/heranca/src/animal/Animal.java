package animal;

public class Animal {
	private String nome;
	private String raca;
	public Animal( String nome, String raca) {
		this.nome=nome;
		this.raca=raca;
	}
	
	public void emitirSom() {
		System.out.println("o Animal está emitindo som!");	
		}
	
	public String getNome() {
		return nome;
	}
	public void setNome(String nome) {
		this.nome = nome;
	}
	public String getRaca() {
		return raca;
	}
	public void setRaca(String raca) {
		this.raca = raca;
	}
}