package exercicio1;

public class Ex1_Main {
    public static void main(String[] args) {
        Tecnico tecnico = new Tecnico("João da Silva", 3000.0, "T001", 500.0);
        Administrativo admin = new Administrativo("Maria Oliveira", 2800.0, "A002", "noite", 400.0);
        Assistente assistente = new Assistente("Carlos Mendes", 2500.0, "AS003");

        System.out.println("=== Técnico ===");
        tecnico.exibeDados();
        System.out.printf("Ganho Anual: R$ %.2f%n", tecnico.ganhoAnual());

        System.out.println("\n=== Administrativo ===");
        admin.exibeDados();
        System.out.printf("Ganho Anual: R$ %.2f%n", admin.ganhoAnual());

        System.out.println("\n=== Assistente ===");
        assistente.exibeDados();
        System.out.printf("Ganho Anual: R$ %.2f%n", assistente.ganhoAnual());
    }
}
