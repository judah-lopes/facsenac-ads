<?php
// Bloco PHP inicial corrigido e completo
if (session_status() === PHP_SESSION_NONE) session_start();
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$userName = $_SESSION['user_name'] ?? 'Usuário';
$userEmail = $_SESSION['user_email'] ?? '';
$userInitials = strtoupper(substr($userName, 0, 1));

// Lógica para gerar o calendário
$mes = (int)($_GET['mes'] ?? date('m'));
$ano = (int)($_GET['ano'] ?? date('Y'));

$primeiroDia = new DateTimeImmutable("$ano-$mes-01");
$diasNoMes = (int)$primeiroDia->format('t');
$diaDaSemana = (int)$primeiroDia->format('w');

// Lógica para navegação de mês anterior/seguinte
$mesAnterior = $mes - 1; $anoAnterior = $ano;
if ($mesAnterior < 1) { $mesAnterior = 12; $anoAnterior--; }
$mesSeguinte = $mes + 1; $anoSeguinte = $ano;
if ($mesSeguinte > 12) { $mesSeguinte = 1; $anoSeguinte++; }

// Forma moderna de obter o nome do mês
$formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'America/Sao_Paulo', IntlDateFormatter::GREGORIAN, 'MMMM');
$nomeDoMes = ucfirst($formatter->format($primeiroDia));

// A variável $diasComEventos é passada pelo controller
$diasComEventos = $diasComEventos ?? [];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Calendário - Sloths</title><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root { --bg-page: #FDFBF5; --text-dark-green: #3D4A39; --button-orange: #f78200; --sidebar-bg: #49754B; --primary-color: #6a5acd; --text-light: #f8f9fa; --danger-color: #e74c3c; --white: #fff; --grey: #6c757d; --light-grey: #ced4da; --sidebar-width-collapsed: 90px; --sidebar-width-expanded: 260px; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; display: flex; background-image: url("/sloths/assets/images/bg-calend_lembrete.png"); background-size: cover; background-position: center; background-attachment: fixed; }
        
        /* --- Sidebar CSS (Completo) --- */
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

        /* --- Conteúdo Principal e Calendário --- */
        .main-content { flex-grow: 1; margin-left: var(--sidebar-width-collapsed); padding: 2rem; transition: margin-left 0.3s ease; display: flex; flex-direction: column; justify-content: center; min-height: 100vh; }
        .sidebar:hover ~ .main-content { margin-left: var(--sidebar-width-expanded); }
        .calendario-container { width: 100%; max-width: 900px; margin: 0 auto; }
        .calendario-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .calendario-title-group { display: flex; align-items: center; gap: 1rem; }
        .calendario-title-group h1 { font-size: 2.5rem; color: var(--text-dark-green); }
        .month-selector-wrapper { display: flex; align-items: center; gap: 0.5rem; background: var(--white); padding: 0.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .month-nav-btn { background:none; border:none; cursor:pointer; font-size:1.5rem; color: var(--text-dark-green); padding: 0 0.5rem;}
        #month-year-picker { font-size: 1.25rem; font-weight: 600; color: var(--text-dark-green); border: none; background: transparent; }
        #month-year-picker::-webkit-calendar-picker-indicator { cursor: pointer; }
        .btn-adicionar { padding: 0.75rem 1.5rem; background-color: var(--button-orange); color: var(--white); border: none; border-radius: 12px; font-size: 1rem; cursor: pointer; font-weight: 600; }
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px; }
        .day-name, .day { background-color: rgba(255,255,255,0.6); backdrop-filter: blur(5px); padding: 0.5rem; text-align: left; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.07); }
        .day-name { font-weight: 700; color: var(--text-dark-green); text-align: center; }
        .day { min-height: 85px; color: var(--grey); font-weight: 600; cursor: pointer; transition: background-color 0.2s, box-shadow 0.2s; position: relative; }
        .day:not(.empty):hover { background-color: rgba(255,255,255,0.9); }
        .day.today { font-weight: 700; color: var(--button-orange); }
        .event-dot { position: absolute; bottom: 8px; left: 10px; width: 8px; height: 8px; background-color: var(--button-orange); border-radius: 50%; }
        
        /* --- Modais e Sidebars --- */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1999; display: none; justify-content: center; align-items: center;}
        .modal-overlay.active { display: flex; }
        .modal-content { background: var(--bg-page); width: 95%; height: 90%; max-width: 1200px; border-radius: 15px; display: flex; flex-direction: column; overflow: hidden; }
        .modal-header { padding: 1rem 1.5rem; font-size: 1.5rem; font-weight: 700; border-bottom: 1px solid #eee; display:flex; justify-content: space-between; align-items: center; }
        .close-btn { background: none; border: none; font-size: 1.5rem; cursor: pointer; }
        .modal-body { flex-grow: 1; position: relative; overflow-y: auto; }
        .timeline { position: relative; padding-top: 10px; }
        .hour-row { height: 60px; border-bottom: 1px dotted #ccc; display: flex; align-items: flex-start; position: relative; }
        .hour-label { font-size: 0.8rem; color: var(--grey); padding: 5px; width: 60px; text-align: right; flex-shrink: 0; }
        .event-block { position: absolute; left: 70px; right: 10px; padding: 5px 10px; border-radius: 8px; color: white; font-size: 0.9rem; font-weight: 500; cursor: pointer; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; border: 1px solid rgba(0,0,0,0.2); }
        
        #event-detail-sidebar { position: fixed; top: 0; right: -420px; width: 100%; max-width: 400px; height: 100%; background: var(--white); box-shadow: -5px 0 15px rgba(0,0,0,0.1); z-index: 2001; transition: right 0.4s ease-in-out; display: flex; flex-direction: column; }
        #event-detail-sidebar.active { right: 0; }
        .form-container { padding: 1.5rem; flex-grow: 1; overflow-y: auto; }
        .form-group { margin-bottom: 1rem; } .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .form-group input, .form-group textarea { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; }
        .form-group-inline { display: flex; gap: 1rem; } .form-group-inline > div { flex: 1; }
        .form-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: auto; padding: 1.5rem; background: #f9f9f9; border-top: 1px solid #eee; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration:none; }
        .btn-primary { background-color: var(--button-orange); color: white; }
        .btn-secondary { background-color: var(--grey); color: white; }
        .btn-danger { background-color: var(--danger-color); color: white; margin-right: auto; }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header"><div class="user-avatar"><?php echo htmlspecialchars($userInitials); ?></div><div class="user-details"><h3><?php echo htmlspecialchars($userName); ?></h3><p><?php echo htmlspecialchars($userEmail); ?></p></div></div>
        <ul class="sidebar-nav">
            <li><a href="index.php?page=home"><i class="fa-solid fa-house nav-icon"></i><span class="nav-text">Início</span></a></li>
            <div class="nav-divider"></div>
            <li><a href="index.php?page=perfil"><i class="fa-solid fa-user-pen nav-icon"></i><span class="nav-text">Meu Perfil</span></a></li>
            <li><a href="index.php?page=configuracoes"><i class="fa-solid fa-sliders nav-icon"></i><span class="nav-text">Configurações</span></a></li>
            <?php if ($isAdmin): ?>
                <div class="nav-divider"></div>
                <li><a href="index.php?page=admin-lista-usuarios"><i class="fa-solid fa-shield-halved nav-icon"></i><span class="nav-text">Painel Admin</span></a></li>
            <?php endif; ?>
            <li class="logout-link"><a href="index.php?page=logout"><i class="fa-solid fa-right-from-bracket nav-icon"></i><span class="nav-text">Sair da Conta</span></a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="calendario-container">
            <div class="calendario-header">
                <div class="calendario-title-group">
                    <h1>Calendário</h1>
                    <div class="month-selector-wrapper">
                        <a href="?page=calendario&ano=<?php echo $anoAnterior; ?>&mes=<?php echo $mesAnterior; ?>" class="month-nav-btn" title="Mês Anterior">&lt;</a>
                        <input type="month" id="month-year-picker" value="<?php echo "$ano-" . str_pad($mes, 2, '0', STR_PAD_LEFT); ?>">
                        <a href="?page=calendario&ano=<?php echo $anoSeguinte; ?>&mes=<?php echo $mesSeguinte; ?>" class="month-nav-btn" title="Próximo Mês">&gt;</a>
                    </div>
                </div>
                <button class="btn-adicionar" id="btnAbrirModalCriar">+ Adicionar Evento</button>
            </div>
            
            <div class="calendar-grid">
                <div class="day-name">Dom</div><div class="day-name">Seg</div><div class="day-name">Ter</div><div class="day-name">Qua</div><div class="day-name">Qui</div><div class="day-name">Sex</div><div class="day-name">Sáb</div>
                <?php for ($i = 0; $i < $diaDaSemana; $i++) { echo "<div class='day empty'></div>"; } ?>
                <?php for ($dia = 1; $dia <= $diasNoMes; $dia++) {
                    $dataCompleta = "$ano-" . str_pad($mes, 2, '0', STR_PAD_LEFT) . "-" . str_pad($dia, 2, '0', STR_PAD_LEFT);
                    $classeHoje = (date('Y-m-d') == $dataCompleta) ? 'today' : '';
                    $temEvento = in_array($dia, $diasComEventos);
                    echo "<div class='day $classeHoje' data-date='$dataCompleta'>{$dia}";
                    if ($temEvento) { echo "<div class='event-dot'></div>"; }
                    echo "</div>";
                } ?>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="day-detail-modal">
        <div class="modal-content">
            <div class="modal-header">
                <span id="day-detail-title"></span>
                <button class="close-btn" data-close="day-detail-modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="timeline" id="timeline"></div>
            </div>
        </div>
    </div>
    
    <aside id="event-detail-sidebar">
        <div class="modal-header">
            <h2 id="event-sidebar-title"></h2>
            <button class="close-btn" data-close="event-detail-sidebar">&times;</button>
        </div>
        <div class="form-container" id="event-form-container">
            </div>
    </aside>

    <script>
    // ==========================================================
    // SCRIPT COMPLETO E FUNCIONAL
    // ==========================================================
    document.addEventListener('DOMContentLoaded', () => {
        const calendarGrid = document.querySelector('.calendar-grid');
        const dayDetailModal = document.getElementById('day-detail-modal');
        const eventDetailSidebar = document.getElementById('event-detail-sidebar');
        const eventFormContainer = document.getElementById('event-form-container');
        const btnAbrirModalCriar = document.getElementById('btnAbrirModalCriar');
        const monthYearPicker = document.getElementById('month-year-picker');

        // --- LÓGICA DO SELETOR DE MÊS ---
        monthYearPicker.addEventListener('change', (e) => {
            const [year, month] = e.target.value.split('-');
            window.location.href = `?page=calendario&ano=${year}&mes=${parseInt(month, 10)}`;
        });
        
        // --- FUNÇÕES DE CONTROLE DE UI ---
        const UIManager = {
            async loadForm(container) {
                try {
                    const response = await fetch('app/views/calendario/modal_editar.php');
                    container.innerHTML = await response.text();
                    return container.querySelector('#form-evento');
                } catch (error) { console.error("Erro ao carregar formulário:", error); }
            },
            openSidebar: () => eventDetailSidebar.classList.add('active'),
            closeSidebar: () => eventDetailSidebar.classList.remove('active'),
            openDayModal: () => dayDetailModal.classList.add('active'),
            closeDayModal: () => dayDetailModal.classList.remove('active'),
        };

        // --- FUNÇÕES DE EVENTOS ---
        async function setupCreateForm() {
            const form = await UIManager.loadForm(eventFormContainer);
            if (!form) return;
            document.getElementById('event-sidebar-title').textContent = "Novo Evento";
            form.reset();
            form.querySelector('#evento-id').value = '';
            
            const deleteBtn = form.querySelector('.btn-deletar');
            if (deleteBtn) deleteBtn.remove(); // Garante que não há botão de deletar na criação
            
            UIManager.openSidebar();
        }

        async function setupEditForm(eventData) {
            const form = await UIManager.loadForm(eventFormContainer);
            if (!form) return;
            document.getElementById('event-sidebar-title').textContent = "Editar Evento";

            form.querySelector('#evento-id').value = eventData.id;
            form.querySelector('#evento-titulo').value = eventData.titulo;
            form.querySelector('#evento-descricao').value = eventData.descricao;
            form.querySelector('#evento-cor').value = eventData.cor;
            form.querySelector('#evento-data').value = eventData.data_inicio.split(' ')[0];
            form.querySelector('#evento-hora-inicio').value = eventData.data_inicio.split(' ')[1].substring(0,5);
            form.querySelector('#evento-hora-fim').value = eventData.data_fim.split(' ')[1].substring(0,5);

            const actionsContainer = form.querySelector('.form-actions');
            if (!actionsContainer.querySelector('.btn-deletar')) {
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'btn btn-danger btn-deletar';
                deleteBtn.textContent = 'Deletar';
                actionsContainer.prepend(deleteBtn);
            }
            UIManager.openSidebar();
        }

        async function showDayDetails(date) {
            const [year, month, day] = date.split('-');
            document.getElementById('day-detail-title').textContent = `Eventos de ${day}/${month}/${year}`;
            
            const timeline = document.getElementById('timeline');
            timeline.innerHTML = ''; // Limpa a timeline
            for (let i = 0; i < 24; i++) {
                timeline.innerHTML += `<div class="hour-row"><span class="hour-label">${i.toString().padStart(2,'0')}:00</span></div>`;
            }

            const response = await fetch(`index.php?page=calendario-get-dia&data=${date}`);
            const data = await response.json();

            // ==========================================================
            // AQUI ESTÁ A CORREÇÃO
            // ==========================================================
            // Chamando a função que desenha os eventos na tela
            if (data.status === 'success' && data.eventos && data.eventos.length > 0) {
                renderEventsOnTimeline(data.eventos);
            }
            // ==========================================================
            
            UIManager.openDayModal();
        }

        // --- LÓGICA DE SUBMISSÃO E DELEÇÃO ---
        async function handleFormSubmit(e) {
            e.preventDefault();
            const form = e.target;
            const id = form.querySelector('#evento-id').value;
            const url = id ? 'index.php?page=calendario-atualizar' : 'index.php?page=calendario-criar';
            
            const formData = new FormData(form);
            // O FormData já pega os valores dos inputs pelo 'name', mas vamos garantir
            formData.set('id', id);
            formData.set('titulo', form.querySelector('#evento-titulo').value);
            // ... (etc. para todos os campos)

            try {
                const response = await fetch(url, { method: 'POST', body: formData });
                const result = await response.json();
                if (result.status === 'success') {
                    alert('Evento salvo com sucesso!');
                    window.location.reload();
                } else { alert('Erro ao salvar o evento.'); }
            } catch (error) { alert("Falha na comunicação com o servidor."); }
        }
        
        function renderEventsOnTimeline(events) {
            const timeline = document.getElementById('timeline');
            events.forEach(event => {
                const start = new Date(event.data_inicio);
                const end = new Date(event.data_fim);
                const startMinutes = start.getHours() * 60 + start.getMinutes();
                const endMinutes = end.getHours() * 60 + end.getMinutes();
                
                const topPosition = (startMinutes / 60) * 60; // 60px por hora
                const height = Math.max(30, ((endMinutes - startMinutes) / 60) * 60);

                const eventBlock = document.createElement('div');
                eventBlock.className = 'event-block';
                eventBlock.textContent = event.titulo;
                eventBlock.style.backgroundColor = event.cor;
                eventBlock.style.top = `${topPosition}px`;
                eventBlock.style.height = `${height}px`;
                
                Object.keys(event).forEach(key => {
                    eventBlock.dataset[key] = event[key];
                });
                timeline.appendChild(eventBlock);
            });
        }

        async function handleDelete(e) {
            const id = eventFormContainer.querySelector('#evento-id').value;
            if (!id || !confirm('Tem certeza?')) return;
            const formData = new FormData();
            formData.append('id', id);
            const response = await fetch('index.php?page=calendario-deletar', { method: 'POST', body: formData });
            const result = await response.json();
            if (result.status === 'success') { window.location.reload(); } 
            else { alert('Erro ao deletar.'); }
        }

        // --- EVENT LISTENERS GERAIS ---
        btnAbrirModalCriar.addEventListener('click', setupCreateForm);
        calendarGrid.addEventListener('click', e => {
            const dayCell = e.target.closest('.day:not(.empty)');
            if (dayCell) showDayDetails(dayCell.dataset.date);
        });
        dayDetailModal.addEventListener('click', e => {
            if(e.target.matches('.close-btn') || e.target === dayDetailModal) UIManager.closeDayModal();
        });
        eventDetailSidebar.addEventListener('click', e => {
            if(e.target.matches('.close-btn') || e.target.matches('.btn-secondary')) UIManager.closeSidebar();
        });
        document.getElementById('timeline').addEventListener('click', e => {
            const eventBlock = e.target.closest('.event-block');
            if (eventBlock) setupEditForm(eventBlock.dataset);
        });
        eventFormContainer.addEventListener('submit', handleFormSubmit);
        eventFormContainer.addEventListener('click', e => {
            if(e.target.matches('.btn-deletar')) handleDelete(e);
        });
    });
    </script>
</body>
</html>