<?php
// Assume-se que a sessão já foi iniciada no roteador principal.
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$userName = $_SESSION['user_name'] ?? 'Usuário';
$userEmail = $_SESSION['user_email'] ?? '';
// Gerando um avatar simples com as iniciais do usuário
$userInitials = strtoupper(substr($userName, 0, 1));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sloths</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            /* Paleta de cores baseada na imagem */
            --card-bg: #FFFFFF;
            --text-dark-green: #3D4A39;
            --text-light-green: #606B5F;
            --button-bg: #49754B;
            --button-text: #FFFFFF;
            
            /* Cores da Sidebar (mantidas) */
            --sidebar-bg: var(--button-bg);
            --primary-color: #6a5acd;
            --text-light: #f8f9fa;
            --danger-color: #e74c3c;
            --sidebar-width-collapsed: 90px;
            --sidebar-width-expanded: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-image: url("/sloths/assets/images/bg-home.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* background-color: var(--bg-page); */
            display: flex;
        }

        /* --- Barra Lateral (Navbar) --- */
        .sidebar { width: var(--sidebar-width-collapsed); height: 100vh; position: fixed; left: 0; top: 0; background-color: var(--sidebar-bg); padding: 1.5rem 0; display: flex; flex-direction: column; align-items: center; transition: width 0.3s ease; overflow: hidden; z-index: 1000; }
        .sidebar:hover { width: var(--sidebar-width-expanded); }
        .sidebar-header { width: 100%; display: flex; align-items: center; justify-content: flex-start; padding: 0 1.75rem; margin-bottom: 2rem; cursor: pointer; }
        .user-avatar { min-width: 50px; height: 50px; background-color: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; color: var(--text-light); flex-shrink: 0; }
        .user-details { margin-left: 1rem; white-space: nowrap; opacity: 0; transition: opacity 0.2s ease; }
        .sidebar:hover .user-details { opacity: 1; transition-delay: 0.1s; }
        .user-details h3 { font-size: 1rem; font-weight: 600; color: var(--text-light); margin: 0; }
        .user-details p { font-size: 0.8rem; color: #adb5bd; margin: 0; }
        .sidebar-nav { width: 100%; list-style: none; padding: 0; margin-top: 2rem; flex-grow: 1; display: flex; flex-direction: column; }
        .sidebar-nav li a { display: flex; align-items: center; padding: 1rem 1.75rem; color: #adb5bd; text-decoration: none; white-space: nowrap; transition: background-color 0.2s ease, color 0.2s ease; }
        .sidebar-nav li a:hover { background-color: #335235; color: var(--text-light); }
        .sidebar-nav li a .nav-icon { font-size: 1.25rem; min-width: 50px; text-align: center; }
        .sidebar-nav li a .nav-text { margin-left: 1rem; font-weight: 500; opacity: 0; transition: opacity 0.2s ease; }
        .sidebar:hover .sidebar-nav li a .nav-text { opacity: 1; transition-delay: 0.1s; }
        .nav-divider { height: 1px; background-color: #335235; margin: 1rem 1.5rem; }
        .logout-link { margin-top: auto; }
        .logout-link a:hover { background-color: var(--danger-color) !important; color: var(--text-light) !important; }

        /* --- Conteúdo Principal e Grid --- */
        .main-content {
            flex-grow: 1; margin-left: var(--sidebar-width-collapsed);
            transition: margin-left 0.3s ease;
            display: flex; align-items: center; justify-content: center; 
            min-height: 100vh; padding: 2rem;
        }
        .sidebar:hover ~ .main-content { margin-left: var(--sidebar-width-expanded); }
        
        .features-parent-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(4, 1fr);
            grid-column-gap: 70px;
            grid-row-gap: 25px;
            width: 100%;
            height: 75vh;
            max-width: 1100px;
        }

        .feature-card {
            background-color: var(--card-bg);
            border-radius: 24px;
            border: none;
            box-shadow: 0px 0px 10px 5px rgb(185, 178, 146);
            color: var(--text-dark-green);
            display: flex;
            padding: 1.5rem 1rem;
            transition: transform 0.2s ease;
        }
        .feature-card:hover { transform: translateY(-8px); }
        
        /* MUDANÇA: Posições e estilos trocados */
        .card-pomodoro  { grid-area: 1 / 1 / 3 / 4; align-items: center; } /* Era do calendário */
        .card-lembrete  { grid-area: 3 / 1 / 5 / 4; align-items: center; }
        .card-calendario { grid-area: 1 / 4 / 5 / 5; flex-direction: column; justify-content: center; text-align: center; } /* Era do pomodoro */

        .card-pomodoro .card-icon, .card-lembrete .card-icon{ flex-shrink: 0; margin-right: 1rem; }
        .card-calendario .card-icon { flex-shrink: 0; margin: 0 1rem; }
        
        /* MUDANÇA: Tamanhos dos ícones trocados */
        .card-pomodoro .card-icon img,
        .card-lembrete .card-icon img {
            width: 250px; 
        }
        .card-calendario .card-icon img {
            width: 250px;
            padding: 0 1rem;
        }
        
        .card-content { display: flex; flex-direction: column; }
        .card-content h2 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-dark-green); }
        .card-content p { font-size: 1rem; line-height: 1.5; margin-bottom: 1rem; color: var(--text-light-green); }
        .card-content p::before { content: '"'; }
        .card-content p::after { content: '"'; }

        .card-action {
            background-color: var(--button-bg);
            color: var(--button-text);
            padding: 0.75rem .8rem;
            border-radius: 16px;
            border: none;
            font-weight: 700;
            text-decoration: none;
            align-self: flex-start;
            transition: transform 0.2s ease;
            display: inline-block;
        }
        /* MUDANÇA: Alinhamento do botão trocado */
        .card-calendario .card-action { align-self: center; margin-bottom: 1rem; }
        .card-action:hover { transform: translateY(-2px); color: var(--button-text); }
        .card-action:active { transform: translateY(1px); }

        /* NOVO: Media Queries para Responsividade */
        @media (max-width: 1200px) {
            .features-parent-grid {
                grid-column-gap: 40px;
                max-width: 900px;
            }
            .card-pomodoro .card-icon img,
            .card-lembrete .card-icon img,
            .card-calendario .card-icon img {
                width: 200px; 
            }
        }

        @media (max-width: 992px) {
            .features-parent-grid {
                display: flex;
                flex-direction: column;
                height: auto;
                width: 100%;
                max-width: 500px;
            }
            .feature-card {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }
            .card-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            .card-pomodoro .card-icon img,
            .card-lembrete .card-icon img,
            .card-calendario .card-icon img {
                width: 150px; 
                padding: 0;
            }
            .card-action {
                align-self: center;
            }
        }

        @media (max-width: 576px) {
            .main-content { padding: 1rem; }
            .card-pomodoro .card-icon img,
            .card-lembrete .card-icon img,
            .card-calendario .card-icon img {
                width: 120px; 
            }
            .card-content h2 { font-size: 1.5rem; }
            .card-content p { font-size: 0.9rem; }
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header"><div class="user-avatar"><?php echo htmlspecialchars($userInitials); ?></div><div class="user-details"><h3><?php echo htmlspecialchars($userName); ?></h3><p><?php echo htmlspecialchars($userEmail); ?></p></div></div><ul class="sidebar-nav"><li><a href="index.php?page=perfil"><i class="fa-solid fa-user-pen nav-icon"></i><span class="nav-text">Meu Perfil</span></a></li><li><a href="index.php?page=configuracoes"><i class="fa-solid fa-sliders nav-icon"></i><span class="nav-text">Configurações</span></a></li><?php if ($isAdmin): ?><div class="nav-divider"></div><li><a href="index.php?page=admin-lista-usuarios"><i class="fa-solid fa-shield-halved nav-icon"></i><span class="nav-text">Painel Admin</span></a></li><?php endif; ?><li class="logout-link"><a href="index.php?page=logout"><i class="fa-solid fa-right-from-bracket nav-icon"></i><span class="nav-text">Sair da Conta</span></a></li></ul>
    </nav>

    <main class="main-content">
        <div class="features-parent-grid">
            
            <div class="feature-card card-lembrete">
                <div class="card-icon">
                    <img src="assets/images/icon-lbt.svg" alt="Ícone de Lembretes">
                </div>
                <div class="card-content">
                    <h2>Lembretes</h2>
                    <p>Receba alertas personalizados para manter sua rotina sempre em dia.</p>
                    <a href="index.php?page=lembrete" class="card-action">Nunca mais esqueça de estudar</a>
                </div>
            </div>
            
            <div class="feature-card card-pomodoro">
                <div class="card-icon">
                    <img src="assets/images/icon-pmd.svg" alt="Ícone do Pomodoro">
                </div>
                <div class="card-content">
                    <h2>Pomodoro</h2>
                    <p>Use o timer Pomodoro para estudar em ciclos melhorando a concentração.</p>
                    <a href="index.php?page=pomodoro" class="card-action">Organize seu tempo com foco</a>
                </div>
            </div>

            <div class="feature-card card-calendario">
                <div class="card-icon">
                    <img src="assets/images/icon-cld.svg" alt="Ícone de Calendário">
                </div>
                <div class="card-content">
                    <h2>Calendário</h2>
                    <p>Programe tarefas, aulas e prazos em um calendário intuitivo e fácil de usar.</p>
                    <a href="index.php?page=calendario" class="card-action">Visualize seus estudos com clareza</a>
                </div>
            </div>

        </div>
    </main>
</body>
</html>