
# Blogue

Projeto acadêmico com o objetivo de criar uma plataforma funcional que permitisse aos usuários criar, editar, deletar e visualizar posts de blog e seus respectivos comentários.

## Tecnologias Utilizadas
* Yii2: Um poderoso framework PHP que facilita a rápida construção de aplicações web robustas.
* MySQL: Sistema de gerenciamento de banco de dados, usado para armazenar todos os dados de usuários e posts.
* Bootstrap: Framework de front-end para criar interfaces limpas e responsivas.

## Pré-requisitos
Antes de iniciar, instale o seguinte:
* PHP 7.2 ou superior
* Composer - Gerenciador de dependências para PHP

## Instalação do Yii2
Com o Composer instalado, instale o Yii executando o seguinte comando em um diretório acessível pela web:

```
  composer create-project --prefer-dist yiisoft/yii2-app-basic basic
```

## Estrutura da base de dados

A base de dados é composta por duas tabelas principais:

1. **posts**: Armazena os posts do blogue com campos como título, conteúdo, etiquetas e hora de criação.
2. **comments**: Armazena os comentários associados aos posts, com campos como autor, conteúdo e o ID do post a que se refere.

## Configurar a base de dados
Siga estes passos para criar e preencher a base de dados:

### 1. Criar a base de dados

Primeiro, crie um banco de dados vazio para este projeto. Você pode nomeá-la `blogdb`.
````sql
CREATE DATABASE blogdb;

USE blogdb;

-- Estrutura da tabela `comments`
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(150) NOT NULL,
  `content` mediumtext NOT NULL,
  `createtime` datetime NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_PostComment` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dados da tabela `comments`
INSERT INTO `comments` (`id`, `author`, `content`, `createtime`, `post_id`) VALUES
(1, 'Lucas', 'This post is awesome', '2024-10-13 13:28:00', 1),
(2, '', 'Yes it is amazing', '2024-10-13 13:29:00', 1),
(3, '', 'This post has room to improve', '2024-10-13 13:28:00', 2),
(4, '', 'This is the best post ever', '2024-10-13 22:45:00', 1),
(5, '', 'You guys are overeacting', '2024-10-13 22:46:00', 1),
(6, '', 'Yeahh! You are totally overeacting', '2024-10-13 22:49:00', 1);

-- Estrutura da tabela `posts`
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `tags` char(255) DEFAULT NULL,
  `createtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dados da tabela `posts`
INSERT INTO `posts` (`id`, `title`, `content`, `tags`, `createtime`) VALUES
(1, 'Test Post 1', 'This is my first post', 'MYSQL', '2024-10-13 13:27:00'),
(2, 'Test Post 2', 'This is my second post', 'PHP', '2024-10-13 13:27:00'),
(3, 'Test Post 3', 'This is my third post', 'Yii Framework', '2024-10-13 13:27:00');

-- Relação de chave estrangeira
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_PostComment` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);


