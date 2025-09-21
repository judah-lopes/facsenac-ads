package com.example.crud.controller;

import com.example.crud.entity.Autor;
import com.example.crud.service.AutorService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/api/autores")
@CrossOrigin(origins = "*")
public class AutorController {
    
    @Autowired
    private AutorService autorService;
    
    @GetMapping
    public ResponseEntity<List<Autor>> listarAutores() {
        List<Autor> autores = autorService.listarAutores();
        return ResponseEntity.ok(autores);
    }
    
    @GetMapping("/{id}")
    public ResponseEntity<Autor> obterAutorPorId(@PathVariable Long id) {
        Optional<Autor> autor = autorService.obterAutorPorId(id);
        if (autor.isPresent()) {
            return ResponseEntity.ok(autor.get());
        }
        return ResponseEntity.notFound().build();
    }
    
    @PostMapping
    public ResponseEntity<Autor> criarAutor(@RequestBody Autor autor) {
        Autor novoAutor = autorService.salvarAutor(autor);
        return ResponseEntity.status(HttpStatus.CREATED).body(novoAutor);
    }
    
    @PutMapping("/{id}")
    public ResponseEntity<Autor> atualizarAutor(@PathVariable Long id, @RequestBody Autor autor) {
        Autor autorAtualizado = autorService.atualizarAutor(id, autor);
        if (autorAtualizado != null) {
            return ResponseEntity.ok(autorAtualizado);
        }
        return ResponseEntity.notFound().build();
    }
    
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deletarAutor(@PathVariable Long id) {
        boolean deletado = autorService.deletarAutor(id);
        if (deletado) {
            return ResponseEntity.noContent().build();
        }
        return ResponseEntity.notFound().build();
    }
}

