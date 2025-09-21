package com.example.crud.repository;

import com.example.crud.entity.Autor;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface AutorRepository extends JpaRepository<Autor, Long> {
    // Métodos customizados podem ser adicionados aqui se necessário
}

