<?php
// index.php

// Carrega configurações e dependências
require_once 'app/config/database.php';

// Pega o parâmetro "page" da URL, padrão "dashboard"
$page = $_GET['page'] ?? 'home';

// Simulação de verificação de autenticação (você pode aprimorar depois)
session_start();
$loggedIn = isset($_SESSION['user_id']); 
$isAdmin = $_SESSION['role'] ?? false;

switch ($page) {
    // Páginas públicas que não exigem login
    case 'login':
        require_once 'app/controller/AuthController.php';
        AuthController::login();
        break;

    case 'logout':
        require_once 'app/controller/AuthController.php';
        AuthController::logout();
        break;

    case 'recuperar-senha':
        require_once 'app/controller/AuthController.php';
        AuthController::recuperarSenha();
        break;

    case 'cadastro':
        require_once 'app/controller/AuthController.php';
        AuthController::register();
        break;

    // ==================================================================
    // Páginas que EXIGEM que o usuário esteja logado
    // ==================================================================
    
    case 'home':
        if (!$loggedIn) { header('Location: index.php?page=login'); exit; }
        require_once 'app/controller/HomeController.php';
        HomeController::mostrarPainel();
        break;

    case 'pomodoro':
        if (!$loggedIn) { header('Location: index.php?page=login'); exit; }
        require_once 'app/controller/PomodoroController.php';
        PomodoroController::mostrarPomodoro();
        break;
    
    // Rota da API para salvar a sessão do Pomodoro (requer login)
    case 'pomodoro-salvar':
        if (!$loggedIn) { 
            http_response_code(403); // Forbidden
            echo json_encode(['status' => 'error', 'message' => 'Acesso não autorizado']);
            exit; 
        }
        require_once 'app/controller/PomodoroController.php';
        PomodoroController::salvarSessao();
        break;

    // Adicione esta rota para a API de estatísticas
    case 'pomodoro-get-stats':
        if (!$loggedIn) { http_response_code(403); exit; }
        require_once 'app/controller/PomodoroController.php';
        PomodoroController::getStats();
        break;    

    case 'lembrete':
        if (!$loggedIn) { header('Location: index.php?page=login'); exit; }
        require_once 'app/controller/LembreteController.php';
        LembreteController::mostrarLembretes();
        break;

    case 'lembrete-criar':
        if (!$loggedIn) { http_response_code(403); exit; }
        require_once 'app/controller/LembreteController.php';
        LembreteController::criar();
        break;
    
    case 'lembrete-atualizar-status':
        if (!$loggedIn) { http_response_code(403); exit; }
        require_once 'app/controller/LembreteController.php';
        LembreteController::atualizarStatus();
        break;

    case 'lembrete-deletar':
        if (!$loggedIn) { http_response_code(403); exit; }
        require_once 'app/controller/LembreteController.php';
        LembreteController::deletar();
        break;

    case 'lembrete-atualizar':
        if (!$loggedIn) { http_response_code(403); exit; }
        require_once 'app/controller/LembreteController.php';
        LembreteController::atualizar();
        break;

    case 'calendario':
        if (!$loggedIn) { header('Location: index.php?page=login'); exit; }
        require_once 'app/controller/CalendarioController.php';
        CalendarioController::mostrarCalendario();
        break;

    case 'calendario':
        if (!$loggedIn) { header('Location: index.php?page=login'); exit; }
        require_once 'app/controller/CalendarioController.php';
        CalendarioController::mostrarCalendario();
        break;

    case 'calendario-get-dia':
        if (!$loggedIn) { http_response_code(403); exit; }
        require_once 'app/controller/CalendarioController.php';
        CalendarioController::getEventosDoDia();
        break;

    case 'calendario-criar':
        if (!$loggedIn) { http_response_code(403); exit; }
        require_once 'app/controller/CalendarioController.php';
        CalendarioController::criarEvento();
        break;

    case 'configuracoes':
        if (!$loggedIn) { header('Location: index.php?page=login'); exit; }
        require_once 'app/controller/ConfigController.php';
        ConfigController::mostrarConfig();
        break;

    case 'perfil':
        if (!$loggedIn) { header('Location: index.php?page=login'); exit; }
        require_once 'app/controller/PerfilController.php';
        PerfilController::editarPerfil();
        break;

    // ==================================================================
    // Área administrativa (requer login e permissão de admin)
    // ==================================================================

    case 'admin-lista-usuarios':
    case 'admin-editar-usuario':
    case 'admin-deletar-usuario':
    case 'admin-gerar-pdf':
        if (!$loggedIn || !$isAdmin) {
            // Se não for admin, redireciona para a home ou mostra um erro
            header('Location: index.php?page=home');
            exit;
        }
        require_once 'app/controller/AdminController.php';
        
        switch ($page) {
            case 'admin-lista-usuarios':
                AdminController::listarUsuarios();
                break;
            case 'admin-editar-usuario':
                AdminController::editarUsuario();
                break;
            case 'admin-deletar-usuario':
                AdminController::deletarUsuario();
                break;
            case 'admin-gerar-pdf':
                AdminController::gerarPdfUsuarios();
                break;
        }
        break;

    // =sem
    // Página padrão / 404
    // =sem
    
    default:
        if ($loggedIn) {
            header('Location: index.php?page=home');
        } else {
            header('Location: index.php?page=login');
        }
        exit;
}