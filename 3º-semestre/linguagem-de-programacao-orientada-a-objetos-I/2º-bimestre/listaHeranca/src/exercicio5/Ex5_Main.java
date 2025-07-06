package exercicio5;

import java.time.LocalDate;

public class Ex5_Main {
    public static void main(String[] args) {
        ContaCorrente cc = new ContaCorrente("Alice", 1000.00, 500.00, "1234-5678-9012-3456");
        ContaPoupanca cp = new ContaPoupanca("Bruno", 2000.00, 1.5, LocalDate.of(2025, 6, 15));

        cc.deposito(200);
        cc.saque(300);
        cp.transferencia(cc, 500);

        System.out.println("Resumo da Conta Corrente:");
        cc.exibirResumo();

        System.out.println("\nResumo da Conta Poupança:");
        cp.exibirResumo();
    }
}
