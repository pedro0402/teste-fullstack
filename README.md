# Sistema de Agendamento — CakePHP 2

Sistema web completo para gestão de agendamentos, prestadores de serviço e serviços.

---

## ✔️ Tecnologias Utilizadas

- **CakePHP 2**
- **PHP 5.6**
- **MySQL**
- **jQuery**
- **HTML, CSS e JavaScript**

---

## 🎯 Funcionalidades

- **Cadastro, edição e deleção de Prestadores de Serviço**
- **Cadastro, edição e deleção de Serviços**
- **Cadastro, edição e deleção de Agendamentos**
- Interface moderna e responsiva
- Máscaras dinâmicas de formulário (telefone, datas)
- Relacionamento completo entre Prestadores, Serviços e Agendamentos

---

## 🚀 Instalação e Configuração

### 1. **Requisitos:**
- PHP **5.6** (ou superior compatível com CakePHP 2)
- MySQL
- Composer ([opcional, para instalar dependências](https://getcomposer.org/))
- Webserver Apache/Nginx

### 2. **Clonar o projeto**
```bash
git clone (https://github.com/pedro0402/teste-fullstack.git)
cd SEU_REPO/app
```

### 3. **Configurar o banco de dados**
- Copie o arquivo de configuração:
    ```bash
    cp Config/database.php.default Config/database.php
    ```
- Edite `Config/database.php` com os dados do seu banco MySQL:
    ```php
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'usuario',
        'password' => 'senha',
        'database' => 'sistema_joao',
        'prefix' => '',
        'encoding' => 'utf8',
    );
    ```

### 4. **Rodar as migrations para criar o banco**
- Garanta que o plugin [CakeDC Migrations](https://github.com/CakeDC/migrations) esteja em `/app/Plugin/Migrations`.
- Rode:
    ```bash
    cd /caminho/para/seu_projeto/app
    Console/cake Migrations.migration run all
    ```
- Isso irá criar todas as tabelas e relacionamentos de acordo com os scripts versionados.

### 5. **Ajustar permissões (ambiente local)**
```bash
chmod -R 775 webroot/img/uploads
chown -R www-data:www-data webroot/img/uploads
```
(Substitua `www-data` pelo usuário do seu servidor web, se necessário.)

---

## 📂 Estrutura Geral das Pastas

- **/app/Controller/** — Lógicas de controle
- **/app/Model/** — Modelos de dados e regras de negócio
- **/app/View/** — Telas e templates (HTML, CSS, JS)
- **/app/Plugin/Migrations/** — Scripts de migrations para o banco
- **/app/webroot/** — Pública (assets, imagens, uploads)

---

## 💡 Como usar

- Acesse [http://localhost/prestadores](http://localhost/prestadores) para a tela inicial (home)
- Realize o cadastro/edição/exclusão de **Prestadores**, **Serviços** e **Agendamentos**
- Uploads de imagens de prestadores vão para `webroot/img/uploads/prestadores/`

---

## 🛠️ Principais comandos

- __Gerar nova migration (CakePHP 2)__:  
  ```
  Console/cake Migrations.migration generate
  ```
- __Rodar migrations__:  
  ```
  Console/cake Migrations.migration run all
  ```
- __(Opcional) Restaurar o banco “do zero”__:
  ```
  # Apague o banco e rode novamente as migrations
  ```

---

## Demonstração do Projeto

[Clique aqui para entender como o projeto funciona](https://youtu.be/izS_swhOnOk)

---

---

## 👤 Sobre

Desenvolvido com [CakePHP 2](https://book.cakephp.org/2/pt/) por Pedro Moraes.

---
