package academia;

import java.util.ArrayList;

public class Academia_Main {
    
    public static void main(String[] args) {
        
        ArrayList<Avaliacao> alunos = new ArrayList<Avaliacao>();        
        Prova pr = new Prova("Pedro");
        pr.registrarNota(6,0.8);
        Trabalho tr = new Trabalho("João");
        tr.registrarNota(8.2,0.2);
        Projeto pj = new Projeto("Maria");
        pj.registrarNota(7.5,0.5);

        alunos.add(pr);
        alunos.add(tr);
        alunos.add(pj);
        
        for (Avaliacao aluno : alunos) {
            if(aluno instanceof Prova p1) {
                System.out.println(p1.getResultado());
                System.out.println();
            } else if(aluno instanceof Trabalho t1) {
                System.out.println(t1.getResultado());
                System.out.println();
            } else if(aluno instanceof Projeto) {
                Projeto p2 = (Projeto) aluno;
                System.out.println(p2.getResultado());
                System.out.println();
            }
            //     System.out.println("O aluno " + aluno.getNomeAluno() + " tirou " + aluno.getResultado() + " na prova.");                
            // } else if(aluno instanceof Trabalho) {
            //     System.out.println("O aluno " + aluno.getNomeAluno() + " tirou " + aluno.getResultado() + " no trabalho.");                
            // } else if(aluno instanceof Projeto) {
            //     System.out.println("O aluno " + aluno.getNomeAluno() + " tirou " + aluno.getResultado() + " no projeto.");                
            // }
        }
    }
}
