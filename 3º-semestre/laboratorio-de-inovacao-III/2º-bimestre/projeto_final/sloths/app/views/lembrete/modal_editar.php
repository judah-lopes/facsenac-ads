<div class="modal-overlay" id="modal-lembrete">
    <div class="modal-content">
        <h2 id="modal-titulo">Novo Lembrete</h2>
        <form id="form-lembrete">
            <input type="hidden" id="lembrete-id">

            <div class="form-group">
                <label for="input-titulo">O que você quer lembrar?</label>
                <input type="text" id="input-titulo" required>
            </div>
            <div class="form-group">
                <label for="input-data">Data do Alerta (Opcional)</label>
                <input type="date" id="input-data">
            </div>
            <div class="form-group">
                <label for="input-hora">Hora do Alerta (Opcional)</label>
                <input type="time" id="input-hora">
            </div>
            <div class="form-group">
                <label for="input-cor">Cor</label>
                <input type="color" id="input-cor" value="#6a5acd">
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-adicionar btn-cancelar" id="btn-cancelar-modal">Cancelar</button>
                <button type="submit" class="btn-adicionar">Salvar</button>
            </div>
        </form>
    </div>
</div>