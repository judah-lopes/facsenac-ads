<?php
// Bloco PHP inicial
if (session_status() === PHP_SESSION_NONE) session_start();
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$userName = $_SESSION['user_name'] ?? 'Usuário';
$userEmail = $_SESSION['user_email'] ?? '';
$userInitials = strtoupper(substr($userName, 0, 1));
$sort_order = $_GET['sort'] ?? 'DESC'; // Pega a ordenação atual
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembretes - Sloths</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --bg-page: #FDFBF5;
            --text-dark-green: #3D4A39;
            --button-orange: #f78200;
            --sidebar-bg: #49754B;
            --primary-color: #6a5acd;
            --text-light: #f8f9fa;
            --danger-color: #e74c3c;
            --white: #fff;
            --grey: #6c757d;
            --light-grey: #ced4da;
            --sidebar-width-collapsed: 90px;
            --sidebar-width-expanded: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            background-image: url("/sloths/assets/images/bg-calend_lembrete.png");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        /* --- Sidebar CSS (Omitido para brevidade) --- */
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
        
        /* --- Conteúdo Principal e Estilos dos Lembretes --- */
        .main-content { flex-grow: 1; margin-left: var(--sidebar-width-collapsed); padding: 3rem; transition: margin-left 0.3s ease; }
        .sidebar:hover ~ .main-content { margin-left: var(--sidebar-width-expanded); }
        .lembretes-container { margin: 0 80px; }
        
        .page-title { color: var(--text-dark-green); font-weight: 700; font-size: 3rem; line-height: 1.1; margin-bottom: 1.5rem; }
        .page-title span { display: block; }
        
        .actions-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .btn-adicionar { padding: 0.75rem 1.5rem; background-color: var(--button-orange); color: var(--white); border: none; border-radius: 12px; font-size: 1rem; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; }

        /* NOVO: Estilo para o botão de filtro dropdown */
        .filter-dropdown { position: relative; display: inline-block; }
        .filter-dropdown .filter-btn { background: none; border: 1px solid var(--grey); color: var(--grey); padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;}
        .filter-dropdown .filter-options { display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; border-radius: 8px; padding: 0.5rem 0; right: 0; }
        .filter-dropdown:hover .filter-options { display: block; }
        .filter-dropdown .filter-options a { color: black; padding: 12px 16px; text-decoration: none; display: block; }
        .filter-dropdown .filter-options a:hover { background-color: #f1f1f1; }
        .filter-dropdown .filter-options a.active { font-weight: 700; color: var(--text-dark-green); }

        #lista-lembretes .lembrete { display: flex; align-items: center; gap: 1rem; background-color: var(--white); padding: 1rem; border-radius: 16px; margin-bottom: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-left: 8px solid; transition: opacity 0.3s, box-shadow 0.3s; }
        #lista-lembretes .lembrete:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
        #lista-lembretes .lembrete.concluido { opacity: 0.6; }
        #lista-lembretes .lembrete.concluido .titulo-lembrete { text-decoration: line-through; }
        
        .lembrete-content { flex-grow: 1; }
        .titulo-lembrete { font-size: 1.1rem; font-weight: 600; color: var(--text-dark-green); margin-bottom: 0.25rem; }
        .data-lembrete { font-size: 0.9rem; color: var(--grey); }

        .lembrete-actions { display: flex; align-items: center; }
        .lembrete-actions button { background: none; border: none; color: var(--grey); font-size: 1.1rem; cursor: pointer; padding: 0.5rem; }
        .lembrete-actions .btn-editar:hover { color: var(--primary-color); }
        .lembrete-actions .btn-deletar:hover { color: var(--danger-color); }

        .lista-vazia { text-align: center; color: var(--grey); padding: 3rem; background-color: var(--white); border-radius: 16px; }

        /* Estilos do Modal (sem alterações) */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 2000; }
        .modal-overlay.active { display: flex; }
        .modal-content { background: var(--white); padding: 2rem; border-radius: 15px; width: 90%; max-width: 500px; }
        .modal-content h2 { margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .form-group input { width: 100%; padding: 0.75rem; border: 1px solid var(--light-grey); border-radius: 8px; font-size: 1rem; }
        .modal-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; }
        .btn-cancelar { background: var(--grey); color: var(--white); }
    </style>
</head>
<body>
    <div id="modal-placeholder"></div>
    <nav class="sidebar">
        <div class="sidebar-header"><div class="user-avatar"><?php echo htmlspecialchars($userInitials); ?></div><div class="user-details"><h3><?php echo htmlspecialchars($userName); ?></h3><p><?php echo htmlspecialchars($userEmail); ?></p></div></div><ul class="sidebar-nav"><li><a href="index.php?page=home"><i class="fa-solid fa-house nav-icon"></i><span class="nav-text">Início</span></a></li><div class="nav-divider"></div><li><a href="index.php?page=perfil"><i class="fa-solid fa-user-pen nav-icon"></i><span class="nav-text">Meu Perfil</span></a></li><li><a href="index.php?page=configuracoes"><i class="fa-solid fa-sliders nav-icon"></i><span class="nav-text">Configurações</span></a></li><?php if ($isAdmin): ?><div class="nav-divider"></div><li><a href="index.php?page=admin-lista-usuarios"><i class="fa-solid fa-shield-halved nav-icon"></i><span class="nav-text">Painel Admin</span></a></li><?php endif; ?><li class="logout-link"><a href="index.php?page=logout"><i class="fa-solid fa-right-from-bracket nav-icon"></i><span class="nav-text">Sair da Conta</span></a></li></ul>
    </nav>
    <main class="main-content">
        <div class="lembretes-container">
            <h1 class="page-title">
                <span>Meus</span>
                <span>Lembretes</span>
            </h1>
            <div class="actions-header">
                <button class="btn-adicionar" id="btn-abrir-modal"><i class="fa-solid fa-plus"></i> Adicionar Lembrete</button>
                <div class="filter-dropdown">
                    <button class="filter-btn">Ordenar <i class="fa-solid fa-chevron-down fa-xs"></i></button>
                    <div class="filter-options">
                        <a href="?page=lembrete&sort=DESC" class="<?php echo $sort_order === 'DESC' ? 'active' : '' ?>">Mais Recente</a>
                        <a href="?page=lembrete&sort=ASC" class="<?php echo $sort_order === 'ASC' ? 'active' : '' ?>">Mais Antigo</a>
                    </div>
                </div>
            </div>
            <div id="lista-lembretes">
                <?php if (empty($lembretes)): ?>
                    <p class="lista-vazia">Você ainda não tem lembretes.</p>
                <?php else: ?>
                    <?php foreach ($lembretes as $lembrete): 
                        $data_formatada = !empty($lembrete['data_lembrete']) ? date('d/m/Y, H:i', strtotime($lembrete['data_lembrete'])) : 'Sem data';
                    ?>
                        <div class="lembrete <?php echo $lembrete['concluido'] ? 'concluido' : ''; ?>" data-id="<?php echo $lembrete['id']; ?>" data-cor="<?php echo htmlspecialchars($lembrete['cor']); ?>" data-datetime="<?php echo $lembrete['data_lembrete']; ?>" style="border-left-color: <?php echo htmlspecialchars($lembrete['cor']); ?>;">
                            <div class="lembrete-content">
                                <p class="titulo-lembrete"><?php echo htmlspecialchars($lembrete['titulo']); ?></p>
                                <p class="data-lembrete"><?php echo $data_formatada; ?></p>
                            </div>
                            <div class="lembrete-actions">
                                <button class="btn-editar"><i class="fa-solid fa-pencil"></i></button>
                                <button class="btn-deletar"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script>
        // ==========================================================
        // SCRIPT COMPLETO E CORRIGIDO
        // ==========================================================
        let isModalLoaded = false;
        const modalPlaceholder = document.getElementById('modal-placeholder');
        const listaLembretes = document.getElementById('lista-lembretes');

        async function loadModal() {
            if (isModalLoaded) return true;
            try {
                const response = await fetch('app/views/lembrete/modal_editar.php');
                if (!response.ok) throw new Error('Falha na rede ao carregar modal.');
                modalPlaceholder.innerHTML = await response.text();
                isModalLoaded = true;
                setupModalEventListeners();
                return true;
            } catch (error) {
                console.error('Falha ao carregar o modal:', error);
                alert('Não foi possível carregar o formulário. Tente recarregar a página.');
                return false;
            }
        }

        function setupModalEventListeners() {
            const modalOverlay = document.getElementById('modal-lembrete');
            if (!modalOverlay) return;
            document.getElementById('btn-cancelar-modal').addEventListener('click', () => modalOverlay.classList.remove('active'));
            modalOverlay.addEventListener('click', (e) => {
                if (e.target === modalOverlay) modalOverlay.classList.remove('active');
            });
            document.getElementById('form-lembrete').addEventListener('submit', handleFormSubmit);
        }

        async function openModal(mode = 'create', data = {}) {
            const loaded = await loadModal();
            if (!loaded) return;

            const modalOverlay = document.getElementById('modal-lembrete');
            const modalTitulo = document.getElementById('modal-titulo');
            const form = document.getElementById('form-lembrete');
            
            form.reset();
            document.getElementById('lembrete-id').value = '';

            if (mode === 'edit') {
                modalTitulo.textContent = 'Editar Lembrete';
                document.getElementById('lembrete-id').value = data.id;
                document.getElementById('input-titulo').value = data.titulo;
                document.getElementById('input-cor').value = data.cor;
                
                if (data.datetime) {
                    const [datePart, timePart] = data.datetime.split(' ');
                    document.getElementById('input-data').value = datePart;
                    document.getElementById('input-hora').value = timePart ? timePart.substring(0, 5) : '';
                }
            } else {
                modalTitulo.textContent = 'Novo Lembrete';
            }
            modalOverlay.classList.add('active');
        }

        document.getElementById('btn-abrir-modal').addEventListener('click', () => openModal('create'));

        async function handleFormSubmit(e) {
            e.preventDefault();
            const id = document.getElementById('lembrete-id').value;
            const titulo = document.getElementById('input-titulo').value.trim();
            const cor = document.getElementById('input-cor').value;
            const data = document.getElementById('input-data').value;
            const hora = document.getElementById('input-hora').value;

            if (!titulo || !data || !hora) {
                alert('Por favor, preencha todos os campos.');
                return;
            }

            const isEditMode = !!id;
            const url = isEditMode ? 'index.php?page=lembrete-atualizar' : 'index.php?page=lembrete-criar';
            
            const formData = new FormData();
            formData.append('titulo', titulo);
            formData.append('cor', cor);
            formData.append('data', data);
            formData.append('hora', hora);
            if (isEditMode) formData.append('id', id);

            const response = await fetch(url, { method: 'POST', body: formData });
            const result = await response.json();

            if (result.status === 'success') {
                window.location.reload();
            } else {
                alert(result.message || 'Ocorreu um erro ao salvar.');
            }
        }

        // ================================================================
        // CORREÇÃO AQUI: Garantindo que o listener chame a função de delete
        // ================================================================
        listaLembretes.addEventListener('click', (e) => {
            const lembreteElement = e.target.closest('.lembrete');
            if (!lembreteElement) return;

            const id = lembreteElement.dataset.id;
            
            // Lógica para o botão de deletar
            if (e.target.closest('.btn-deletar')) {
                deletarLembrete(id); // Chamada da função de delete
            }

            // Lógica para o botão de editar
            if (e.target.closest('.btn-editar')) {
                const titulo = lembreteElement.querySelector('.titulo-lembrete').textContent;
                const cor = lembreteElement.dataset.cor;
                const datetime = lembreteElement.dataset.datetime;
                openModal('edit', { id, titulo, cor, datetime });
            }
        });
        
        // Função de delete corrigida para recarregar a página no sucesso
        async function deletarLembrete(id) {
            if (!confirm('Tem certeza que deseja excluir este lembrete?')) return;

            const formData = new FormData();
            formData.append('id', id);
            
            try {
                const response = await fetch('index.php?page=lembrete-deletar', { method: 'POST', body: formData });
                const result = await response.json();
                
                if (result.status === 'success') {
                    // Como você pediu, recarrega a página para mostrar que o item sumiu
                    window.location.reload();
                } else {
                    alert('Erro ao deletar lembrete.');
                }
            } catch(error) {
                console.error("Falha na requisição de delete:", error);
                alert("Não foi possível comunicar com o servidor para deletar o lembrete.");
            }
        }
    </script>
</body>
</html> 