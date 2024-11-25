//* Validação de Email
const inputEmail = document.querySelector('#femail-id');
console.log(inputEmail);
function handleBlur(event) {
    // Pega o valor digitado no campo de e-mail.
    const email = event.target.value;
    // Define uma expressão regular para verificar se o formato do e-mail é válido.
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    // Usa o método 'test' para verificar se o valor do e-mail corresponde à expressão regular.
    const validate = regex.test(email);
    // Se o e-mail for válido:
    if (validate) {
        // Adiciona a classe 'valido' ao campo e remove a classe 'invalido', caso exista.
        inputEmail.classList.add('valido');
        inputEmail.classList.remove('invalido');
        // Exibe uma mensagem de alerta indicando que o e-mail é válido.
        alert("Email Válido");
    } else {
        // Se o e-mail for inválido, adiciona a classe 'invalido' ao campo e remove a classe 'valido'.
        inputEmail.classList.add('invalido');
        inputEmail.classList.remove('valido');
        // Exibe uma mensagem de alerta indicando que o e-mail é inválido.
        alert("Email Inválido");
    }
}
// Função que será executada quando o evento 'input' (alteração de conteúdo) acontecer no campo de e-mail.
function validateEmail(event) {
    // Pega o valor digitado no campo de e-mail.
    const email = event.target.value;
    // Define a mesma expressão regular para verificar se o formato do e-mail é válido.
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    // Usa o método 'test' para verificar se o valor do e-mail corresponde à expressão regular.
    const validate = regex.test(email);
    // Se o e-mail for válido:
    if (validate) {
        // Adiciona a classe 'valido' e remove a classe 'invalido'.
        inputEmail.classList.add('valido');
        inputEmail.classList.remove('invalido');
    } else {
        // Se o e-mail for inválido, adiciona a classe 'invalido' e remove a classe 'valido'.
        inputEmail.classList.add('invalido');
        inputEmail.classList.remove('valido');
    }
}
// Adiciona um ouvinte de evento 'blur' ao campo de e-mail, que chama a função 'handleBlur' ao perder o foco.
inputEmail.addEventListener('blur', handleBlur);
// Adiciona um ouvinte de evento 'input' ao campo de e-mail, que chama a função 'validateEmail' ao digitar.
inputEmail.addEventListener('input', validateEmail);