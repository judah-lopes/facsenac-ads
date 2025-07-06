<?php
$erro = $_SESSION['erro_cadastro'] ?? '';
$sucesso = $_SESSION['sucesso_cadastro'] ?? '';
unset($_SESSION['erro_cadastro'], $_SESSION['sucesso_cadastro']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Sloths</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/sloths_local/assets/js/validacaoCadastro.js"></script>
</head>
<body class="bg-light pt-5 pb-5" style="min-height: 100vh; margin: 0;">
    <div id="container" class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div id="content" class="card shadow p-4 w-100" style="max-width: 70%;">
            <header class="logo text-center mb-4">
                <h2>Cadastro - Sloths</h2>
            </header>

            <?php if ($erro): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
            <?php elseif ($sucesso): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($sucesso); ?></div>
            <?php endif; ?>

            <main>
                <form method="post" action="index.php?page=cadastro" id="formCadastro">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone">
                    </div>
    
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="genero" class="form-label">Gênero</label>
                        <select class="form-select" name="genero" required>
                            <option value="">Selecione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php?page=login" class="btn btn-secondary" style="flex: 1; max-width: 30%;">Voltar para Login</a>
                        <button type="submit" class="btn btn-primary" style="flex: 1.3; max-width: 40%;">Cadastrar</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>
</html>
