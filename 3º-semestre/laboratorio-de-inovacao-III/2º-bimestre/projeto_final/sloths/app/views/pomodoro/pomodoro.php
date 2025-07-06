<?php
// Bloco PHP inicial (sem alterações)
if (session_status() === PHP_SESSION_NONE) session_start();
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$userName = $_SESSION['user_name'] ?? 'Usuário';
$userEmail = $_SESSION['user_email'] ?? '';
$userInitials = strtoupper(substr($userName, 0, 1));
$sessoesDeFocoHoje = $sessoesDeFocoHoje ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Pomodoro - Sloths</title><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@700&display=swap" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --pmd-green-dark: #49754B; --pmd-green-light:rgb(116, 165, 99);
            --pmd-orange: #f78200; --sidebar-bg: #49754B; --secondary-color: #6a5acd;
            --text-light: #f8f9fa; --danger-color: #e74c3c;
            --sidebar-width-collapsed: 90px; --sidebar-width-expanded: 260px;
            --text-dark: #333; --white: #fff; --grey: #6c757d;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; display: flex; background-image: url("/sloths/assets/images/bg-pmd.png"); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; }
        .sidebar { width: var(--sidebar-width-collapsed); height: 100vh; position: fixed; left: 0; top: 0; background-color: var(--sidebar-bg); padding: 1.5rem 0; display: flex; flex-direction: column; align-items: center; transition: width 0.3s ease; overflow: hidden; z-index: 1000; }
        .sidebar:hover { width: var(--sidebar-width-expanded); } .sidebar-header { width: 100%; display: flex; align-items: center; justify-content: flex-start; padding: 0 1.75rem; margin-bottom: 2rem; cursor: pointer; } .user-avatar { min-width: 50px; height: 50px; background-color: var(--secondary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700; color: var(--text-light); flex-shrink: 0; } .user-details { margin-left: 1rem; white-space: nowrap; opacity: 0; transition: opacity 0.2s ease; } .sidebar:hover .user-details { opacity: 1; transition-delay: 0.1s; } .user-details h3 { font-size: 1rem; font-weight: 600; color: var(--text-light); margin: 0; } .user-details p { font-size: 0.8rem; color: #adb5bd; margin: 0; } .sidebar-nav { width: 100%; list-style: none; padding: 0; margin-top: 2rem; flex-grow: 1; display: flex; flex-direction: column; } .sidebar-nav li a { display: flex; align-items: center; padding: 1rem 1.75rem; color: #adb5bd; text-decoration: none; white-space: nowrap; transition: all 0.2s ease; } .sidebar-nav li a:hover { background-color: #2c313a; color: var(--text-light); } .sidebar-nav li a .nav-icon { font-size: 1.25rem; min-width: 50px; text-align: center; } .sidebar-nav li a .nav-text { margin-left: 1rem; font-weight: 500; opacity: 0; transition: opacity 0.2s ease; } .sidebar:hover .sidebar-nav li a .nav-text { opacity: 1; transition-delay: 0.1s; } .nav-divider { height: 1px; background-color: #2c313a; margin: 1rem 1.5rem; } .logout-link { margin-top: auto; } .logout-link a:hover { background-color: var(--danger-color) !important; color: var(--text-light) !important; }
        .main-content { flex-grow: 1; margin-left: var(--sidebar-width-collapsed); padding: 3rem; transition: margin-left 0.3s ease; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .sidebar:hover ~ .main-content { margin-left: var(--sidebar-width-expanded); }
        .pomodoro-container { width: 90%; max-width: 480px; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; }
        .tabs { display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem; }
        .tab { padding: 0.75rem 1.5rem; border: none; background-color: var(--pmd-green-light); color: var(--white); font-family: 'Inter', sans-serif; font-size: 1rem; font-weight: 700; border-radius: 30px; cursor: pointer; transition: background-color 0.3s; }
        .tab.active { background-color: var(--pmd-green-dark); }
        .timer-display { font-family: 'Poppins', sans-serif; font-size: 6rem; font-weight: 700; margin: 1rem 0 2rem; }
        .timer-nums { color: var(--pmd-green-dark); }
        .timer-colon { color: var(--pmd-orange); }
        .controls { display: flex; justify-content: center; align-items: center; gap: 1rem; }
        .control-btn { padding: 1rem; border: none; border-radius: 10px; font-size: 1.25rem; font-weight: 700; cursor: pointer; transition: transform 0.2s; color: var(--white); }
        .control-btn:hover { transform: translateY(-3px); }
        #startPauseBtn { flex-grow: 1; padding: 1rem 2rem; background-color: var(--pmd-orange); }
        #resetBtn, #skipBtn { width: 60px; height: 60px; padding: 0; background-color: var(--pmd-green-dark); }
        .footer-info { display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; font-size: 1rem; color: #333; }
        .settings-btn { background: none; border: none; cursor: pointer; color: var(--grey); font-size: 1.5rem; }
        .settings-btn:hover { color: var(--pmd-green-dark); }
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 2000; }
        .modal-overlay.active { display: flex; }
        .modal-content { background: var(--white); padding: 2rem; border-radius: 15px; text-align: left; width: 90%; max-width: 500px;}
        .modal-content h2 { color: var(--pmd-green-dark); margin-bottom: 1.5rem; }
        .modal-content .config-section, .modal-content .stats-section { margin-top: 1.5rem; }
        .config-option { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .config-option label { user-select: none; }
        .stats-section p { font-size: 1.1rem; margin-bottom: 0.5rem; }
        .modal-content button#closeSettingsBtn { margin-top: 2rem; background-color: var(--pmd-orange); color: var(--white); padding: 0.75rem 1.5rem; width: 100%; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; }
        .switch { position: relative; display: inline-block; width: 50px; height: 28px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 28px; }
        .slider:before { position: absolute; content: ""; height: 20px; width: 20px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: var(--pmd-green-dark); }
        input:checked + .slider:before { transform: translateX(22px); }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header"><div class="user-avatar"><?php echo htmlspecialchars($userInitials); ?></div><div class="user-details"><h3><?php echo htmlspecialchars($userName); ?></h3><p><?php echo htmlspecialchars($userEmail); ?></p></div></div><ul class="sidebar-nav"><li><a href="index.php?page=home"><i class="fa-solid fa-house nav-icon"></i><span class="nav-text">Início</span></a></li><div class="nav-divider"></div><li><a href="index.php?page=perfil"><i class="fa-solid fa-user-pen nav-icon"></i><span class="nav-text">Meu Perfil</span></a></li><li><a href="index.php?page=configuracoes"><i class="fa-solid fa-sliders nav-icon"></i><span class="nav-text">Configurações</span></a></li><?php if ($isAdmin): ?><div class="nav-divider"></div><li><a href="index.php?page=admin-lista-usuarios"><i class="fa-solid fa-shield-halved nav-icon"></i><span class="nav-text">Painel Admin</span></a></li><?php endif; ?><li class="logout-link"><a href="index.php?page=logout"><i class="fa-solid fa-right-from-bracket nav-icon"></i><span class="nav-text">Sair da Conta</span></a></li></ul>
    </nav>

    <main class="main-content">
        <div class="pomodoro-container">
            <div class="tabs">
                <button class="tab active" data-mode="foco">Pomodoro</button>
                <button class="tab" data-mode="curto">Descanso Curto</button>
                <button class="tab" data-mode="longo">Descanso Longo</button>
            </div>
            <div class="timer-display" id="timer"></div>
            <div class="controls">
                <button class="control-btn" id="startPauseBtn">COMEÇAR</button>
                <button class="control-btn" id="resetBtn"><i class="fa-solid fa-rotate-right"></i></button>
                <button class="control-btn" id="skipBtn"><i class="fa-solid fa-forward-step"></i></button>
            </div>
            <div class="footer-info">
                <div class="cycles-info">Ciclos de Foco: <span id="cyclesCount"><?php echo htmlspecialchars($sessoesDeFocoHoje); ?></span></div>
                <button class="settings-btn" id="settingsBtn"><i class="fa-solid fa-gear"></i></button>
            </div>
        </div>
    </main>
    
    <div class="modal-overlay" id="settingsModal">
        <div class="modal-content">
            <h2>Configurações</h2>
            <div class="config-section">
                <div class="config-option">
                    <label for="autoStartBreaks">Iniciar descanso automaticamente</label>
                    <label class="switch"><input type="checkbox" id="autoStartBreaks"><span class="slider"></span></label>
                </div>
                <div class="config-option">
                    <label for="autoStartFocus">Iniciar foco automaticamente</label>
                    <label class="switch"><input type="checkbox" id="autoStartFocus"><span class="slider"></span></label>
                </div>
            </div>
            <hr>
            <div class="stats-section">
                <h3>Estatísticas de Hoje</h3>
                <p><strong>Tempo Total de Foco:</strong> <span id="focoTotal">0</span> min</p>
                <p><strong>Tempo Total de Descanso:</strong> <span id="descansoTotal">0</span> min</p>
            </div>
            <button class="control-btn" id="closeSettingsBtn">Fechar</button>
        </div>
    </div>

    <script>
        // --- VARIÁVEIS E CONSTANTES ---
        const timers = { foco: 25, curto: 5, longo: 15 };
        let currentMode = 'foco';
        let timeRemaining = timers.foco * 60;
        let isRunning = false;
        let interval;
        // MUDANÇA: Variáveis de configuração agora iniciam como 'false'
        let autoStartBreaks = false;
        let autoStartFocus = false;
        
        let focusSessionsInCycle = 0; // Novo contador para o ciclo de 4
        let totalFocusSessionsToday = parseInt(document.getElementById('cyclesCount').textContent) || 0;
        
        const notificationSound = new Audio('/sloths/assets/sounds/notification.mp3');

        // --- ELEMENTOS DO DOM ---
        const timerDisplay = document.getElementById('timer');
        const startPauseBtn = document.getElementById('startPauseBtn');
        const resetBtn = document.getElementById('resetBtn');
        const skipBtn = document.getElementById('skipBtn');
        const cyclesDisplay = document.getElementById('cyclesCount');
        const tabs = document.querySelectorAll('.tab');
        const settingsBtn = document.getElementById('settingsBtn');
        const settingsModal = document.getElementById('settingsModal');
        const closeSettingsBtn = document.getElementById('closeSettingsBtn');
        const autoStartBreaksToggle = document.getElementById('autoStartBreaks');
        const autoStartFocusToggle = document.getElementById('autoStartFocus');

        // --- FUNÇÕES PRINCIPAIS ---
        function updateDisplay() {
            const minutes = Math.floor(timeRemaining / 60).toString().padStart(2, '0');
            const seconds = (timeRemaining % 60).toString().padStart(2, '0');
            timerDisplay.innerHTML = `<span class="timer-nums">${minutes}</span><span class="timer-colon">:</span><span class="timer-nums">${seconds}</span>`;
            document.title = `${minutes}:${seconds} - Sloths`;
            cyclesDisplay.textContent = totalFocusSessionsToday; // Usa o contador total
        }

        function switchMode(mode, autoStart = false) {
            clearInterval(interval);
            currentMode = mode;
            isRunning = false;
            timeRemaining = timers[mode] * 60;
            
            tabs.forEach(t => t.classList.remove('active'));
            document.querySelector(`.tab[data-mode=${mode}]`).classList.add('active');
            
            updateDisplay();
            startPauseBtn.textContent = 'COMEÇAR';

            if (autoStart) {
                startTimer();
            }
        }

        // MUDANÇA: Lógica de ciclo corrigida e mais clara
        function transitionToNextMode() {
            const lastMode = currentMode;
            
            if (lastMode === 'foco') {
                focusSessionsInCycle++; // Incrementa o contador do ciclo atual
                totalFocusSessionsToday++; // Incrementa o contador total do dia
                saveSession('Foco'); // Salva a sessão de foco no BD
                updateDisplay(); // Atualiza o contador na tela imediatamente

                // Se o contador do ciclo chegou a 4, o próximo é um descanso longo
                if (focusSessionsInCycle % 4 === 0) {
                    switchMode('longo', autoStartBreaks);
                } else {
                    switchMode('curto', autoStartBreaks);
                }
            } else { 
                saveSession(lastMode === 'curto' ? 'Descanso Curto' : 'Descanso Longo');
                switchMode('foco', autoStartFocus);
                // Se um ciclo completo de 4 focos + 1 descanso longo acabou, reseta o contador do ciclo
                if (lastMode === 'longo') {
                    focusSessionsInCycle = 0;
                }
            }
        }

        function startTimer() {
            if (isRunning) return;
            isRunning = true;
            startPauseBtn.textContent = 'PAUSAR';
            interval = setInterval(() => {
                timeRemaining--;
                if (timeRemaining < 0) {
                    notificationSound.play();
                    transitionToNextMode();
                    return;
                }
                updateDisplay();
            }, 1000);
        }

        function pauseTimer() {
            if (!isRunning) return;
            isRunning = false;
            startPauseBtn.textContent = 'RETOMAR';
            clearInterval(interval);
        }

        async function saveSession(sessionType) {
            // A função de salvar continua a mesma, mas é chamada de forma mais inteligente
            const formData = new FormData();
            formData.append('tipo', sessionType);
            try {
                const response = await fetch('index.php?page=pomodoro-salvar', { method: 'POST', body: formData });
                // Não precisamos mais do retorno aqui, pois o contador agora é local
            } catch (error) {
                console.error("Erro ao salvar a sessão:", error);
            }
        }
        
        async function showSettings() {
            // A função de mostrar estatísticas continua a mesma
            try {
                const response = await fetch('index.php?page=pomodoro-get-stats');
                const result = await response.json();
                if (result.status === 'success') {
                    document.getElementById('focoTotal').textContent = result.stats.foco_total;
                    document.getElementById('descansoTotal').textContent = result.stats.descanso_total;
                }
            } catch (error) { console.error("Erro ao buscar estatísticas:", error); }
            settingsModal.classList.add('active');
        }

        // --- EVENT LISTENERS ---
        startPauseBtn.addEventListener('click', () => { isRunning ? pauseTimer() : startTimer(); });
        resetBtn.addEventListener('click', () => { if (confirm("Tem certeza que deseja resetar o timer atual?")) switchMode(currentMode); });
        skipBtn.addEventListener('click', () => { if (confirm("Pular para a próxima etapa?")) transitionToNextMode(); });
        tabs.forEach(tab => { tab.addEventListener('click', (e) => switchMode(e.target.dataset.mode)); });
        
        settingsBtn.addEventListener('click', showSettings);
        closeSettingsBtn.addEventListener('click', () => settingsModal.classList.remove('active'));
        settingsModal.addEventListener('click', (e) => { if(e.target === settingsModal) settingsModal.classList.remove('active'); });
        autoStartBreaksToggle.addEventListener('change', (e) => { autoStartBreaks = e.target.checked; });
        autoStartFocusToggle.addEventListener('change', (e) => { autoStartFocus = e.target.checked; });

        // Inicializa o display
        updateDisplay();
    </script>
</body>
</html>