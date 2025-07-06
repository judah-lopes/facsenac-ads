package exercicio5;

public class ContaBancaria {
    protected String titular;
    protected double saldo;

    public ContaBancaria(String titular, double saldoInicial) {
        this.titular = titular;
        this.saldo = saldoInicial;
    }

    public void deposito(double valor) {
        if (valor > 0) {
            saldo += valor;
        }
    }

    public boolean saque(double valor) {
        if (valor > 0 && valor <= saldo) {
            saldo -= valor;
            return true;
        }
        return false;
    }

    public boolean transferencia(ContaBancaria outraConta, double valor) {
        if (this.saque(valor)) {
            outraConta.deposito(valor);
            return true;
        }
        return false;
    }

    public void exibirResumo() {
        System.out.println("Titular: " + titular);
        System.out.printf("Saldo: R$ %.2f%n", saldo);
    }
}
