package estrutura;

import java.util.Scanner;

public class JogoDaVelha {

    public void imprimirTabuleiro(String tabuleiro[][]){
        System.out.println("==========IMPRIMIR TABULEIRO=========");
        for (int linha = 0; linha < tabuleiro.length; linha++){
            for (int coluna = 0; coluna < tabuleiro[0].length; coluna++){
                System.out.print(tabuleiro[linha][coluna]+ " ");
            }
            System.out.println();
        } // FIM LINHA
    } // FIM MÉTODO

    public String[][] criarTabuleiro(){
        String tabuleiro[][] = new String[3][3];
        for(int i = 0; i < tabuleiro.length; i++){
            for(int j = 0; j < tabuleiro[0].length; j++){
                tabuleiro[i][j]="-";
            }
        }
        return tabuleiro;
    }
    
    public boolean venceu(String tabuleiro[][], String jogador){
        if (tabuleiro[0][0].equals(jogador) && 
            tabuleiro[0][1].equals(jogador) && 
            tabuleiro[0][2].equals(jogador)){
            return true;
        } else if (tabuleiro[1][0].equals(jogador) && 
                   tabuleiro[1][1].equals(jogador) && 
                   tabuleiro[1][2].equals(jogador)){
            return true;
        } else if (tabuleiro[2][0].equals(jogador) && 
                   tabuleiro[2][1].equals(jogador) && 
                   tabuleiro[2][2].equals(jogador)){
            return true;
        } else if (tabuleiro[0][0].equals(jogador) && 
                   tabuleiro[1][0].equals(jogador) && 
                   tabuleiro[2][0].equals(jogador)){
            return true;
        } else if (tabuleiro[0][1].equals(jogador) && 
                   tabuleiro[1][1].equals(jogador) && 
                   tabuleiro[2][1].equals(jogador)){
            return true;
        } else if (tabuleiro[0][2].equals(jogador) && 
                   tabuleiro[1][2].equals(jogador) && 
                   tabuleiro[2][2].equals(jogador)){
            return true;
        } else if (tabuleiro[0][0].equals(jogador) && 
                   tabuleiro[1][1].equals(jogador) && 
                   tabuleiro[2][2].equals(jogador)){
            return true;
        } else if (tabuleiro[0][2].equals(jogador) && 
                   tabuleiro[1][1].equals(jogador) && 
                   tabuleiro[2][0].equals(jogador)){
            return true;
        } else {
            return false;
        }
    }

    public void jogadas (Scanner input) {
    	String tabuleiro [][] = this.criarTabuleiro();
    	this.imprimirTabuleiro(tabuleiro);
        int contaJogada = 0;
        while (true) {
            contaJogada++;
            System.out.println("Jogador X digite a linha e a coluna:");
            int linha = input.nextInt() - 1;
            int coluna = input.nextInt() - 1;
            tabuleiro=this.jogada(tabuleiro, linha, coluna, "X", input);
            this.imprimirTabuleiro(tabuleiro);
            if (this.venceu(tabuleiro, "X")) {
                System.out.println("Jogador X venceu!");
                break;
            }
            if (contaJogada == 9) {
                break;
            }
            System.out.println("Jogador O digite a linha e a coluna:");
            linha = input.nextInt() - 1;
            coluna = input.nextInt() - 1;
            tabuleiro=this.jogada(tabuleiro, linha, coluna, "O", input);
            this.imprimirTabuleiro(tabuleiro);
            if (this.venceu(tabuleiro, "O")) {
                System.out.println("Jogador O venceu!");
                break;
            }
            if (contaJogada == 9) {
                break;
            }
            System.out.println("Jogador X digite a linha e a coluna:");
            linha = input.nextInt() - 1;
            coluna = input.nextInt() - 1;
            tabuleiro=this.jogada(tabuleiro, linha, coluna, "X", input);
            if (this.venceu(tabuleiro, "O")) {
                System.out.println("Jogador O venceu!");
                break;
            }
            if (contaJogada == 9) {
                break;
            }
            System.out.println("Jogador O digite a linha e a coluna:");
            linha = input.nextInt() - 1;
            coluna = input.nextInt() - 1;
            tabuleiro=this.jogada(tabuleiro, linha, coluna, "O", input);
            this.imprimirTabuleiro(tabuleiro);
        }
        System.out.println("FIM DO JOGO");
    }

    public String [][] jogada(String tabuleiro[][], int linha, int coluna, String jogador, Scanner input) {
        while (!tabuleiro[linha][coluna].equals("-")) {
            System.out.println("Jogador " + jogador + " digite a linha e a coluna novamente:");
            linha = input.nextInt() - 1;
            coluna = input.nextInt() - 1;
        }
        tabuleiro[linha][coluna] = jogador;
        return tabuleiro;
    }   
}


