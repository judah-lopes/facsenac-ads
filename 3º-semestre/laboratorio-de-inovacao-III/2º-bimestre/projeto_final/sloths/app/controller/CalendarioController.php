<?php
require_once __DIR__ . '/../model/Evento.php';

class CalendarioController {

    public static function mostrarCalendario() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) { header('Location: index.php?page=login'); exit; }

        $mes = $_GET['mes'] ?? date('m');
        $ano = $_GET['ano'] ?? date('Y');

        $eventoModel = new EventoModel();
        $diasComEventos = $eventoModel->buscarPorMes($_SESSION['user_id'], $ano, $mes);
        
        require_once __DIR__ . '/../views/calendario/calendario.php';
    }

    public static function getEventosDoDia() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) { http_response_code(403); exit; }

        $data = $_GET['data'] ?? date('Y-m-d');
        $eventoModel = new EventoModel();
        $eventos = $eventoModel->buscarPorDia($_SESSION['user_id'], $data);
        
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'eventos' => $eventos]);
    }
    
    public static function criarEvento() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }

        $dados = [
            'usuario_id' => $_SESSION['user_id'],
            'titulo' => $_POST['titulo'],
            'descricao' => $_POST['descricao'],
            'cor' => $_POST['cor'],
            'data_inicio' => $_POST['data'] . ' ' . $_POST['hora_inicio'],
            'data_fim' => $_POST['data'] . ' ' . $_POST['hora_fim'],
        ];

        $eventoModel = new EventoModel();
        $success = $eventoModel->criar($dados);

        header('Content-Type: application/json');
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }

    // NOVO: Método para atualizar evento
    public static function atualizarEvento() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }

        $dados = [
            'id' => $_POST['id'],
            'usuario_id' => $_SESSION['user_id'],
            'titulo' => $_POST['titulo'],
            'descricao' => $_POST['descricao'],
            'cor' => $_POST['cor'],
            'data_inicio' => $_POST['data'] . ' ' . $_POST['hora_inicio'],
            'data_fim' => $_POST['data'] . ' ' . $_POST['hora_fim'],
        ];
        
        $eventoModel = new EventoModel();
        $success = $eventoModel->atualizar($dados);

        header('Content-Type: application/json');
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }

    // NOVO: Método para deletar evento
    public static function deletarEvento() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) { exit; }
        
        $id = $_POST['id'] ?? null;

        $eventoModel = new EventoModel();
        $success = $eventoModel->deletar($id, $_SESSION['user_id']);

        header('Content-Type: application/json');
        echo json_encode(['status' => $success ? 'success' : 'error']);
    }
}