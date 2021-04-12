# Kabum Clientes

![Solid](https://logodownload.org/wp-content/uploads/2017/11/kabum-logo.png)


Aplicação Kabum Cliente é uma aplicação para registro de clientes.
Feito com:

- Back-End: Rest API com PHP
- Front-End: ReactJS
- Banco de dados: MySQL

## Requisitos para rodar o projeto

- MySQL na versão 8.x
- PHP na versão 7.4.x
- Nodejs na versão 15.11.x
- NPM na versão 7.6.x
ou
- Yarn na versão 1.22.10

## Instalação

Clone o projeto na pasta de projetos do seu sistema.
Após clonar, entre na pasta do projeto.

Na pasta do servidor vamos podemos alterar algumas configurações de conexão do banco de dados caso elas não sejam compativeis com seu ambiente.
```php
    define('TYPE', 'mysql');
    define('HOST', ENV ? '' : 'localhost');
    define('DTBS', ENV ? '' : 'kabum');
    define('USER', ENV ? '' : 'root');
    define('PASS', ENV ? '' : '');
```
Você pode mudar no nome da tabela em "DTBS", a senha em "PASS" e o Usuario em "USER".

Depos na pasta Database dentro do server, existem 3 arquivos:
- kabum.sql
 Banco de dados exportado já com alguns dados cadastrados que você pode importar no seu SGBD
- insominiarotas.json
 Ambiente de teste para o Software Insominia com todas as conexões possiveis
- insominiarotas.har
 Ambiente de teste para o Software Insominia com todas as conexões possiveis

O Front-End você ira entrar via terminal na pasta *web/*
e rodar o yarn ou npm

```sh
cd web
npm install -l
```
ou
```sh
cd web
yarn
```

Na pasta *services/* devemos alterar o arquivo *api.js*
Você deve passar o ip onde está rodando o servidor com o PHP e a API Rest que foi desenvolvido.
Exemplo: Meu ambiente é uma maquina virtual linux que roda com um ip diferente do meu localm então tive que pegar o IP da maquina e inserir no "baseURL".

```sh
const api = axios.create({
    baseURL: "http://seuiplocal/kabum/server"
});
```

Pronto para rodar.
