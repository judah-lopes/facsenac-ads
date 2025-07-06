<?php
require_once __DIR__ . '/../config/database.php';

class EventoModel {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo;
    }

    public function criar($dados) {
        $sql = "INSERT INTO eventos (usuario_id, titulo, descricao, cor, data_inicio, data_fim) 
                VALUES (:usuario_id, :titulo, :descricao, :cor, :data_inicio, :data_fim)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($dados);
    }

    public function atualizar($dados) {
        $sql = "UPDATE eventos SET titulo = :titulo, descricao = :descricao, cor = :cor, data_inicio = :data_inicio, data_fim = :data_fim 
                WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($dados);
    }

    public function deletar($id, $usuarioId) {
        $sql = "DELETE FROM eventos WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id, ':usuario_id' => $usuarioId]);
    }

    public function buscarPorMes($usuarioId, $ano, $mes) {
        $sql = "SELECT DAY(data_inicio) as dia FROM eventos 
                WHERE usuario_id = :usuario_id AND YEAR(data_inicio) = :ano AND MONTH(data_inicio) = :mes 
                GROUP BY DAY(data_inicio)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId, ':ano' => $ano, ':mes' => $mes]);
        // Retorna um array simples com os dias que têm eventos, ex: [5, 12, 23]
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function buscarPorDia($usuarioId, $data) {
        $sql = "SELECT * FROM eventos 
                WHERE usuario_id = :usuario_id AND DATE(data_inicio) = :data 
                ORDER BY data_inicio ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId, ':data' => $data]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}