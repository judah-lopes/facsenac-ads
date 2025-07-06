package academia;

import java.util.Scanner; // Make sure to import Scanner

public class Avaliacao {
    private String nomeAluno;
    private double notaAluno; // Stores the final, potentially weighted, grade

    // Constructor to initialize the student's name
    public Avaliacao(String nome) {
        this.nomeAluno = nome;
        this.notaAluno = 0.0; // Initialize notaAluno to 0.0 by default
    }

    // Method to register a note without weight (assuming weight is 1.0)
    public void registrarNota(double nota) {
        Scanner sc = new Scanner(System.in); // Scanner for input validation
        
        // Input validation loop for the note
        while (nota < 0 || nota > 10) {
            System.out.println("Nota inválida! Por favor, digite uma nota entre 0 e 10:");
            nota = sc.nextDouble();
        }
        this.notaAluno = nota; // Assign the validated note
        sc.close(); // Close the scanner to prevent resource leaks (important!)
    }

    // Overloaded method to register a note with a specific weight
    public void registrarNota(double nota, double peso) { // Added 'peso' as a parameter
        Scanner sc = new Scanner(System.in); // Scanner for input validation
        
        // Input validation loop for the note
        while (nota < 0 || nota > 10) {
            System.out.println("Nota inválida! Por favor, digite uma nota entre 0 e 10:");
            nota = sc.nextDouble();
        }

        // Input validation loop for the weight
        while (peso < 0.1 || peso > 1) { // Assuming peso should be between 0.1 and 1.0
            System.out.println("Peso inválido! Por favor, digite um peso entre 0.1 e 1.0:");
            peso = sc.nextDouble();
        }

        this.notaAluno = nota * peso; // Apply the weight to the note
        sc.close(); // Close the scanner
    }

    // Getter for the final result string
    public String getResultado() {
        // You might want to format the note to two decimal places
        return "Aluno: " + this.nomeAluno + "\nNota Final: " + String.format("%.2f", this.notaAluno) + "\n";
    }

    // You might also want to add getters for nomeAluno and notaAluno if needed
    public String getNomeAluno(String nomeAluno) {
        return nomeAluno;
    }

    public double getNotaAluno() {
        return notaAluno;
    }
}