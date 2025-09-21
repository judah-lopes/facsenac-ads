package com.example.crud.service;

import com.example.crud.entity.Autor;
import com.example.crud.repository.AutorRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class AutorService {
    
    @Autowired
    private AutorRepository autorRepository;
    
    public List<Autor> listarAutores() {
        return autorRepository.findAll();
    }
    
    public Optional<Autor> obterAutorPorId(Long id) {
        return autorRepository.findById(id);
    }
    
    public Autor salvarAutor(Autor autor) {
        return autorRepository.save(autor);
    }
    
    public Autor atualizarAutor(Long id, Autor autorAtualizado) {
        Optional<Autor> autorExistente = autorRepository.findById(id);
        if (autorExistente.isPresent()) {
            Autor autor = autorExistente.get();
            autor.setNome(autorAtualizado.getNome());
            autor.setEmail(autorAtualizado.getEmail());
            autor.setBiografia(autorAtualizado.getBiografia());
            return autorRepository.save(autor);
        }
        return null;
    }
    
    public boolean deletarAutor(Long id) {
        if (autorRepository.existsById(id)) {
            autorRepository.deleteById(id);
            return true;
        }
        return false;
    }
}

