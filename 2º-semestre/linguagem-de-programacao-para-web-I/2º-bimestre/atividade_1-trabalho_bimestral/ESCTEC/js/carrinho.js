let carrinho = [];

// Função para adicionar itens ao carrinho
function adicionarAoCarrinho(nome, preco, imagem) {
    const item = { nome, preco, imagem };
    carrinho.push(item);
    console.log('Produto adicionado ao carrinho:', item);
    alert(`${nome} foi adicionado ao carrinho!`);
}

// Função para exibir o carrinho em um modal (iframe)
function injectCarrinho(event) {
    if (event) event.preventDefault();

    iframeModal.style.display = 'flex';
    iframeContainer.style.display = 'block';
    iframeContainer.innerHTML = '';

    const iframe = document.createElement('iframe');
    iframe.width = '100%';
    iframe.height = '400';
    iframeContainer.appendChild(iframe);

    const iframeDocument = iframe.contentWindow.document;

    iframeDocument.open();
    iframeDocument.write(`
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 20px;
                    }
                    h2 {
                        text-align: center;
                        color: #333;
                    }
                    .item-carrinho {
                        display: flex;
                        justify-content: space-between;
                        padding: 10px;
                        border-bottom: 1px solid #ddd;
                    }
                    .item-carrinho img {
                        width: 50px;
                        height: 50px;
                        margin-right: 10px;
                    }
                    .item-carrinho h4 {
                        margin: 0;
                    }
                    .item-carrinho .preco {
                        color: #4CAF50;
                    }
                    .limpar-carrinho {
                        display: block;
                        width: 100%;
                        padding: 10px;
                        margin-top: 20px;
                        background-color: red;
                        color: white;
                        border: none;
                        cursor: pointer;
                        border-radius: 5px;
                        font-size: 16px;
                    }
                    .limpar-carrinho:hover {
                        background-color: #cc0000;
                    }
                </style>
            </head>
            <body>
                <h2>Seu Carrinho de Compras</h2>
                <div id="itens-carrinho">
                    ${carrinho.length === 0 ? '<p>O carrinho está vazio.</p>' : ''}
                </div>
                <button class="limpar-carrinho" onclick="window.parent.limparCarrinho()">Limpar Carrinho</button>
            </body>
        </html>
    `);
    iframeDocument.close();

    const itensContainer = iframeDocument.getElementById('itens-carrinho');
    carrinho.forEach(item => {
        const divItem = iframeDocument.createElement('div');
        divItem.classList.add('item-carrinho');

        divItem.innerHTML = `
            <img src="../../${item.imagem}" alt="${item.nome}">
            <div>
                <h4>${item.nome}</h4>
                <p class="preco">R$ ${item.preco}</p>
            </div>
        `;
        itensContainer.appendChild(divItem);
    });
}

// Função para limpar o carrinho, fechar o modal e atualizar o conteúdo do iframe
function limparCarrinho() {
    carrinho = [];
    alert('Carrinho limpo!');

    // Fecha o modal imediatamente após a limpeza
    iframeModal.style.display = 'none';
    iframeContainer.style.display = 'none';
    iframeContainer.innerHTML = '';
}

const liInject = document.getElementById('injetaiframe');
const iframeModal = document.getElementById('iframe-modal');
const iframeContainer = document.getElementById('iframe-container');

liInject.addEventListener('click', injectCarrinho);

// Fechar o modal ao clicar fora do iframe
iframeModal.addEventListener('click', function (event) {
    if (event.target === iframeModal) {
        iframeModal.style.display = 'none';
        iframeContainer.style.display = 'none';
        iframeContainer.innerHTML = '';
    }
});
