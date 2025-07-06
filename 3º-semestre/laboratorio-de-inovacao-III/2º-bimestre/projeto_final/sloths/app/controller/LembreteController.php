<?php
require_once __DIR__ . '/../model/Lembrete.php';

class LembreteController {
    // Método para mostrar os lembretes (permanece o mesmo)
    public static function mostrarLembretes() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) { header('Location: index.php?page=login'); exit; }
        
        $ordem = $_GET['sort'] ?? 'DESC';
        
        $lembreteModel = new LembreteModel();
        $lembretes = $lembreteModel->buscarPorUsuario($_SESSION['user_id'], $ordem);
        
        // CORREÇÃO: Garanta que o nome do arquivo da sua view esteja correto aqui.
        // Se seu arquivo é lembrete.php, deve ser como abaixo.
        require_once __DIR__ . '/../views/lembrete/lembrete.php';
    }

    // Método para criar (permanece o mesmo)
    public static function criar() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }

        $titulo = $_POST['titulo'] ?? '';
        $cor = $_POST['cor'] ?? '#ffffff';
        $data = $_POST['data'] ?? '';
        $hora = $_POST['hora'] ?? '';
        $data_lembrete = !empty($data) && !empty($hora) ? "$data $hora" : null;

        header('Content-Type: application/json');
        if (empty($titulo) || empty($data_lembrete)) {
            echo json_encode(['status' => 'error', 'message' => 'Todos os campos são obrigatórios.']);
            exit;
        }

        $lembreteModel = new LembreteModel();
        $novoId = $lembreteModel->criar($_SESSION['user_id'], $titulo, $cor, $data_lembrete);

        if ($novoId) {
            echo json_encode(['status' => 'success', 'id' => $novoId, 'data_formatada' => date('d/m/Y, H:i', strtotime($data_lembrete))]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao criar lembrete.']);
        }
    }

    // Método para atualizar (permanece o mesmo)
    public static function atualizar() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }

        $id = $_POST['id'] ?? null;
        $titulo = $_POST['titulo'] ?? '';
        $cor = $_POST['cor'] ?? '#ffffff';
        $data = $_POST['data'] ?? '';
        $hora = $_POST['hora'] ?? '';
        $data_lembrete = !empty($data) && !empty($hora) ? "$data $hora" : null;

        header('Content-Type: application/json');
        if (empty($titulo) || empty($id) || empty($data_lembrete)) {
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos.']);
            exit;
        }

        $lembreteModel = new LembreteModel();
        $success = $lembreteModel->atualizar($id, $_SESSION['user_id'], $titulo, $cor, $data_lembrete);

        if ($success) {
            echo json_encode(['status' => 'success', 'data_formatada' => date('d/m/Y, H:i', strtotime($data_lembrete))]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao atualizar lembrete.']);
        }
    }

    // ================================================================
    // CORREÇÃO AQUI: Os métodos precisam ser 'static' e pegar os dados da requisição
    // ================================================================
    public static function atualizarStatus() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }

        $id = $_POST['id'] ?? null;
        $concluido = $_POST['concluido'] ?? 0;

        $lembreteModel = new LembreteModel();
        $success = $lembreteModel->atualizarStatus($id, $_SESSION['user_id'], $concluido);
        
        header('Content-Type: application/json');
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }

    public static function deletar() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }
        
        $id = $_POST['id'] ?? null;

        $lembreteModel = new LembreteModel();
        $success = $lembreteModel->deletar($id, $_SESSION['user_id']);

        header('Content-Type: application/json');
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }
}