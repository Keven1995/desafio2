# Configuração Automática de Apache e PHP
Este repositório contém um script em bash para automatizar a instalação e configuração do Apache (httpd) e PHP em um servidor CentOS/RHEL. O script também configura um virtual host, cria um diretório para armazenar arquivos de conteúdo web e atualiza o arquivo de hosts para associar o endereço IP do servidor ao domínio especificado.

# Uso
Certifique-se de executar o script com permissões de superusuário para garantir que as operações de instalação e configuração sejam concluídas com sucesso. Você pode executar o script usando o seguinte comando:

Use o código: sudo ./keven_script.sh

O script irá verificar se o Apache e o PHP estão instalados e, se não estiverem, irá instalar automaticamente. Em seguida, ele criará um diretório para armazenar os arquivos de conteúdo web e copiará um arquivo de teste para esse diretório. Além disso, ele configurará um virtual host para o domínio especificado, abrirá a porta 80 no firewall e atualizará o arquivo de hosts para associar o endereço IP do servidor ao domínio.

Após a execução bem-sucedida do script, o Apache será reiniciado automaticamente e a configuração estará concluída.

# Requisitos
CentOS/RHEL
Permissões de superusuário

# Notas
Se estiver usando o windows certifique-se de acessar o seu arquivo "Host" e adicionar o DNS. 

Este script foi testado apenas em sistemas CentOS/RHEL e pode não funcionar corretamente em outras distribuições Linux.