# CAOL - Controle de Atividades Online

Sistema para controlar as actividades onlines dos consultores, medir a receita gerada, custos fixos e lucros dos projetos de desenvolvimento e manutenção de sistemas.

Possui um sistema de Login para que os consultores cadastrados possam consultar o sistema.

## Requerimentos técnicos mínimos:
- PHP 5.0 ou superior
- mySQL versão 5.6.21 ou superior
- Apache/2.4.10

## Instalação

**Cópia de Arquivos no servidor:**

- Ir para a pasta do servidor web. Exemplo: `cd /var/www/minha_pasta`.
- Clonar o repo usando git clone: `git clone git@github.com:upcesar/caol.git`.
- Caso não tenha acesso ao servidor Web, pode clonar o repositório e transferir os arquivos via FTP, desde sua máquina local.

**Preparação do Banco de Dados:**
- Criar o bando de dados mySQL (nome padrão 'caol').
- Executar os scripts localizados na pasta `script-db`, conforme a ordem indicada no prefixo de cada arquivo `.sql`

**Configuração:**
- Alterar as seguintes linhas no arquivo `.htaccess`para definir o caminho virtual na reescrita de URL: `RewriteBase` e `RewriteRule`
- Configurar o arquivo `application/config/{ambiente}/database.php` para colocar os dados de conexão com a base.
