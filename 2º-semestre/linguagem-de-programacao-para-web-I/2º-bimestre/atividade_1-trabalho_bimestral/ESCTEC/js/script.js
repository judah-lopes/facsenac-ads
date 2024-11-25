// FUNÇÃO DE COMBOBOX PARA PREENCHER VENDEDOR
function preencherFormularioVendedores() {
    const vendedorSelecionado = document.getElementById("vendedor");
    const valorVendedorSelecionado = vendedorSelecionado.value;

    const fEmpresa = document.getElementById("empresa");
    const fEndereco = document.getElementById("endereco");
    const fCidade = document.getElementById("cidade");
    const fUf = document.getElementById("uf");
    const fTelefone = document.getElementById("telefone");
    const fEmail = document.getElementById("email");

    // Dados dos vendedores
    const dadosVendedores = {
        vendedor1: { empresa: "ESCTEC", endereco: "Av. D, 101", uf: "BA", cidade: "Xique-Xique", telefone: "444-444-4444", email: "ana.oliveira@esctec.com" },
        vendedor2: { empresa: "ESCTEC", endereco: "Rua A, 123", uf: "SP", cidade: "Ubatuba", telefone: "111-111-1111", email: "carlos.almeida@esctec.com" },
        vendedor3: { empresa: "ESCTEC", endereco: "Rua C, 789", uf: "MG", cidade: "Paracatu", telefone: "333-333-3333", email: "jose.santos@esctec.com" },
        vendedor4: { empresa: "ESCTEC", endereco: "Av. B, 456", uf: "RJ", cidade: "Belford Roxo",telefone: "222-222-2222", email: "mariana.silva@esctec.com" },
        vendedor5: { empresa: "ESCTEC", endereco: "Rua E, 202", uf: "RS", cidade: "Canoas",telefone: "555-555-5555", email: "pedro.costa@esctec.com" }
    };

    // Preencher campos com base no vendedor selecionado
    if (dadosVendedores[valorVendedorSelecionado]) {
        fEmpresa.value = dadosVendedores[valorVendedorSelecionado].empresa;
        fEndereco.value = dadosVendedores[valorVendedorSelecionado].endereco;
        fCidade.value = dadosVendedores[valorVendedorSelecionado].cidade;
        fUf.value = dadosVendedores[valorVendedorSelecionado].uf;
        fTelefone.value = dadosVendedores[valorVendedorSelecionado].telefone;
        fEmail.value = dadosVendedores[valorVendedorSelecionado].email;
    } else {
        // Limpa os campos se nenhum vendedor estiver selecionado
        fEmpresa.value = "";
        fEndereco.value = "";
        fCidade.value = "";
        fUf.value = "";
        fTelefone.value = "";
        fEmail.value = "";
    }
}

// FUNÇÃO CARROSSEL
document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelector('.slides');
    const totalSlides = slides.children.length;
    let currentIndex = 0;

    function showNextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        slides.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    setInterval(showNextSlide, 3000); // Muda a imagem a cada 3 segundos
});

// FUNÇÃO COMBOBOX PRA PREENCHER PRODUTO, VALOR ETC.
function preencherFormularioProd(selectElement) {
    // Encontrar o contêiner pai (.produto-item) que contém o select atual
    const produtoItem = selectElement.closest('.produto-item');

    const valorProdutoSelecionado = selectElement.value;

    // Encontrar os campos dentro do mesmo contêiner
    const fValor = produtoItem.querySelector('.valor');
    const fDesc = produtoItem.querySelector('.descricao');

    // Dados dos produtos
    const cadeiras = {
        cd_01: { descricao: "Cadeira Dot - All Black", valorUnit: 250.00 },
        cd_02: { descricao: "Cadeira Uni - All Black", valorUnit: 370.00 },
        cd_03: { descricao: "Cadeira Uni Pro - All Black", valorUnit: 692.00 },
        cd_04: { descricao: "Cadeira My Chair - grafite e azul", valorUnit: 810.00 },
        cd_05: { descricao: "Cadeira Tecton - night blue", valorUnit: 1591.00 },
        cd_06: { descricao: "Cadeira Flexform Alpha 2 Pro - preta", valorUnit: 3180.00 }
    };

    const mesas = {
        ms_01: { descricao: "Mesa Dalla Costa em L c/ Gaveteiro", valorUnit: 663.00 },
        ms_02: { descricao: "Escrivaninha 135cm c/ Gaveteiro Suspenso", valorUnit: 239.99 },
        ms_03: { descricao: "Mesa Nogal 270cm c/ Caixas de Tomadas", valorUnit: 1381.00 },
        ms_04: { descricao: "Mesa Nogal 380cm c/ Caixas de Tomadas", valorUnit: 1241.00 },
        ms_05: { descricao: "Mesa Industrial Redonda 110cm", valorUnit: 3715.00 },
        ms_06: { descricao: "Mesa L 120x120cm - Tampo 2,5cm", valorUnit: 251.00 }
    };
    
    const diversos = {
        dv_01: { descricao: "Kit de acessórios My Desk", valorUnit: 181.83 },
        dv_02: { descricao: "Mesa Jump Baixa", valorUnit: 679.00 },
        dv_03: { descricao: "Banco Benni", valorUnit: 802.00 },
        dv_04: { descricao: "Roma Espera", valorUnit: 599.00 },
        dv_05: { descricao: "Poltrona Vitto", valorUnit: 829.00 },
        dv_06: { descricao: "Mesa de centro Mince - preta", valorUnit: 699.99 },
        dv_07: { descricao: "Organizador de Gaveta 17x25,5cm - preto", valorUnit: 10.56 },
        dv_08: { descricao: "Suporte Multiarticulado de Mesa - grafite", valorUnit: 164.00 }
    };    

    // Verifica se o produto selecionado está nas cadeiras, mesas ou diversos
    if (cadeiras[valorProdutoSelecionado]) {
        fValor.value = cadeiras[valorProdutoSelecionado].valorUnit.toFixed(2);
        fDesc.value = cadeiras[valorProdutoSelecionado].descricao;
    } else if (mesas[valorProdutoSelecionado]) {
        fValor.value = mesas[valorProdutoSelecionado].valorUnit.toFixed(2);
        fDesc.value = mesas[valorProdutoSelecionado].descricao;
    } else if (diversos[valorProdutoSelecionado]) {
        fValor.value = diversos[valorProdutoSelecionado].valorUnit.toFixed(2);
        fDesc.value = diversos[valorProdutoSelecionado].descricao;
    } else {
        fValor.value = ""; // Limpa o campo caso nenhum produto seja encontrado
        fDesc.value = "";
    }
}

// FUNÇÃO PRA CALCULAR O VALOR TOTAL DE CADA PRODUTO
function calcValorTotalProduto(element) {
    // Encontrar o contêiner pai (.produto-item) do campo de quantidade alterado
    var produtoItem = element.closest('.produto-item');

    // Selecionar os campos dentro do mesmo produto-item
    var qtdSelecionada = produtoItem.querySelector('.qtd').value;
    var valorProd = produtoItem.querySelector('.valor').value;
    var fTotal = produtoItem.querySelector('.total');

    // Calcular o valor total
    var valorTotal = qtdSelecionada * valorProd;

    // Exibir o valor total no campo correspondente
    fTotal.value = valorTotal ? valorTotal.toFixed(2) : ''; // Exibir vazio se não houver valor

    // Atualiza o valor total do pedido
    calcularValorTotalPedido();
}

// FUNção PRA CALCULAR O VALOR TOTAL DO PEDIDO
function calcularValorTotalPedido() {
    // Seleciona todos os campos de valor total de cada produto
    var totalProdutos = document.querySelectorAll('.produto-item .total');
    var somaTotal = 0;

    // Percorre cada total individual e adiciona ao valor total do pedido
    for (var i = 0; i < totalProdutos.length; i++) {
        var valor = parseFloat(totalProdutos[i].value) || 0; // Converte para número, ou 0 se estiver vazio
        somaTotal += valor;
    }

    // Preenche o campo de valor total do pedido com a soma total calculada
    var campoValorTotalPedido = document.getElementById('valor-total');
    campoValorTotalPedido.value = somaTotal.toFixed(2);
}

// FUNÇÃO ADICIONAR PRODUTO
let contadorProdutos = 2;

function adicionarProduto() {
    // Container de produtos
    const containerProdutos = document.getElementById('produtos');

    // Criar um novo elemento de produto-item
    const novoProduto = document.createElement('div');
    novoProduto.classList.add('produto-item');

    // Inserir HTML do novo produto
    novoProduto.innerHTML = `
        <hr style="width: 70%; margin: 0 auto 25px;">
        <label>Produto ${contadorProdutos}</label><br>
        <select class="produto" onchange="preencherFormularioProd(this)" required>
            <option value="">Selecione um produto</option>
            
            <!-- Cadeiras -->
            <option value="">---- CADEIRAS --------------</option>
            <option value="cd_01">CD01</option>
            <option value="cd_02">CD02</option>
            <option value="cd_03">CD03</option>
            <option value="cd_04">CD04</option>
            <option value="cd_05">CD05</option>
            <option value="cd_06">CD06</option>
            
            <!-- Mesas -->
            <option value="">---- MESAS -----------------</option>
            <option value="ms_01">MS01</option>
            <option value="ms_02">MS02</option>
            <option value="ms_03">MS03</option>
            <option value="ms_05">MS04</option>
            <option value="ms_04">MS05</option>
            <option value="ms_06">MS06</option>
            
            <!-- Diversos -->
            <option value="">---- DIVERSOS -------------</option>
            <option value="dv_01">DV01</option>
            <option value="dv_02">DV02</option>
            <option value="dv_03">DV03</option>
            <option value="dv_04">DV04</option>
            <option value="dv_05">DV05</option>
            <option value="dv_06">DV06</option>
            <option value="dv_07">DV07</option>
            <option value="dv_08">DV08</option>
        </select>
        
        <input type="text" class="descricao" placeholder="Descrição" readonly>

        <div class="qtd-valor">
            <input type="number" class="qtd" placeholder="Quantidade" min="1" onchange="calcValorTotalProduto(this)" required>
            <input type="text" class="valor" placeholder="Valor Unitário" required readonly>
        </div>
        
        <label>Total: 
        <input type="text" class="total" placeholder="Valor Total" readonly>
    `;

    contadorProdutos++;

    // Adicionar o novo produto ao containerProdutos
    containerProdutos.appendChild(novoProduto);
}

// FUNÇÃO DE SAUDAÇÃO
function exibirSaudacao() {
    const saudacaoDiv = document.getElementById('saudacao');
    const hora = new Date().getHours();
    let mensagem;

    if (hora >= 6 && hora < 12) {
        mensagem = "Bom dia!";
    } else if (hora >= 12 && hora < 18) {
        mensagem = "Boa tarde!";
    } else {
        mensagem = "Boa noite!";
    }

    saudacaoDiv.textContent = mensagem;
    saudacaoDiv.style.color = "white"; // Ajuste de cor conforme o tema
    saudacaoDiv.style.fontSize = "1.2em";
    saudacaoDiv.style.marginTop = "8px"; // Ajuste de espaçamento
    saudacaoDiv.style.display = "block"; // Exibe a div de saudação

    // Oculta a saudação após 3 segundos
    setTimeout(() => {
        saudacaoDiv.style.display = "none";
    }, 3000);
}

window.onload = exibirSaudacao; // Executa a função ao carregar a página