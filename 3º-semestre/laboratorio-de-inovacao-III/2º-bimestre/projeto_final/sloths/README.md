<h1 align="center">:file_cabinet: sloths</h1>

## 📜 Descrição
Repositório dedicado ao desenvolvimento do Sloths. Um aplicativo de gerenciamento e progressão de estudos acadêmicos</a>

## :dart: Objetivo

Documentar e salvar todos os arquivos e versionamentos do projeto afim de acompanhar o progresso e servir de documentação prática.

## :wrench: Tecnologias utilizadas

<div>
   
   [![My Skills](https://skillicons.dev/icons?i=vscode,github,html,css,js,mysql,php)](https://skillicons.dev)  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/railway/railway-original.svg" width="48px;"/>
</div>

<!--## 📝 Documentação

A documentação será feita a partir de um documento WORD -->

## 📐 Padrão de commits

Os commits desse projeto serão semânticos e seguirão um padrão inspirado na documentação do <a href="https://www.conventionalcommits.org/pt-br/v1.0.0/">Conventional Commits</a> e neste <a href="https://github.com/iuricode/padroes-de-commits">Readme</a>.
<table>
  <thead>
    <tr>
      <th>Tipo do Commit</th>
      <th>Emoji</th>
      <th>Palavra Chave</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Nova feature</td>
      <td>✨ <code>:sparkles:</code></td>
      <td><code>feat</code></td>
    </tr>
    <tr>
      <td>Mover/Renomear</td>
      <td>🚚 <code>:truck:</code></td>
      <td><code>chore</code></td>
    </tr>
    <tr>
      <td>Removendo um arquivo</td>
      <td>🗑️ <code>:wastebasket:</code></td>
      <td><code>remove</code></td>
    </tr>
    <tr>
      <td>Bug Fix</td>
      <td>🐛 <code>:bug:</code></td>
      <td><code>fix</code></td>
    </tr>
    <tr>
      <td>Documentação</td>
      <td>📚 <code>:books:</code></td>
      <td><code>docs</code></td>
    </tr>
    <tr>
      <td>Estilização de Interface</td>
      <td>💄 <code>:lipstick:</code></td>
      <td><code>feat</code></td>
    </tr>
    <tr>
      <td>Pequena Alteração</td>
      <td>🔨 <code>:hammer:</code></td>
      <td><code>fix</code></td>
    </tr>
    <tr>
      <td>Configuração</td>
      <td>🔧 <code>:wrench:</code></td>
      <td><code>chore</code></td>
    </tr>
    <tr>
      <td>Em progresso</td>
      <td>🚧 <code>:construction:</code></td>
      <td><code>progress</code></td>
    </tr>
    <tr>
      <td>Refatoração</td>
      <td>♻️ <code>:recycle:</code></td>
      <td><code>refactor</code></td>
    </tr>
    <tr>
      <td>Testes</td>
      <td>🧪 <code>:test_tube:</code></td>
      <td><code>test</code></td>
    </tr>
  </tbody>
</table>


## 🗂️ Estrutura do projeto

A estrutura dos diretórios segue a arquitetura MVC

```bash
/sloths                           ← pasta raiz do projeto
├── /app
│   ├── /config                     ← config de banco, ambiente etc
│   │   ├── database.php               ← configuação do banco de dados
│   │   └── db.sql                     ← comandos para as tabelas do projeto
│   ├── /controller                 ← lógica que responde às requisições
│   │   ├── AdminController.php        ← acesso de administrador (RUD)
│   │   ├── AuthController.php         ← autenticação login/logout/cadastro/recuperar_senha
│   │   ├── CalendarioController.php   ← calendario
│   │   ├── ConfigController.php       ← página de configurações
│   │   ├── HomeController.php         ← página principal (dashboard)
│   │   ├── LembreteController.php     ← lembretes
│   │   ├── PerfilController.php       ← edição do perfil (username, foto etc.)
│   │   └── PomodoroController.php     ← pomodoro
│   ├── /model                       ← classes que acessam o banco de dados 
│   │   ├── Evento.php                 ← eventos do calendário
│   │   ├── Lembrete.php               ← lembretes 
│   │   ├── Pomodoro.php               ← pomodoro
│   │   └── Usuario.php                ← usuario    
│   └── /views                       ← arquivos que geram a interface (HTML + PHP)
│       ├── /admin
│       │   ├── lista_usuarios.php     ← lista de usuários
│       │   └── editar_usuario.php     ← edição de usuários (CRUD)
│       ├── /auth
│       │   ├── cadastro.php           ← cadastro
│       │   ├── login.php              ← login
│       │   └── recuperar_senha.php    ← recuperar senha
│       ├── /dashboard
│       │   └── home.php               ← página principal do usuário (dashboard)
│       ├── /pomodoro
│       │   └── pomodoro.php           ← pomodoro
│       ├── /lembrete
│       │   ├── lembrete.php           ← lembrete
│       │   └── modal_editar.php       ← modal para editar lembrete
│       ├── /calendario
│       │   ├── calendario.php         ← calendario
│       │   └── modal_editar.php       ← modal para editar eventos
│       ├── /perfil
│       │   └── perfil.php             ← editar perfil
│       └── /configuracoes
│           └── configuracoes.php      ← configurações (Settings)
├── /assets                          ← arquivos estáticos: imagens, css, js frontend
│   ├── /css
│   ├── /js
│   └── /images
└── index.php                          ← roteador principal
```

## 🤖 Como executar o projeto (LOCALMENTE)

### - Pré-requisitos 📋

- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Apache/Nginx (XAMPP recomendado)

### - Configuração do Ambiente 🧩 

1. Clone o repositório:

```bash
git clone https://github.com/OtavioMendesSantos/sloths.git
cd sloths
```

2. Configure as variáveis de ambiente:
   - Crie um arquivo `.env` na raiz do projeto
   - Copie o conteúdo do arquivo `.env.example`
   - Preencha as variáveis com suas configurações:

```env
DB_HOST=localhost
DB_PORT=3306 (padrão local)
DB_USER=seu_usuario
DB_PASSWORD=sua_senha
DB_DATABASE=sloths
```

3. Configure o servidor web:
   - Se estiver usando XAMPP:
     - Copie a pasta do projeto para `htdocs`
     - Acesse através de `http://localhost/sloths`
   - Se estiver usando outro servidor:
     - Configure o DocumentRoot para apontar para a pasta do projeto
     - Certifique-se que o mod_rewrite está habilitado

### - Estrutura do Banco de Dados 🎲
Execute os comandos SQL disponíveis em `app/config/db.sql`.

### - Executando o Projeto 🚀
1. Inicie seu servidor web (Apache) e MySQL.
2. Acesse o projeto através do navegador:

   - Se usando XAMPP: `http://localhost/sloths`
   - Se usando outro servidor: `http://seu-dominio/sloths`

3. Crie um usuário de teste:
   - Acesse a página de cadastro
   - Preencha os dados necessários
   - Faça login com as credenciais criadas

<!-- ### - Estrutura de Diretórios

O projeto segue o padrão MVC com a seguinte estrutura:

```
/sloths
├── /app
│   ├── /config
│   ├── /controller
│   ├── /model
│   └── /views
├── /assets
└── index.php
``` -->

### - Troubleshooting ⚠️

Se encontrar problemas:

1. Verifique se todas as extensões PHP necessárias estão habilitadas:

   - mysqli
   - pdo_mysql
   - mbstring
   - json

2. Verifique as permissões dos diretórios:

   - Certifique-se que o servidor web tem permissão de escrita nos diretórios necessários

3. Verifique os logs de erro:
   - Apache: `xampp/apache/logs/error.log`
   - PHP: `php_error.log`

### - Contribuindo 💡

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -m 'feat: adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request!

## :handshake: Colaboradores

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/otaviomendessantos">
        <img src="https://avatars.githubusercontent.com/u/145459372?v=4" width="100px;" alt="Foto de Otávio Mendes no GitHub"/><br>
        <sub>
          <b>otaviomendessantos</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/judah-lopes">
        <img src="https://avatars.githubusercontent.com/u/134812191?s=400&u=00a571215f2ea321a8738af235cea655e1e36ec6&v=4" width="100px;" alt="Foto de Judah Lopes no GitHub"/><br>
        <sub>
          <b>judah-lopes</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/Matheuspsm12">
        <img src="https://avatars.githubusercontent.com/u/136357212?v=4" width="100px;" alt="Foto de Matheus Peixoto no GitHub"/><br>
        <sub>
          <b>Matheuspsm12</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/Du-santana">
        <img src="https://avatars.githubusercontent.com/u/165734323?v=4" width="100px;" alt="Foto de Eduardo Santana no GitHub"/><br>
        <sub>
          <b>Du-santana</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/notsireh">
        <img src="https://avatars.githubusercontent.com/u/183026024?v=4" width="100px;" alt="Foto de Heriston Davi no GitHub"/><br>
        <sub>
          <b>notsireh</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/caslusant">
        <img src="https://avatars.githubusercontent.com/u/125915251?v=4" width="100px;" alt="Foto de Lucas Santos no GitHub"/><br>
        <sub>
          <b>caslusant</b>
        </sub>
      </a>
    </td>
  </tr>
</table>