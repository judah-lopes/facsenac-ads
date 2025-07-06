package exercicio5;

import java.time.LocalDate;

public class ContaPoupanca extends ContaBancaria {
    private double taxaDeJuros;
    private LocalDate dataAniversario;

    public ContaPoupanca(String titular, double saldoInicial, double taxaDeJuros, LocalDate dataAniversario) {
        super(titular, saldoInicial);
        this.taxaDeJuros = taxaDeJuros;
        this.dataAniversario = dataAniversario;
    }

    public double calculaRendimentos() {
        return saldo * (taxaDeJuros / 100);
    }

    @Override
    public void exibirResumo() {
        System.out.println("Titular: " + titular + " (Conta Poupança)");
        System.out.printf("Saldo: R$ %.2f%n", saldo);
        System.out.printf("Taxa de Juros: %.2f%%%n", taxaDeJuros);
        System.out.println("Data de Aniversário: " + dataAniversario);
        System.out.printf("Rendimento Previsto: R$ %.2f%n", calculaRendimentos());
    }
}
