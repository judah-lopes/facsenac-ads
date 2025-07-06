class ValidadorCadastro {
    constructor(form) {
        this.form = form;
        this.campos = {
            email: form.querySelector("#email"),
            telefone: form.querySelector("#telefone"),
            senha: form.querySelector("#senha"),
            confirmarSenha: form.querySelector("#confirmar_senha")
        };

        // Cria elementos de erro
        for (const campo in this.campos) {
            const erroDiv = document.createElement("div");
            erroDiv.className = "invalid-feedback";
            erroDiv.style.display = "none";
            this.campos[campo].classList.add("form-control");
            this.campos[campo].after(erroDiv);
        }

        this.form.addEventListener("submit", (e) => this.validarForm(e));
        this.adicionarListeners();
    }

    adicionarListeners() {
        this.campos.email.addEventListener("input", () => this.validarEmail());
        this.campos.telefone.addEventListener("input", () => this.validarTelefone());
        this.campos.confirmarSenha.addEventListener("input", () => this.validarSenhas());
    }

    validarForm(e) {
        let valido = true;

        if (!this.validarEmail()) valido = false;
        if (!this.validarTelefone()) valido = false;
        if (!this.validarSenhas()) valido = false;

        if (!valido) e.preventDefault();
    }

    mostrarErro(campo, mensagem) {
        const erroDiv = campo.nextElementSibling;
        erroDiv.textContent = mensagem;
        erroDiv.style.display = "block";
        campo.classList.add("is-invalid");
    }

    limparErro(campo) {
        const erroDiv = campo.nextElementSibling;
        erroDiv.textContent = "";
        erroDiv.style.display = "none";
        campo.classList.remove("is-invalid");
    }

    validarEmail() {
        const email = this.campos.email;
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regex.test(email.value)) {
            this.mostrarErro(email, "E-mail inválido.");
            return false;
        }
        this.limparErro(email);
        return true;
    }

    validarTelefone() {
        const telefone = this.campos.telefone;
        const regex = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
        if (telefone.value && !regex.test(telefone.value)) {
            this.mostrarErro(telefone, "Telefone inválido. Ex: (11) 91234-5678");
            return false;
        }
        this.limparErro(telefone);
        return true;
    }

    validarSenhas() {
        const senha = this.campos.senha;
        const confirmar = this.campos.confirmarSenha;
        if (senha.value !== confirmar.value) {
            this.mostrarErro(confirmar, "As senhas não coincidem.");
            return false;
        }
        this.limparErro(confirmar);
        return true;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formCadastro");
    if (form) {
        new ValidadorCadastro(form);
    }
});
