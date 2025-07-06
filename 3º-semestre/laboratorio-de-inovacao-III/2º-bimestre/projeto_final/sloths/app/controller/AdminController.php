<?php
require_once __DIR__ . '/../model/Usuario.php';
// Inclui o autoload do Composer para usar o Dompdf
require_once __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;

class AdminController {

    public static function listarUsuarios() {
        $userModel = new UserModel();
        $usuarios = $userModel->buscarTodos();
        require_once __DIR__ . '/../views/admin/lista_usuarios.php';
    }

    public static function editarUsuario() {
        $userModel = new UserModel();
        $id = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processa a atualização
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $userModel->atualizarPorAdmin($id, $nome, $email, $role);
            header('Location: index.php?page=admin-lista-usuarios');
            exit;
        }

        // Mostra o formulário de edição
        $usuario = $userModel->buscarPorId($id);
        require_once __DIR__ . '/../views/admin/editar_usuario.php';
    }

    public static function deletarUsuario() {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $userModel = new UserModel();
            $userModel->deletar($id);
        }
        header('Location: index.php?page=admin-lista-usuarios');
        exit;
    }

    public static function gerarPdfUsuarios() {
        $userModel = new UserModel();
        $usuarios = $userModel->buscarTodos();

        // Monta o HTML para o PDF
        $html = "<h1>Lista de Usuários - Sloths</h1>";
        $html .= "<table border='1' width='100%' style='border-collapse: collapse; font-family: sans-serif;'>";
        $html .= "<thead style='background-color: #f2f2f2;'><tr><th>ID</th><th>Nome</th><th>Email</th><th>Cargo</th><th>Cadastro</th></tr></thead>";
        $html .= "<tbody>";
        foreach ($usuarios as $usuario) {
            $dataCadastro = date('d/m/Y H:i', strtotime($usuario['data_cadastro']));
            $html .= "<tr>";
            $html .= "<td style='padding: 5px;'>{$usuario['id']}</td>";
            $html .= "<td style='padding: 5px;'>" . htmlspecialchars($usuario['nome']) . "</td>";
            $html .= "<td style='padding: 5px;'>" . htmlspecialchars($usuario['email']) . "</td>";
            $html .= "<td style='padding: 5px;'>" . htmlspecialchars($usuario['role']) . "</td>";
            $html .= "<td style='padding: 5px;'>{$dataCadastro}</td>";
            $html .= "</tr>";
        }
        $html .= "</tbody></table>";

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // false para abrir no navegador, true para forçar download
        $dompdf->stream("lista_usuarios_sloths.pdf", ["Attachment" => false]);
    }
}