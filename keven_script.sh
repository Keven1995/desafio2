#!/bin/bash

# Instalar httpd e PHP automaticamente
echo "Verificando se o Apache e o PHP estão instalados..."
if ! command -v httpd &>/dev/null || ! command -v php &>/dev/null; then
    echo "Instalando httpd e PHP..."
    yum install -y httpd php || { echo "Erro ao instalar o httpd e PHP. Saindo."; exit 1; }
fi

# Verificar se o script está sendo executado com permissões de superusuário
if [ "$(id -u)" != "0" ]; then
    echo "Este script deve ser executado como superusuário." 1>&2
    exit 1
fi

# Criar o diretório /etc/content se não existir
echo "Criando diretório /etc/content..."
mkdir -p /etc/content || { echo "Erro ao criar o diretório /etc/content. Saindo."; exit 1; }

# Verificar se o diretório /etc/content está vazio
if [ -z "$(ls -A /etc/content)" ]; then
    echo "O diretório /etc/content está vazio. Criando arquivo de teste..."
    echo "Conteúdo de teste" > /etc/content/test.txt
fi

# Obter o nome do host
hostname=$(cat /etc/hostname)

# Obter o endereço IP
IP_ADDRESS=$(hostname -I | awk '{print $1}')

# Criar diretório para as páginas html/php
echo "Criando diretório /var/www/html/${hostname}.com..."
mkdir -p /var/www/html/${hostname}.com
chown -R apache:apache /var/www/html/${hostname}.com
chmod -R 755 /var/www/html/${hostname}.com

# Copiar conteúdo de /etc/content
echo "Copiando conteúdo de /etc/content para /var/www/html/${hostname}.com/..."
cp -r /etc/content/* /var/www/html/${hostname}.com/ || { echo "Erro ao copiar conteúdo para /var/www/html/${hostname}.com/. Saindo."; exit 1; }

# Criar arquivo de vHost
echo "Criando arquivo de vHost em /etc/httpd/conf.d/${hostname}.com.conf..."
cat << EOF > /etc/httpd/conf.d/${hostname}.com.conf
<VirtualHost *:80>
    ServerName www.${hostname}.com
    ServerAlias ${hostname}.com
    DocumentRoot "/var/www/html/${hostname}.com"
    <Directory "/var/www/html/${hostname}.com">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF

# Configurar firewall
echo "Configurando firewall..."
firewall-cmd --zone=public --add-port=80/tcp --permanent
systemctl reload firewalld

# Atualizar /etc/hosts para adicionar ambos os endereços IP para o mesmo domínio
echo "Atualizando /etc/hosts..."
echo "$IP_ADDRESS www.${hostname}.com" >> /etc/hosts

# Reiniciar httpd
echo "Reiniciando o httpd..."
systemctl restart httpd || { echo "Erro ao reiniciar o httpd. Saindo."; exit 1; }

# Ativar httpd para iniciar automaticamente na inicialização
echo "Ativando o httpd para iniciar automaticamente na inicialização..."
systemctl enable httpd || { echo "Erro ao ativar o httpd para iniciar automaticamente na inicialização. Saindo."; exit 1; }

echo "Configuração concluída com sucesso!"
