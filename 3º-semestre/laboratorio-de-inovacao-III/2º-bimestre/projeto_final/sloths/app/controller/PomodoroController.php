<?php
require_once __DIR__ . '/../model/Pomodoro.php';

class PomodoroController {

    public static function mostrarPomodoro() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $pomodoroModel = new PomodoroModel();
        // O contador agora é o número de sessões de foco de hoje
        $sessoesDeFocoHoje = $pomodoroModel->contarSessoesFocoDeHoje($_SESSION['user_id']);

        require_once __DIR__ . '/../views/pomodoro/pomodoro.php';
    }

    public static function salvarSessao() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }

        $tipo = $_POST['tipo'] ?? null;
        if (!$tipo) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Tipo de sessão não especificado.']);
            exit;
        }

        $pomodoroModel = new PomodoroModel();
        $success = $pomodoroModel->salvarSessao($_SESSION['user_id'], $tipo);

        header('Content-Type: application/json');
        if ($success) {
            $sessoesDeFocoHoje = $pomodoroModel->contarSessoesFocoDeHoje($_SESSION['user_id']);
            echo json_encode(['status' => 'success', 'sessoesDeFocoHoje' => $sessoesDeFocoHoje]);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    // NOVO: Método para buscar as estatísticas
    public static function getStats() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Não autorizado']);
            exit;
        }

        $pomodoroModel = new PomodoroModel();
        $stats = $pomodoroModel->getStats($_SESSION['user_id']);
        
        $timers = ['Foco' => 25, 'Descanso Curto' => 5, 'Descanso Longo' => 15];
        $results = [
            'foco_total' => 0,
            'descanso_total' => 0,
        ];

        foreach($stats as $stat) {
            if ($stat['tipo_sessao'] === 'Foco') {
                $results['foco_total'] += $stat['total'] * $timers['Foco'];
            } else {
                $results['descanso_total'] += $stat['total'] * $timers[$stat['tipo_sessao']];
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'stats' => $results]);
    }
}