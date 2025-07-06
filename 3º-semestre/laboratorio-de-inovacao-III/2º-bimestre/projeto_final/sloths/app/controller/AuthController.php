<?php
require_once __DIR__ . '/../model/Usuario.php';

class AuthController {
    public static function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $userModel = new UserModel();
            $usuario = $userModel->buscarPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_name'] = $usuario['nome'];
                $_SESSION['user_email'] = $usuario['email'];
                $_SESSION['role'] = $usuario['role']; // <-- ADICIONE ESTA LINHA
                $_SESSION['logged_in'] = true;
                header('Location: index.php?page=home');
            } else {
                $_SESSION['erro_login'] = 'Email ou senha inválidos';
                header('Location: index.php?page=login');
            }
            exit;
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public static function logout() {
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }

    public static function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = strtolower(trim($_POST['email'] ?? ''));

            $senha = $_POST['senha'] ?? '';
            $confirmarSenha = $_POST['confirmar_senha'] ?? '';
            $genero = $_POST['genero'] ?? '';

            // Validação básica
            if (empty($nome) || empty($email) || empty($senha) || empty($confirmarSenha) || empty($genero)) {
                $_SESSION['erro_cadastro'] = 'Preencha todos os campos.';
                header('Location: index.php?page=cadastro');
                exit;
            }

            $userModel = new UserModel();

            if ($userModel->emailExiste($email)) {
                $_SESSION['erro_cadastro'] = 'O email já está em uso.';
                header('Location: index.php?page=cadastro');
                exit;
            }

            $usuarioId = $userModel->registrar($nome, $email, $senha, $genero);

            if ($usuarioId) {
                $_SESSION['user_id'] = $usuarioId;
                $_SESSION['user_name'] = $nome;
                $_SESSION['user_email'] = $email;
                $_SESSION['logged_in'] = true;
                $_SESSION['sucesso_cadastro'] = 'Cadastro realizado com sucesso!';
                header('Location: index.php?page=home');
            } else {
                $_SESSION['erro_cadastro'] = 'Erro ao cadastrar usuário.';
                header('Location: index.php?page=cadastro');
            }
            exit;
        }

        require_once __DIR__ . '/../views/auth/cadastro.php';
    }

    public static function recuperarSenha() {
        // lógica de recuperação de senha
    }
}
