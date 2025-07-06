package animal;

public class Animal_Main {
	public static void main(String args[]) {
		Gato objGato= new Gato  ("Garfield","Persa");
		Cachorro objCao= new Cachorro("Querosene","ViraLata");
		objCao.emitirSom();
		objGato.emitirSom();
	}//FIM MAIN
}