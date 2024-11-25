//* Função para validar o CNPJ
const inputCnpj = document.getElementById("cnpj");
function validarCNPJ(cnpj) {
    // Remove caracteres não numéricos (como pontos, traços e barras)
    cnpj = cnpj.replace(/[^\d]+/g, '');
    // Verifica se o CNPJ tem 14 dígitos ou se é uma sequência repetida (ex: "11111111111111")
    if (cnpj.length !== 14 || /^(\d)\1+$/.test(cnpj)) {
        return false; // Retorna falso se não atender aos requisitos
    }
    // Array de pesos para calcular o primeiro dígito verificador
    const pesos1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    // Array de pesos para calcular o segundo dígito verificador
    const pesos2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    // Função auxiliar para calcular cada dígito verificador
    function calcularDigito(pesos) {
        let soma = 0;
        // Realiza a multiplicação dos números do CNPJ pelos pesos
        for (let i = 0; i < pesos.length; i++) {
            soma += parseInt(cnpj[i]) * pesos[i];
        }
        // Calcula o dígito de controle
        let resto = soma % 11;
        return resto < 2 ? 0 : 11 - resto; // Retorna o dígito verificador
    }
    // Calcula e verifica o primeiro dígito verificador do CNPJ
    const digito1 = calcularDigito(pesos1);
    if (digito1 !== parseInt(cnpj[12])) {
        return false; // Retorna falso se o dígito for inválido
    }
    // Calcula e verifica o segundo dígito verificador do CNPJ
    const digito2 = calcularDigito(pesos2);
    if (digito2 !== parseInt(cnpj[13])) {
        return false; // Retorna falso se o dígito for inválido
    }
    // Retorna verdadeiro se todos os dígitos verificadores forem válidos
    return true;
}
// Função para verificar o CNPJ e exibir o resultado no campo de entrada
function handleVerificarResultado(e) {
    const valor = e.target.value; // Obtém o valor atual do campo
    const resultado = validarCNPJ(valor); // Valida o CNPJ
    // Altera o estilo do input com base no resultado da validação
    if (resultado) {
        e.target.style.borderColor = 'green'; // Colore de verde para válido
        e.target.style.color = 'green';
    } else {
        e.target.style.borderColor = 'red'; // Colore de vermelho para inválido
        e.target.style.color = 'red';
    }
}
// Formatação do campo ao digitar (input event)
inputCnpj.addEventListener('input', function (e) {
    let cnpj = e.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    // Formata a entrada do CNPJ de acordo com a quantidade de dígitos
    if (cnpj.length <= 2) {
        e.target.value = cnpj; // Formato inicial
    } else if (cnpj.length <= 5) {
        e.target.value = cnpj.replace(/(\d{2})(\d{1,3})/, '$1.$2');
    } else if (cnpj.length <= 8) {
        e.target.value = cnpj.replace(/(\d{2})(\d{3})(\d{1,3})/, '$1.$2.$3');
    } else if (cnpj.length <= 12) {
        e.target.value = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3/$4');
    } else {
        e.target.value = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
    }
    // Chama a função para verificar o CNPJ e mudar o estilo do campo
    handleVerificarResultado(e);
});
// Verifica o CNPJ quando o campo perde o foco (blur event)
inputCnpj.addEventListener("blur", (e) => {
    const valor = e.target.value; // Obtém o valor do campo de entrada
    const resultado = validarCNPJ(valor); // Valida o CNPJ
    if (resultado) {
        window.alert("CNPJ Válido!"); // Alerta se o CNPJ é válido
    } else {
        window.alert("CNPJ Inválido!"); // Alerta se o CNPJ é inválido
    }
});
//* Function validadora de texto
function validarTexto(event) {
    const texto = event.target.value;
    // Remove espaços em branco
    const espacamento = texto.trim();
    // Verifica caracteres
    if (espacamento.length <= 3) {
        alert("Inválido! O texto deve conter mais de 3 caracteres.");
    } else {
        alert("Válido! ");
    }
}
const inputMensagem = document.getElementById("mensagem")
inputMensagem.addEventListener("blur", validarTexto)