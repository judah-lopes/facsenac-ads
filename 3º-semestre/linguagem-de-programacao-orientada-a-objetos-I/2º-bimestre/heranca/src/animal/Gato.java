package animal;

public class Gato extends Animal{
	
	public Gato(String nome,String raca) {
		super(nome,raca);
		// TODO Auto-generated constructor stub
		
	}
	public void emitirSom() {
		super.emitirSom();
		System.out.println("O Gato"+ super.getNome()+"de raça"+ super.getRaca()+ "está miando!");
	}
}