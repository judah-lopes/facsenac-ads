package animal;

public class Cachorro extends Animal{
	
	public Cachorro(String nome,String raca) {
		super(nome,raca);
		// TODO Auto-generated constructor stub
		
	}
	public void emitirSom() {
		super.emitirSom();
		System.out.println("O Cachorro"+ super.getNome()+"de raça"+ super.getRaca()+ "esta latindo!");
	}
	
}