<?php
// ... (bloco PHP inicial com as variáveis de sessão) ...
if (session_status() === PHP_SESSION_NONE) session_start();
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$userName = $_SESSION['user_name'] ?? 'Usuário';
$userEmail = $_SESSION['user_email'] ?? '';
$userInitials = strtoupper(substr($userName, 0, 1));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar Usuário - Sloths</title><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* ... (CSS idêntico, incluindo os estilos de Admin da página anterior) ... */
        :root { --sidebar-bg: #1a1d24; --main-bg: #f0f2f5; --primary-color: #6a5acd; --text-light: #f8f9fa; --text-dark: #343a40; --danger-color: #e74c3c; --white: #fff; --grey: #6c757d; --light-grey: #ced4da; --sidebar-width-collapsed: 90px; --sidebar-width-expanded: 260px; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; display: flex; background-color: var(--main-bg); }
        .sidebar { width: var(--sidebar-width-collapsed); height: 100vh; position: fixed; left: 0; top: 0; background-color: var(--sidebar-bg); padding: 1.5rem 0; display: flex; flex-direction: column; align-items: center; transition: width 0.3s ease; overflow: hidden; z-index: 1000; }
        .sidebar:hover { width: var(--sidebar-width-expanded); }
        .sidebar-header { width: 100%; display: flex; align-items: center; justify-content: flex-start; padding: 0 1.75rem; margin-bottom: 2rem; cursor: pointer; }
        .user-avatar { min-width: 50px; height: 50px; background-color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; color: var(--text-light); flex-shrink: 0; }
        .user-details { margin-left: 1rem; white-space: nowrap; opacity: 0; transition: opacity 0.2s ease; }
        .sidebar:hover .user-details { opacity: 1; transition-delay: 0.1s; }
        .user-details h3 { font-size: 1rem; font-weight: 600; color: var(--text-light); margin: 0; }
        .user-details p { font-size: 0.8rem; color: #adb5bd; margin: 0; }
        .sidebar-nav { width: 100%; list-style: none; padding: 0; margin-top: 2rem; flex-grow: 1; display: flex; flex-direction: column; }
        .sidebar-nav li a { display: flex; align-items: center; padding: 1rem 1.75rem; color: #adb5bd; text-decoration: none; white-space: nowrap; transition: all 0.2s ease; }
        .sidebar-nav li a:hover { background-color: #2c313a; color: var(--text-light); }
        .sidebar-nav li a .nav-icon { font-size: 1.25rem; min-width: 50px; text-align: center; }
        .sidebar-nav li a .nav-text { margin-left: 1rem; font-weight: 500; opacity: 0; transition: opacity 0.2s ease; }
        .sidebar:hover .sidebar-nav li a .nav-text { opacity: 1; transition-delay: 0.1s; }
        .nav-divider { height: 1px; background-color: #2c313a; margin: 1rem 1.5rem; }
        .logout-link { margin-top: auto; }
        .logout-link a:hover { background-color: var(--danger-color) !important; color: var(--text-light) !important; }
        .main-content { flex-grow: 1; margin-left: var(--sidebar-width-collapsed); padding: 3rem; transition: margin-left 0.3s ease; }
        .sidebar:hover ~ .main-content { margin-left: var(--sidebar-width-expanded); }
        .admin-container { max-width: 700px; margin: 0 auto; background: var(--white); padding: 2rem; border-radius: 12px; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .admin-header h1 { color: var(--text-dark); margin: 0; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
        .form-group input, .form-group select { width: 100%; padding: 0.75rem; border: 1px solid var(--light-grey); border-radius: 8px; font-size: 1rem; }
        .form-actions { display: flex; gap: 1rem; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 500; cursor: pointer; text-decoration: none; }
        .btn-primary { background-color: var(--primary-color); color: var(--white); }
        .btn-secondary { background-color: var(--grey); color: var(--white); }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header"><div class="user-avatar"><?php echo htmlspecialchars($userInitials); ?></div><div class="user-details"><h3><?php echo htmlspecialchars($userName); ?></h3><p><?php echo htmlspecialchars($userEmail); ?></p></div></div><ul class="sidebar-nav"><li><a href="index.php?page=home"><i class="fa-solid fa-house nav-icon"></i><span class="nav-text">Início</span></a></li><div class="nav-divider"></div><li><a href="index.php?page=perfil"><i class="fa-solid fa-user-pen nav-icon"></i><span class="nav-text">Meu Perfil</span></a></li><li><a href="index.php?page=configuracoes"><i class="fa-solid fa-sliders nav-icon"></i><span class="nav-text">Configurações</span></a></li><?php if ($isAdmin): ?><div class="nav-divider"></div><li><a href="index.php?page=admin-lista-usuarios"><i class="fa-solid fa-shield-halved nav-icon"></i><span class="nav-text">Painel Admin</span></a></li><?php endif; ?><li class="logout-link"><a href="index.php?page=logout"><i class="fa-solid fa-right-from-bracket nav-icon"></i><span class="nav-text">Sair da Conta</span></a></li></ul>
    </nav>

    <main class="main-content">
        <div class="admin-container">
            <div class="admin-header">
                <h1>Editar Usuário</h1>
            </div>
            <form action="index.php?page=admin-editar-usuario&id=<?php echo $usuario['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="role">Cargo</label>
                    <select name="role" id="role">
                        <option value="user" <?php echo ($usuario['role'] === 'user') ? 'selected' : ''; ?>>Usuário</option>
                        <option value="admin" <?php echo ($usuario['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="index.php?page=admin-lista-usuarios" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>