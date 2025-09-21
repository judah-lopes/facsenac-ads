package com.example.crud.service;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.crud.entity.Livro;
import com.example.crud.repository.LivroRepository;

@Service
public class LivroService {
    
    @Autowired
    private LivroRepository livroRepository;
    
    public List<Livro> listarLivros() {
        return livroRepository.findAll();
    }
    
    public Optional<Livro> obterLivroPorId(Long id) {
        return livroRepository.findById(id);
    }
    
    public Livro salvarLivro(Livro livro) {
        return livroRepository.save(livro);
    }
    
    public Livro atualizarLivro(Long id, Livro livroAtualizado) {
        Optional<Livro> livroExistente = livroRepository.findById(id);
        if (livroExistente.isPresent()) {
            Livro livro = livroExistente.get();
            livro.setNome(livroAtualizado.getNome());
            livro.setAutor(livroAtualizado.getAutor());
            livro.setPreco(livroAtualizado.getPreco());
            return livroRepository.save(livro);
        }
        return null;
    }
    
    public boolean deletarLivro(Long id) {
        if (livroRepository.existsById(id)) {
            livroRepository.deleteById(id);
            return true;
        }
        return false;
    }
}