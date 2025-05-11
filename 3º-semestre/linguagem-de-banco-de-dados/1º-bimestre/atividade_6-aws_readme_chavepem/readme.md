# Comando para checar infos do linux

```cat /etc/os-release```

- cat: copia para imprimir no terminal (print)


PRETTY_NAME="Ubuntu 24.04.2 LTS"
NAME="Ubuntu"
VERSION_ID="24.04"
VERSION="24.04.2 LTS (Noble Numbat)"
VERSION_CODENAME=noble
ID=ubuntu
ID_LIKE=debian
HOME_URL="https://www.ubuntu.com/"
SUPPORT_URL="https://help.ubuntu.com/"
BUG_REPORT_URL="https://bugs.launchpad.net/ubuntu/"
PRIVACY_POLICY_URL="https://www.ubuntu.com/legal/terms-and-policies/privacy-policy"
UBUNTU_CODENAME=noble
LOGO=ubuntu-logo

---

# Comando para atualizar pacotes do Ubuntu

```sudo apt update```

- sudo: Executa o comando como root (no windows, "administrador")
- apt: gerenciador de packages (como um "npm" no node.js)
- update: atualiza os pacotes

--- 

# Instalação mysql

```sudo apt install mysql-server```

- sudo: representa o admin do linux (root)
- apt install: acessa o gerenciador de pacotes e manda instalar um novo
- mysql-server: qual pacote o apt deve instalar, no caso o pct do mysql 


# Iniciar o mysql

```sudo systemctl start mysql.service```


- systemctl: É o comando para acesso aos serviços do linux
- start - stop - restart - status: Comandos
- mysql.service: nome do serviço