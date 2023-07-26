# Projeto Leads 🚀

Um projeto para por em prática conhecimentos de Laravel, Laravel Breeze, PHP, JS, CSS, Bootstrap e MySQL.

___

## Índice 📚

- [Pré-requisitos](#pré-requisitos)
- [Configuração do ambiente](#configuração-do-ambiente)
- [Executando o projeto](#executando-o-projeto)
- [Testes](#testes)
- [Como contribuir](#como-contribuir)
- [Contato](#contato)
- [Problemas](#problemas)


___

# Pré-requisitos 🛠️

- PHP >= 7.4
- PDO PHP Extension
- MySQL
- Você precisa do Composer instalado em sua máquina para gerenciar as dependências PHP.
- Node.js e NPM (Node Package Manager) para compilar assets.

___

# Configuração do ambiente 🔧

Após clone do projeto, criar o banco de dados configurar conexão ao banco de dados pelo arquivo .env.

Exemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leads
DB_USERNAME=admin
DB_PASSWORD=123
```

___

# Executando o projeto 🚀

Rodar os comandos na seguinte sequencia:

`php artisan migrate` => Cria as tabelas
`php artisan db:seed --class=UsersTableSeeder` => Cria o usuario Admin e os usuários padrões

Tudo certo até aqui?
Execute o comando `php artisan serve` para subir o laravel e poder acessar a página.

___

# Testes ⚙️

Para logar com o usuario Admin:
Login: admin@lds.com / Senha: 12345678

Para logar com os usuarios padrão:
Login: maria@lds.com / Senha: 12345678
Login: joao@lds.com / Senha: 12345678

___

# Como contribuir 🤝

Faça o clone do projeto, e se divirta!
Fez algo interessante? Crie um PULL REQUEST detalhando o que foi adicionado/alterado que em breve estarei fazendo o seu code review!

___

# Contato 📞

Linkedin: https://www.linkedin.com/in/thiago-silva-a88a61219/
___

# Problemas? ⚙️

Tente executar os comandos `composer install` e `npm install`, parar o servidor e rodar novamente (`php artisan serve`).

