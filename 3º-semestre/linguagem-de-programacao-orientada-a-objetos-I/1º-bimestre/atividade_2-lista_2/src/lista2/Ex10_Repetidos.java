package lista2;

public class Ex10_Repetidos {
    private int[] numeros;

    public Ex10_Repetidos(int[] numeros) {
        this.numeros = numeros;
    }

    public void verificarRepetidos() {
        boolean encontrou = false;
        for (int i = 0; i < numeros.length; i++) {
            for (int j = i + 1; j < numeros.length; j++) {
                if (numeros[i] == numeros[j]) {
                    System.out.println("Valor repetido: " + numeros[i]);
                    encontrou = true;
                    break;
                }
            }
        }
        if (!encontrou) {
            System.out.println("Nenhum valor repetido encontrado.");
        }
    }
}