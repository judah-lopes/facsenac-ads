<form id="form-evento" novalidate>
    <input type="hidden" id="evento-id">
    <div class="form-group">
        <label for="evento-titulo">Título do Evento</label>
        <input type="text" id="evento-titulo" required>
    </div>
    <div class="form-group">
        <label for="evento-data">Data</label>
        <input type="date" id="evento-data" required>
    </div>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="evento-hora-inicio">Início</label>
            <input type="time" id="evento-hora-inicio" required>
        </div>
        <div class="form-group">
            <label for="evento-hora-fim">Fim</label>
            <input type="time" id="evento-hora-fim" required>
        </div>
    </div>
    <div class="form-group">
        <label for="evento-cor">Cor do Evento</label>
        <input type="color" id="evento-cor" value="#49754B">
    </div>
    <div class="form-group">
        <label for="evento-descricao">Descrição</label>
        <textarea id="evento-descricao" rows="3"></textarea>
    </div>
    <div class="form-actions" id="form-actions-container">
        <button type="button" class="btn btn-secondary" id="btn-cancelar-form">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>