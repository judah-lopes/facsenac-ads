package exercicio5;

public class ContaCorrente extends ContaBancaria {
    private double limiteChequeEspecial;
    private String numeroCartaoDebito;

    public ContaCorrente(String titular, double saldoInicial, double limite, String numeroCartao) {
        super(titular, saldoInicial);
        this.limiteChequeEspecial = limite;
        this.numeroCartaoDebito = numeroCartao;
    }

    @Override
    public boolean saque(double valor) {
        if (valor > 0 && valor <= saldo + limiteChequeEspecial) {
            saldo -= valor;
            return true;
        }
        return false;
    }

    @Override
    public void exibirResumo() {
        System.out.println("Titular: " + titular + " (Conta Corrente)");
        System.out.printf("Saldo: R$ %.2f%n", saldo);
        System.out.printf("Limite Cheque Especial: R$ %.2f%n", limiteChequeEspecial);
        System.out.println("Cartão Débito: " + numeroCartaoDebito);
    }
}