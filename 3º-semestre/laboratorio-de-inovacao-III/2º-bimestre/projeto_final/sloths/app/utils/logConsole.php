<?php

function logConsole($message) {
    // Esta função envia a mensagem de log para o arquivo de log de erros do servidor web
    // (ex: xampp/apache/logs/error.log) em vez de tentar mostrá-la no navegador.
    // É uma boa prática para debugar no lado do servidor.
    error_log("Sloths App: " . $message);
}