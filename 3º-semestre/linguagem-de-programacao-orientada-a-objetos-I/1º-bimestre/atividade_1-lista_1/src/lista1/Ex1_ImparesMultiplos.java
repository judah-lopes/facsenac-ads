package lista1;

public class Ex1_ImparesMultiplos {
    public int somarImparesMultiplos() {
        int soma = 0;
        for (int i = 1; i <= 500; i++) {
            if (i % 2 != 0 && i % 3 == 0) {
                soma += i;
            }
        }
        return soma;
    }

    public int contarImparesMultiplos() {
        int cont = 0;
        for (int i = 1; i <= 500; i++) {
            if (i % 2 != 0 && i % 3 == 0) {
                cont++;
            }
        }
        return cont;
    }
}
