# 🎓 Desafio FIAP - Aplicação de Gestão de Alunos e Turmas

Este projeto é uma aplicação web desenvolvida para gerenciar **alunos**, **turmas** e **matrículas**. Ele permite criar, listar, editar e excluir informações, além de gerenciar administradores.

---

## 📋 Pré-requisitos

Certifique-se de ter os seguintes componentes instalados:

- **PHP** 7.4 ou superior  
- **MySQL** 5.7 ou superior  
- **Servidor Web** (ex.: Apache ou Nginx)  
- Um editor de texto ou IDE (ex.: Visual Studio Code)

---

## 🔧 Instalação

### 1️⃣ Clonar o repositório

Execute os comandos abaixo para clonar o projeto e acessar o diretório:

```bash
git clone https://github.com/G-abriel10143/DESAFIO-PHP.git
cd DESAFIO-PHP
2️⃣ Configurar o Banco de Dados
Abra o arquivo dump.sql na pasta do projeto.

Acesse seu MySQL utilizando o terminal ou uma ferramenta como o MySQL Workbench.

Execute o script SQL para criar o banco de dados e as tabelas necessárias:

SOURCE /dump.sql;

Você também pode copiar o conteúdo do arquivo e executá-lo diretamente na área de query do MySQL Workbench.

3️⃣ Configurar a Conexão com o Banco
Abra o arquivo data/Database.php e edite as credenciais conforme necessário:

Certifique-se de ajustar os valores das variáveis:

$host: Endereço do banco de dados.

$dbname: Nome do banco de dados (use desafio_fiap).

$user: Usuário do banco de dados.

$pass: Senha do banco de dados.

4️⃣ Instalar as Dependências

🚀 Execução
✅ Opção 1: Usando o servidor PHP embutido
Execute o comando abaixo no terminal:


php -S localhost:8000
Depois, acesse a aplicação no navegador:

http://localhost:8000
✅ Opção 2: Usando Apache ou XAMPP
Coloque a pasta do projeto DESAFIO-PHP dentro do diretório do Apache:


C:\Apache24\htdocs\
Ou, se estiver utilizando XAMPP:


C:\xampp\htdocs\
Acesse no navegador:

http://localhost/DESAFIO-PHP
🛠️ Funcionalidades
Gestão de Alunos

Listar, adicionar, editar e excluir alunos.

Gestão de Turmas

Listar, adicionar, editar e excluir turmas.

Gestão de Matrículas

Matricular alunos em turmas e gerenciar vínculos.

Administração

Controle de acesso de administradores.