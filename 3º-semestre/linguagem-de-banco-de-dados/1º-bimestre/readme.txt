ubuntu@ip-172-31-30-74:~$ cat /etc/os-release
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

***********************************************************
instalação mysql

--antes de qualquer instalação atualizamos as bibliotecas
sudo apt update

--sudo representa o admin do linux - root
--apt install - representa a forma em que o ubuntu instala os pacotes
--mysql-server
sudo apt install mysql-server

--sudo - admin
--systemctl - é o coomando para acesso aos serviços do linux
--start - stop - restart - status
--mysql.service - nome do serviço
sudo systemctl start mysql.service