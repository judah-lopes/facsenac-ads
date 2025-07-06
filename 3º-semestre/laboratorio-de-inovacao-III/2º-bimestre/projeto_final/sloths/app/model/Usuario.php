<?php

require_once __DIR__ . '/../config/database.php'; // Define $pdo

class UserModel {
    private $conn;

    public function __construct() {
        global $pdo;
        $this->conn = $pdo;
    }

    public function emailExiste($email) {
        return $this->buscarPorEmail($email) !== false;
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT id, nome, email, senha, role FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($resultado);
        // exit;
    }

    public function autenticar($email, $senha) {
        if (empty($email) || empty($senha)) {
            return false;
        }

        $usuario = $this->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    }

    public function registrar($nome, $email, $senha, $genero) {
        if (empty($nome) || empty($email) || empty($senha) || empty($genero)) {
            return false;
        }

        if ($this->buscarPorEmail($email)) {
            return false;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha, genero) VALUES (:nome, :email, :senha, :genero)";
        $stmt = $this->conn->prepare($sql);

        $success = $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash,
            ':genero' => $genero
        ]);

        if ($success) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    public function buscarTodos() {
        $sql = "SELECT id, nome, email, role, data_cadastro FROM usuarios ORDER BY nome ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT id, nome, email, role FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarPorAdmin($id, $nome, $email, $role) {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':role' => $role,
            ':id' => $id
        ]);
    }

    public function deletar($id) {
        // Cuidado: não permita que o usuário se auto-delete para evitar travar a si mesmo fora da conta admin
        if (isset($_SESSION['user_id']) && $id == $_SESSION['user_id']) {
            return false;
        }
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

}
