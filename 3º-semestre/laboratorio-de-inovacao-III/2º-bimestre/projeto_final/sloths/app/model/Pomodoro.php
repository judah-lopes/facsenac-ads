<?php

require_once __DIR__ . '/../config/database.php';

class PomodoroModel {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo;
    }

    /**
     * Salva uma sessão de Pomodoro completada no banco de dados.
     *
     * @param int $usuarioId O ID do usuário.
     * @param string $tipoSessao O tipo de sessão ('Foco', 'Descanso Curto', 'Descanso Longo').
     * @return bool Retorna true se a operação foi bem-sucedida, false caso contrário.
     */
    public function salvarSessao($usuarioId, $tipoSessao) {
        if (empty($usuarioId) || empty($tipoSessao)) {
            return false;
        }

        $sql = "INSERT INTO pomodoro_sessoes (usuario_id, tipo_sessao) VALUES (:usuario_id, :tipo_sessao)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':tipo_sessao' => $tipoSessao
        ]);
    }

    /**
     * Busca o número de sessões de foco completadas por um usuário em um dia.
     *
     * @param int $usuarioId O ID do usuário.
     * @return int O número de sessões de foco hoje.
     */
    public function contarSessoesFocoDeHoje($usuarioId) {
        $sql = "SELECT COUNT(*) FROM pomodoro_sessoes WHERE usuario_id = :usuario_id AND tipo_sessao = 'Foco' AND DATE(data_sessao) = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return (int) $stmt->fetchColumn();
    }

    // Adicione este método
    public function getStats($usuarioId) {
        $sql = "SELECT tipo_sessao, COUNT(*) as total FROM pomodoro_sessoes WHERE usuario_id = :usuario_id AND DATE(data_sessao) = CURDATE() GROUP BY tipo_sessao";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}