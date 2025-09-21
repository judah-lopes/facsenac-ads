package com.example.crud.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.crud.entity.Livro;

@Repository
public interface LivroRepository extends JpaRepository<Livro, Long> {
    // Métodos customizados podem ser adicionados aqui se necessário
}

