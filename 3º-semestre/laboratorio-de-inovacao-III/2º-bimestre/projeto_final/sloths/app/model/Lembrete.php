<?php
require_once __DIR__ . '/../config/database.php';

class LembreteModel {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo;
    }

    // Método atualizado para aceitar ordenação
    public function buscarPorUsuario($usuarioId, $ordem = 'DESC') {
        // Valida a ordem para evitar SQL Injection
        $ordemValida = in_array(strtoupper($ordem), ['ASC', 'DESC']) ? strtoupper($ordem) : 'DESC';
        $sql = "SELECT * FROM lembretes WHERE usuario_id = :usuario_id ORDER BY data_lembrete $ordemValida, data_criacao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método atualizado para incluir data_lembrete
    public function criar($usuarioId, $titulo, $cor, $data_lembrete) {
        $sql = "INSERT INTO lembretes (usuario_id, titulo, cor, data_lembrete) VALUES (:usuario_id, :titulo, :cor, :data_lembrete)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':titulo' => $titulo,
            ':cor' => $cor,
            ':data_lembrete' => $data_lembrete
        ]);
        return $this->conn->lastInsertId();
    }
    
    // Método atualizado para incluir data_lembrete
    public function atualizar($lembreteId, $usuarioId, $titulo, $cor, $data_lembrete) {
        $sql = "UPDATE lembretes SET titulo = :titulo, cor = :cor, data_lembrete = :data_lembrete WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':titulo' => $titulo,
            ':cor' => $cor,
            ':data_lembrete' => $data_lembrete,
            ':id' => $lembreteId,
            ':usuario_id' => $usuarioId
        ]);
    }

    public function atualizarStatus($lembreteId, $usuarioId, $concluido) {
        $sql = "UPDATE lembretes SET concluido = :concluido WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':concluido' => $concluido, ':id' => $lembreteId, ':usuario_id' => $usuarioId]);
    }

    public function deletar($lembreteId, $usuarioId) {
        $sql = "DELETE FROM lembretes WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $lembreteId, ':usuario_id' => $usuarioId]);
    }
}