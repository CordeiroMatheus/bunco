# Bunco – Site Oficial

**Bunco - A lógica por trás das grandes ideias**

> Site oficial do projeto Bunco, a lógica por trás das grandes ideias.

## Índice

- [Sobre](#sobre)
- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Instalação e Início](#instalacao-e-inicio)
- [Criação do banco de dados](#criacao-do-banco-de-dados)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Autores](#autores)

## Sobre

Meu nome é **Matheus Cordeiro**, e este é o **site do projeto Bunco**, desenvolvido como parte do nosso **TCC para a obtenção do título de técnico em Desenvolvimento de Sistemas na ETEC de Mauá**.  

O projeto foi desenvolvido em conjunto com meus colegas e amigos: **João Pedro**, responsável pelo aplicativo mobile e pelas APIs, e **Gabriel Linhares**, responsável pela prototipagem e design.  

O Bunco surgiu da união entre o interesse pela área educacional, nosso conhecimento em tecnologia e a inspiração na didática do Duolingo, resultando em uma plataforma que ensina **Python de forma interativa e acessível**.  

Este repositório contém exclusivamente o código do **site**, responsável por apresentar o projeto, divulgar o aplicativo e servir como ponto de acesso principal para os usuários. O site pode ser acessado em:  
https://bunco.alwaysdata.net

## Funcionalidades

As principais funcionalidades do site são:

- Página apresentando a finalidade do Bunco.
- Divulgação do aplicativo e de seus objetivos educacionais.
- Acesso ao aplicativo por meio de um apk.
- Interface responsiva para desktop e dispositivos móveis.
- Design alinhado à identidade visual criada para o projeto.

## Tecnologias Utilizadas

- HTML
- CSS
- JavaScript
- PHP

## Instalação e Início

Antes de começar, certifique-se de ter instalado o **Git** e um **navegador moderno** (Google Chrome, Firefox, Edge, etc.). É recomendado o uso de um servidor local utilizando ferramentas como o Laragon ou XAMPP.

Clone o repositório do projeto:

git clone https://github.com/CordeiroMatheus/bunco.git

Após clonar o repositório, mova a pasta do projeto para o diretório raiz do servidor local:

- Laragon: C:\laragon\www
- XAMPP: C:\xampp\htdocs

O caminho final deverá ficar, por exemplo:

C:\laragon\www\bunco

Ou

C:\xampp\htdocs\bunco

## Criação do banco de dados 

Antes de acessar o site, é necessário criar o banco de dados MySQL.

Você pode fazer isso de duas formas:

Opção 1 — Pelo phpMyAdmin (Laragon ou XAMPP)

1. Inicie o Apache e o MySQL.
2. Acesse http://localhost/phpmyadmin.
3. Crie um banco de dados (por exemplo: bunco).
4. Importe o arquivo SQL localizado em:
database/bunco_database.sql

Opção 2 — Pelo terminal MySQL

```
mysql -u root -p
CREATE DATABASE bunco;
USE bunco;

A partir deste ponto, execute todo o resto do conteúdo do arquivo
database/bunco_database.sql dentro do MySQL.

Acesse o localhost após iniciar o Laragon ou o XAMPP:
http://localhost/bunco
```

## Estrutura do Projeto

```
bunco/
├─ api/                      # Pasta de APIs para o mobile 
│  ├─ conexao/ 
│  │  └─ conexao.php         # Conexão com o banco de dados
│  ├─ eventos/
│  │  └─ atualizarVida.php   # Atualização de vidas do usuário
│  ├─ headers/              
│  │  └─ headers.php         # Headers padrão da API
│  ├─ alterarCor.php
│  ├─ alterarEmail.php
│  ├─ alterarFoto.php
│  ├─ alterarLinks.php
│  ├─ alterarNome.php
│  ├─ alterarSenha.php
│  ├─ alterarUsername.php
│  ├─ buscarAula.php
│  ├─ buscarCurso.php
│  ├─ buscarModulo.php
│  ├─ buscarUsuario.php
│  ├─ cadastrar.php
│  ├─ concluirAula.php
│  ├─ excluir.php
│  ├─ login.php
│  ├─ ofensiva.php
│  ├─ perderVida.php
│  └─ ranking.php
│
├─ app/
│  └─ app_bunco.apk        # APK do aplicativo Android
│
├─ assets/                 # Recursos do site
│  ├─ css/                 # Estilos do site
│  │  ├─ formstyle.css           
│  │  ├─ perfil.css
│  │  └─ style.css           
│  │
│  ├─ img/                       # Imagens do projeto
│  │  ├─ buncos/                 # Avatares e variações do personagem Bunco
│  │  ├─ formimg/                # Imagens de formulários (login e cadastro)
│  │  ├─ icones/                 # Ícones da interface
│  │  ├─ integrantes/            # Imagens dos integrantes do projeto
│  │  ├─ medalhas/               # Medalhas e progresso dos módulos
│  │  └─ outros arquivos SVG/PNG # Backgrounds, artes e elementos visuais
│  │
│  └─ js/                        # Scripts do site
│     ├─ alterardados.js
│     ├─ btnsignin.js
│     ├─ btnsignup.js
│     ├─ cadastroHome.js
│     ├─ cadastroSignup.js
│     ├─ configuracoes.js
│     ├─ downloadapk.js
│     ├─ formtext.js
│     ├─ mostrarsenha.js
│     ├─ mostrarsenhaperfil.js
│     ├─ ranking.js
│     ├─ sobre.js
│     ├─ trocacor.js
│     └─ trocaimagem.js
│
├─ database/                  # Estrutura do banco de dados
│  └─ bunco_database.sql
│
├─ pages/                     # Páginas do site
│  ├─ perfil.php
│  ├─ signin.php
│  └─ signup.html
│
├─ php/                       # PHP do site
│  ├─ alterarCor.php
│  ├─ alterarEmail.php
│  ├─ alterarFoto.php
│  ├─ alterarLinks.php
│  ├─ alterarNome.php
│  ├─ alterarSenha.php
│  ├─ alterarUsername.php
│  ├─ cadastrar.php
│  ├─ conexao.php
│  ├─ configsession.php
│  ├─ excluir.php
│  ├─ login.php
│  ├─ logout.php
│  ├─ ofensiva.php
│  ├─ perderVida.php
│  └─ ranking.php
│
└─ index.html                    # Página inicial do site
```

## Autores
- Matheus Cordeiro - site - [Matheus](https://github.com/CordeiroMatheus)
- João Pedro - mobile e APIs - [JpP3dro](https://github.com/JpP3dro)
- Gabriel Linhares - design e prototipação - [Gabriel](https://github.com/Linhares-Gab)
