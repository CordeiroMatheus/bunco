-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-bunco.alwaysdata.net
-- Generation Time: Sep 03, 2025 at 03:44 PM
-- Server version: 10.11.13-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bunco_database`
--
CREATE DATABASE IF NOT EXISTS `bunco_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bunco_database`;

-- --------------------------------------------------------

--
-- Table structure for table `licoes`
--

CREATE TABLE `licoes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `tipo` enum('teoria','exercicio') NOT NULL,
  `modulo` int(11) DEFAULT NULL,
  `ordem` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `licoes`
--

INSERT INTO `licoes` (`id`, `titulo`, `conteudo`, `tipo`, `modulo`, `ordem`, `created_at`) VALUES
(1, 'Algoritmos e lógica de programação', '1ª tela: Para começar a nossa jornada, a gente precisa entender sobre algoritmos e lógica de programação.\r\n2ª tela: Um algoritmo é uma sequência de passos para resolver um problema ou executar uma tarefa.\r\n3ª tela: Exemplo de algoritmo no dia a dia: Fazer um café Esquente a água.\r\nColoque o pó de café no filtro.\r\nDespeje a água quente no filtro.\r\nAguarde o café coar.\r\nSirva na xícara.\r\n4ª tela: Os algoritmos podem ser usados para resolver problemas simples, como trocar uma lâmpada, ou complexos, como navegar em um GPS.\r\n5ª tela: A programação também é um exemplo de algoritmo! Para fazer um bom código de programação, é preciso entender sobre algoritmo para fazer um código bom e funcional.\r\n6ª tela: Lógica de programação é a capacidade de pensar e organizar passos de forma eficiente. Um algoritmo bem estruturado evita confusão e melhora a solução de problemas!', 'teoria', 1, 1, '2025-08-26 20:51:51'),
(2, 'Exercícios', '1ª tela: Agora é sua vez! Responda as perguntas para praticar o que aprendeu.\r\n2ª tela: Pergunta 1 (Múltipla escolha): O que é um algoritmo?\r\n(A) Um conjunto de imagens.\r\n(B) Uma sequência de passos organizados para resolver um problema.\r\n(C) Um software de computador.\r\n3ª tela: Pergunta 2 (Certo ou Errado):\r\n✅ Um algoritmo sempre precisa ser seguido em uma ordem lógica.\r\n4ª tela: Pergunta 3 (Complete a frase):\r\n\"\"Um algoritmo é um conjunto de _______ organizados para atingir um objetivo.\"\"\r\n5ª tela: Pergunta 4 (Coloque na ordem correta):\r\nArraste as etapas para organizar o algoritmo de fazer um café:\r\n🔹 Despeje a água quente no filtro.\r\n🔹 Sirva na xícara.\r\n🔹 Esquente a água.\r\n🔹 Coloque o pó de café no filtro.\r\n🔹 Aguarde o café coar.\r\n6ª tela: Desafio:\r\nDescreva um algoritmo para escovar os dentes, listando os passos corretamente.', 'exercicio', 1, 2, '2025-08-26 20:51:51'),
(3, 'Como escrever um algoritmo?', '1ª tela: Para criar um algoritmo, siga três passos:\r\nIdentificar o problema Listar os passos necessários Seguir uma ordem lógica\r\n2ª tela: Exemplo: Algoritmo para atravessar a rua com segurança Parar na calçada.\r\nOlhar para os dois lados.\r\nEsperar os carros passarem.\r\nAtravessar na faixa de pedestres.\r\n3ª tela: Nesse exemplo, a lógica de programação foi aplicada:\r\nDecisões: Se há carros vindo, não atravesse.\r\nSequência: Os passos devem estar na ordem certa.\r\nRepetição: Se ainda houver carros, continue esperando.\r\n4ª tela: A lógica de programação ensina a organizar o pensamento para criar soluções eficientes. Ela é essencial para escrever bons algoritmos!', 'teoria', 1, 3, '2025-08-26 20:51:51'),
(4, 'Exercícios', '1ª tela: Agora, vamos ver se você entendeu a aula anterior.\r\n2ª tela: Pergunta 1 (Múltipla escolha): O que um bom algoritmo deve ter?\r\n(A) Passos aleatórios.\r\n(B) ordem lógica e clareza.\r\n(C) Muitas palavras difíceis.\r\n3ª tela: Pergunta 2 (Certo ou Errado):\r\n✅ No algoritmo para atravessar a rua, devemos atravessar primeiro e depois olhar para os lados.\r\n4ª tela: Pergunta 3 (Complete a frase):\r\n\"\"Se houver carros vindo, eu devo ________ antes de atravessar.\"\"\r\n5ª tela: Pergunta 4 (Coloque na ordem correta):\r\nArraste as etapas para organizar o algoritmo de atravessar a rua:\r\n🔹 Olhar para os dois lados.\r\n🔹 Parar na calçada.\r\n🔹 Atravessar na faixa de pedestres.\r\n🔹 Esperar os carros passarem.\r\n6ª tela: Desafio para você fazer na sua casa:\r\nCrie um algoritmo para preparar um sanduíche e organize os passos corretamente.', 'exercicio', 1, 4, '2025-08-26 20:51:52'),
(5, 'Fluxogramas e pseudocódigo', '1ª tela: Existem dois jeitos de representar um algoritmo sem uma linguagem de programação, e nós vamos conhecer agora!\r\n2ª tela: Fluxograma: Os passos do algoritmo são representados em desenho (imagem de um fluxograma)\r\n3ª tela: Cada desenho do fluxograma significa algo, para entender todos, coloque esse link no seu computador: https://www.lucidchart.com/pages/pt/fluxograma- simbologia\r\n4ª tela: Pseudocódigo: O algoritmo é escrito de forma estruturada, parecendo até mesmo um código de programação (imagem de um pseudocódigo)\r\n5ª tela: Existem alguns pseudocódigos que fazem o papel de uma linguagem de programação, como o Visualg e o Portugol, mas a gente vai aprender a programar com o Python.', 'teoria', 1, 5, '2025-08-26 20:51:52'),
(6, 'Exercícios', '1ª tela: Vamos praticar a criação de algoritmos com fluxogramas e pseudocódigos!\r\n2ª tela: Pergunta 1 (Múltipla escolha): O que é um pseudocódigo?\r\n(A) Uma linguagem de programação difícil.\r\n(B) Um jeito simples de escrever algoritmos antes de programar.\r\n(C) Um código usado só por especialistas.\r\n3ª tela: Pergunta 2 (Certo ou Errado):\r\nUm fluxograma é representado apenas por números e símbolos matemáticos.\r\n4ª tela: Pergunta 3 (Complete a frase):\r\n\"\"O pseudocódigo ajuda a planejar um algoritmo antes de ________.\"\"\r\n5ª tela: Pergunta 4 (Coloque na ordem correta):\r\nArraste as etapas para organizar o pseudocódigo de tomar água:\r\n🔹 Beba a água.\r\n🔹 Abra a torneira.\r\n🔹 Pegue um copo.\r\n🔹 Encha o copo de água.\r\n6ª tela: Desafio:\r\nEscolha uma atividade simples, como amarrar um tênis.\r\nEscreva um pseudocódigo para essa atividade.\r\nSe quiser, desenhe um fluxograma para representar seu algoritmo.', 'exercicio', 1, 6, '2025-08-26 20:51:52'),
(7, 'tipos de dados', '1ª tela: Agora podemos começar a entrar no mundo do Python! E vamos primeiro entender sobre os tipos de dados.\r\n2ª tela: Os tipos de dados são as classificações das informações e variáveis que usamos no nosso código. No Python, os principais tipos são:\r\n3ª tela: Int: São os números inteiros (ex: 10, -3, 45) numero = -3\r\n4ª tela: Float: São os números decimais (ex: 3.14, 2.5, -4.1) numero = 2.14\r\n5ª tela: Str (ou String): São as palavras e textos (ex: “Olá, Mundo”) texto = “Olá” *Obs: Os textos e palavras precisam estar entre aspas!\r\n6ª tela: Bool (ou Boolean): Verdadeiro ou Falso (True, False) variavel = True\r\n7ª tela: Cada tipo de dado tem um propósito e precisa ser usado corretamente para evitar erros no código!\r\n8ª tela: Diferente de outras linguagens de programação, no Python, não é preciso “declarar” o tipo de dado antes da variável (imagem de um exemplo em Python) (imagem de um exemplo de Java).\r\n9ª tela: Para descobrir o tipo da variável, podemos usar uma função chamada type() print(type(10)) # int print(type(3.14)) # float print(type(\"\"Oi\"\")) # str print(type(True)) # bool', 'teoria', 2, 1, '2025-08-26 20:51:52'),
(8, 'Exercícios', '1ª tela: Agora é sua vez! Responda as perguntas para praticar.\r\n2ª tela: Pergunta 1 (Múltipla escolha): Qual desses é um número inteiro (int)?\r\n(A) 3.5 (B) 10 (C) \"\"Python\"\"\r\n3ª tela: Pergunta 2 (Certo ou Errado): O tipo bool pode armazenar números.\r\n4ª tela: Pergunta 3 (Complete a frase):\r\n\"\"O tipo de dado que usamos para armazenar palavras e frases em Python é chamado de ________.\"\"\r\n5ª tela: Pergunta 4 (Qual é o tipo?):\r\nQue tipo de dado será mostrado ao rodar o código abaixo?\r\nprint(type(4.75)) (A) int (B) float (C) str\r\n6ª tela: Desafio: Escreva três exemplos de valores para cada tipo de dado: int, float, str e bool.', 'exercicio', 2, 2, '2025-08-26 20:51:52'),
(9, 'Conversão de dados', '', 'teoria', 2, 3, '2025-08-26 20:51:52'),
(10, 'Em Python, podemos converter um tipo de dado para outro usando', 'funções de conversão.', 'teoria', 2, 1, '2025-08-26 20:51:52'),
(11, 'Principais funções de conversão:', '🔹 int() → Converte para número inteiro 🔹 float() → Converte para número decimal 🔹 str() → Converte para texto 🔹 bool() → Converte para verdadeiro ou falso', 'teoria', 2, 2, '2025-08-26 20:51:52'),
(12, 'Alguns exemplos de conversão:', 'x = int(3.9) # x será 3 y = float(10) # y será 10.0 z = str(25) # z será \"\"25\"\" w = bool(0) # w será False', 'teoria', 2, 3, '2025-08-26 20:51:52'),
(13, 'Mas atenção! Em alguns casos, não é possível converter dados! Por', 'exemplo, tentar converter um texto para número irá causar um erro!', 'teoria', 2, 4, '2025-08-26 20:51:52'),
(14, 'Exercícios', '1ª tela: Agora, vamos testar sua lógica! 💡\r\n2ª tela: Pergunta 1 (Múltipla escolha): Qual dessas funções converte um número decimal em inteiro?\r\n(A) str() (B) int() (C) float()\r\n3ª tela: Pergunta 2 (Certo ou Errado):\r\n✅ A conversão int(1.8) vai causar um erro.\r\n4ª tela: Pergunta 3 (Complete a frase):\r\n\"\"A função float() converte um número inteiro para um número _______.\"\"\r\n5ª tela: Pergunta 4 (O que acontece?):\r\nO que acontece ao rodar este código?\r\nprint(int(7.8)) (A) 7.8 (B) 7 (C) 8\r\n6ª tela: Desafio:\r\nTente converter os seguintes valores e veja os resultados:', 'exercicio', 2, 4, '2025-08-26 20:51:52'),
(15, 'Desafio', '1ª tela: Agora é hora do desafio! Resolva os exercícios no seu computador.\r\n2ª tela: Desafio 1 Crie três variáveis:\r\nUma para armazenar um número inteiro.\r\nUma para armazenar um número decimal.\r\nUma para armazenar um texto.\r\nDepois, use print() para exibir os valores e seus respectivos tipos de dados.\r\n3ª tela: Desafio 2 Crie um código que armazene uma variavel inteira.\r\n4ª tela: Desafio 3 Escreva um código que exiba dois números..\r\n5ª tela: Desafio 4 Crie um código que armazene um valor booleano (True ou False) e exiba esse valor na tela.\r\n6ª tela: Desafio 5 Crie um código que converta um número decimal para um número inteiro antes de exibi-lo na tela.', 'exercicio', 2, 5, '2025-08-26 20:51:52'),
(16, 'Exibindo mensagens com print()', '1ª tela: Nessa parte, vamos entender mais a função print(). Vamos nessa!\r\n2ª tela: A função print() serve para mostrar mensagens na tela.\r\n3ª tela: print(\"\"Olá, mundo!\"\") o que está dentro do parênteses será exibido na tela\r\n4ª tela: O print() pode mostrar diversos tipos de dados print(10) # Número inteiro print(3.14) # Número decimal print(True) # Valor booleano print(\"\"Python\"\") # Texto (string)\r\n5ª tela: Podemos exibir vários valores ao mesmo tempo, separados por vírgula:\r\nprint(\"\"O resultado é:\"\", 10 + 5)', 'teoria', 3, 1, '2025-08-26 20:51:52'),
(17, 'Exercícios', '1ª tela: Agora é a sua vez! Responda as perguntas para praticar\r\n2ªtela: Pergunta 1 (Múltipla escolha): Qual comando exibe a mensagem \"\"Aprendendo Python!\"\" na tela?\r\n(A) echo(\"\"Aprendendo Python!\"\") (B) print(\"\"Aprendendo Python!\"\") (C) console.log(\"\"Aprendendo Python!\"\")\r\n3ª tela: Pergunta 2(Como fazer?): Como exibir a mensagem “Olá, Mundo!” na tela?\r\n4ª tela: Pergunta 3 (Qual será a saída?):\r\nO que será exibido ao rodar este código?\r\nprint(\"\"Soma:\"\", 5 + 3) (A) Soma: 5 + 3 (B) Soma: 8 (C) 8\r\n5ª tela: Desafio: Escreva um código Python que exiba seu nome e idade na tela usando print()', 'exercicio', 3, 2, '2025-08-26 20:51:52'),
(18, 'Recebendo informações com input()', '1ª tela: Agora vamos aprender a usar a função input()\r\n2ª tela: A função input() permite que o usuário digite informações.\r\n3ª tela: nome = input(\"\"Qual é o seu nome? \"\") print(\"\"Olá,\"\", nome) O que o usuário digitar será armazenado na variável\r\n4ª tela: IMPORTANTE! O input() sempre retorna um texto (string) mesmo se o usuário digitar números.\r\n5ª tela: Para o usuário poder digitar um número do tipo int ou float, é preciso fazer a conversão idade = int(input(\"\"Digite sua idade: \"\"))', 'teoria', 3, 3, '2025-08-26 20:51:52'),
(19, 'Exercícios', '1ª tela: Vamos testar o seu raciocínio!\r\n2ª tela: Pergunta 1 (Múltipla escolha): Qual função recebe dados digitados pelo usuário?\r\n(A) print() (B) input() (C) scan()\r\n3ª tela: Pergunta 2 (Verdadeiro ou Falso): O comando idade = input(\"\"Digite sua idade: \"\") guarda a idade como um número inteiro.\r\n4ª tela: Pergunta 3 (Qual será a saída?): O que será exibido se o usuário digitar \"\"Ana\"\" no código abaixo?\r\nnome = input(\"\"Digite seu nome: \"\") print(\"\"Bem-vindo,\"\", nome)\r\n5ª tela: Desafio: Crie um programa que peça ao usuário seu nome e sua comida favorita, depois exiba a mensagem:\r\n\"\"Olá, [nome]! Eu também gosto de [comida]!\"\"', 'exercicio', 3, 4, '2025-08-26 20:51:52'),
(20, 'Melhorando a exibição', '1ª tela: Podemos personalizar a exibição usando algumas técnicas!\r\n2ª tela: É possível juntar strings com + nome = \"\"Lucas\"\" print(\"\"Olá, \"\" + nome + \"\"!\"\") Importante: só funciona com strings!\r\n3ª tela: F-Strings: Existe a possibilidade de colocar as variáveis dentro das aspas, sem precisar de vírgula ou + idade = 25 print(f\"\"Você tem {idade} anos.\"\")\r\n4ª tela: Para quebrar a linha dentro do print(), use o comando print(\"\"Linha 1 Linha 2\"\") # quebra a linha\r\n5ª tela: Para adicionar uma tabulação, use o comando print(\"\"Nome:	Ana\"\") # 	 adiciona um tab', 'teoria', 3, 5, '2025-08-26 20:51:52'),
(21, 'Exercícios', '1ª tela: Agora é a hora de testar o seu conhecimento!\r\n2ª tela: Pergunta 1 (Múltipla escolha): Qual dessas opções usa f-strings corretamente?\r\n(A) print(f\"\"Olá {nome}\"\") (B) print(f(\"\"Olá {nome}\"\")) (C) print(f\"Olá\" nome)\r\n3ª tela: Pergunta 2 (Certo ou Errado): O comando print(\"\"Meu nome é\"\", nome) funciona sem erro.\r\n4ª tela: Pergunta 3 (Qual será a saída?):\r\nO que será impresso?\r\nprint(\"\"Laranja Banana\"\")\r\n5ª tela: Desafio: Crie um programa que peça o nome e a cidade do usuário e exiba a mensagem:\r\nOlá, [nome]! Como está o tempo em [cidade] hoje?', 'exercicio', 3, 6, '2025-08-26 20:51:52'),
(22, 'Desafio', '1ª tela: Agora é hora do desafio! Resolva os exercícios no seu computador.\r\n2ª tela: Desafio 1 Crie um programa que peça o nome do usuário e exiba uma mensagem de boas- vindas com esse nome.\r\n3ª tela: Desafio 2 Peça ao usuário para digitar dois números e exiba eles em sequência.\r\n4ª tela: Desafio 3 Crie um programa que peça ao usuário seu nome e idade e exiba uma mensagem formatada como:\r\n\"\"Olá, [nome]! Você tem [idade] anos.\"\"\r\n5ª tela: Desafio 4 Peça ao usuário para digitar seu dia, mês e ano de nascimento e exiba a seguinte mensagem:\r\n\"\"Você nasceu no dia [dia] do mês [mês] do ano [ano]!\"\"\r\n6ª tela: Desafio 5 Crie um código que peça ao usuário seu nome e uma saudação (exemplo: \"\"Bom dia\"\") e exiba a mensagem no formato:\r\n\"\"Bom dia, [nome]!\"\"', 'exercicio', 3, 7, '2025-08-26 20:51:52'),
(23, 'Operadores aritméticos', '1ª tela: Agora vamos aprender sobre operadores aritméticos!\r\n2ª tela: Os operadores aritméticos são usados para fazer cálculos matemáticos.\r\nAlguns deles são:\r\n3ª tela: Soma (+), Subtração (-), Multiplicação (*), Divisão (/) (imagem de exemplo)\r\n4ª tela: Divisão inteira (//): É o resultado da divisão com o resto, sem ir para a parte decimal. Por exemplo, 5 // 3 seria igual a 1.\r\n5ª tela: Resto da divisão (%): É o resto da divisão entre dois números. Por exemplo, 5 % 3 seria igual a 2.\r\n6ª tela: Exponenciação (**): É basicamente elevar um número a outro. Por exemplo, 2 ** 3 vai resultar em 8.\r\n7ª tela: a = 10 b = 3 print(a + b) # Soma print(a - b) # Subtração print(a * b) # Multiplicação print(a / b) # Divisão normal print(a // b) # Divisão inteira print(a % b) # Resto da divisão print(a ** b) # Exponenciação\r\n8ª tela: Assim como na matemática, existe uma ordem para resolver as operações:\r\n1. Parênteses () 2. Exponenciação ** 3. Multiplicação *, Divisão /, Divisão inteira // e Módulo % 4. Soma + e Subtração – Critério de desempate: Da esquerda para a direita.', 'teoria', 4, 1, '2025-08-26 20:51:52'),
(24, 'Exercícios', '1ª tela: Agora é sua vez! 💡 Resolva os exercícios para praticar.\r\n2ª tela: Pergunta 1 (Múltipla escolha):\r\nQual operador usamos para calcular a potência de um número?\r\n(A) ^ (B) ** (C) //\r\n3ª tela: Pergunta 2 (Certo ou Errado):\r\nO operador % retorna o resto da divisão entre dois números.\r\n4ª tela: Pergunta 3 (Complete a frase):\r\n\"\"print(“Soma:”, 3 ____ 4)\r\n5ª tela: Pergunta 4 (Qual será a saída?):\r\nO que será impresso?\r\nprint(2 + 3 * 4) (A) 20 (B) 14 (C) 24\r\n6ª tela: Desafio:\r\nEscreva um código que peça dois números ao usuário e exiba:\r\n* A soma * A subtração * O produto * O quociente (divisão)', 'exercicio', 4, 2, '2025-08-26 20:51:52'),
(25, 'Operadores relacionais', '1ª tela: Agora vamos aprender sobre operadores relacionais!\r\n2ª tela: Os operadores relacionais são usados para comparar valores.\r\n3ª tela: Os operadores relacionais são:\r\n* Igual a: == * Diferente de: != * Maior que: > * Menor que: < * Maior ou igual a: >= * Menor ou igual a: <=\r\n4ª tela: a = 10 b = 5 print(a > b) # True (10 é maior que 5) print(a < b) # False (10 não é menor que 5) print(a == b) # False (10 não é igual a 5) print(a != b) # True (10 é diferente de 5)\r\n5ª tela: Cuidado! Para comparar valores, usamos == e não apenas = a = 5 # Atribuição print(a == 5) # Comparação (True)', 'teoria', 4, 3, '2025-08-26 20:51:52'),
(26, 'Exercícios', '1ª tela: Agora vamos praticar as comparações!\r\n2ª tela: Pergunta 1 (Múltipla escolha):\r\nQual desses operadores significa \"\"diferente de\"\"?\r\n(A) != (B) == (C) <\r\n3ª tela: Pergunta 2 (Certo ou Errado):\r\nO operador > verifica se um número é menor que outro.\r\n4ª tela: Pergunta 3 (Complete o código):\r\n\"\"print(20 ___ 10) #True”\r\n5ª tela: Pergunta 4 (Qual será a saída?):\r\nprint(10 <= 20) (A) True (B) False\r\n6ª tela: Desafio: Crie um código que peça dois números para o usuário e imprima True se for maior ou igual e False caso não seja.', 'exercicio', 4, 4, '2025-08-26 20:51:52'),
(27, 'Operadores lógicos', '1ª tela: Vamos ver o último tipo de operadores: os operadores lógicos!\r\n2ª tela: Os operadores lógicos são usados para combinar condições. Esses operadores são:\r\n3ª tela: And (E): “cond1 and cond2” Vai retornar True APENAS se as duas condições forem verdadeiras pode_dirigir = idade >= 18', 'teoria', 4, 5, '2025-08-26 20:51:52'),
(28, 'Exercícios', 'Verdadeiro (True) se ambas as condições forem verdadeiras?\r\n(A) and\r\n(B) or\r\n(C) not\r\nO operador not inverte um valor lógico.\r\n\"\"print(5 > 3 \\_\\_\\_ 2 < 1) #True\"\"\r\nprint(True and False)\r\n(A) True\r\n(B) False\r\ne por 3 e retorne algo para o usuário. (Dica: use o operador %).', 'exercicio', 4, 6, '2025-08-26 20:53:01'),
(29, 'Desafio', 'computador.\r\nPeça ao usuário dois números e exiba a soma, subtração, multiplicação e\r\ndivisão entre eles.\r\nCrie um código que peça dois números ao usuário e exiba o resultado de\r\num número elevado ao outro.\r\nPeça ao usuário para digitar um número e exiba o dobro e o triplo desse\r\nnúmero.\r\nCrie um código que peça dois números ao usuário e mostre o resultado da\r\ndivisão inteira entre eles.\r\nCrie um código que peça dois números ao usuário e exiba se o primeiro é\r\nmaior que o segundo.', 'exercicio', 4, 7, '2025-08-26 20:53:56'),
(30, 'If/Elif/Else', 'condições. Um exemplo é o if/else\r\nO else define o que acontece se a condição for falsa.\r\nif idade >= 18:\r\nprint(\"\"Você é maior de idade.\"\")\r\nelse:\r\nprint(\"\"Você é menor de idade.\"\")\r\nSe a idade for maior ou igual a 18, o programa imprime \"\"Você é maior de\r\nidade\"\". Senão, imprime \"\"Você é menor de idade\"\".\r\nEle permite testar mais condições antes do else.\r\nif nota >= 7:\r\nprint(\"\"Aprovado!\"\")\r\nelif nota >= 5:\r\nprint(\"\"Recuperação!\"\")\r\nelse:\r\nprint(\"\"Reprovado.\"\")\r\nelif significa \"\"senão se\"\". Ele permite testar mais condições antes do\r\nelse.\r\nfalso, o código segue normalmente\r\nvalor = 2000\r\nquantidade = 5\r\nif quantidade > 5:\r\ndesconto = 10/100 #10%', 'teoria', 5, 1, '2025-08-26 20:54:25'),
(31, 'Exercícios', 'O que acontece se a condição do if for falsa e não houver um else?\r\n(A) O programa exibe um erro.\r\n(B) O código dentro do if é ignorado e o programa continua.\r\n(C) O Python escolhe outro bloco para executar.\r\nO elif permite testar várias condições antes de chegar no else.\r\nOrdene o código corretamente para verificar se uma pessoa pode dirigir.\r\n-   print(\"\"Pode dirigir!\"\")\r\n-   if idade >= 18:\r\n-   idade = int(input(\"\"Digite sua idade: \"\"))\r\nnota = 6\r\nif nota >= 7:\r\nprint(\"\"Aprovado\"\")\r\nelif nota >= 5:\r\nprint(\"\"Recuperação\"\")\r\nelse:\r\nprint(\"\"Reprovado\"\")\r\n(A) Aprovado\r\n(B) Recuperação\r\n(C) Reprovado\r\nfuncionário e calcule um aumento:\r\nSe o salário for menor que R$ 2000, o aumento é de 10%.\r\nSenão, o aumento é de 5%.', 'exercicio', 5, 2, '2025-08-26 20:54:25'),
(32, 'Estrutura Match Case', 'verifica várias opções e executa a que corresponder.\r\nmatch comando:\r\ncase \"\"start\"\":\r\nprint(\"\"Iniciando o programa...\"\")\r\ncase \"\"stop\"\":\r\nprint(\"\"Parando o programa...\"\")\r\ncase \\_:\r\nprint(\"\"Comando inválido!\"\")\r\nO case \"\"\\_\"\" funciona como o else, pegando qualquer valor não listado.\r\ndia = input(\"\"Digite um dia da semana: \"\")\r\nmatch dia:\r\ncase \"\"sábado\"\" | \"\"domingo\"\":\r\nprint(\"\"É fim de semana!\"\")\r\ncase \\_:\r\nprint(\"\"É um dia útil.\"\")\r\nSe o usuário digitar \"\"sábado\"\" ou \"\"domingo\"\", o programa reconhece\r\ncomo fim de semana.', 'teoria', 5, 3, '2025-08-26 20:54:25'),
(33, 'Exercícios', 'Qual é a função do \\_ no match case?\r\n(A) Ele é executada quando nenhum dos outros case acontece.\r\n(B) Ele compara apenas números.\r\n(C) Ele encerra o programa.\r\nNo match case, podemos usar | para testar múltiplos valores no mesmo\r\ncaso.\r\nOrdene o código corretamente para exibir mensagens com base na cor\r\ndigitada pelo usuário.\r\nprint(\"\"Cor não reconhecida\"\")\r\ncase \"\"vermelho\"\": print(\"\"Cor quente!\"\")\r\nmatch cor:\r\ncor = input(\"\"Digite uma cor: \"\")\r\ncase \\_: print(\"\"Cor não reconhecida\"\")\r\ncomando = \"\"play\"\"\r\nmatch comando:\r\ncase \"\"pause\"\":\r\nprint(\"\"Pausando...\"\")\r\ncase \"\"stop\"\":\r\nprint(\"\"Parando...\"\")\r\ncase \\_:\r\nprint(\"\"Comando desconhecido\"\")\r\n(A) Pausando...\r\n(B) Parando...\r\n(C) Comando desconhecido\r\na estação correspondente:\r\n\"\"junho\"\", \"\"julho\"\", \"\"agosto\"\" → Inverno\r\n\"\"setembro\"\", \"\"outubro\"\", \"\"novembro\"\" → Primavera\r\n\"\"dezembro\"\", \"\"janeiro\"\", \"\"fevereiro\"\" → Verão\r\n\"\"março\"\", \"\"abril\"\", \"\"maio\"\" → Outono', 'exercicio', 5, 4, '2025-08-26 20:54:25'),
(34, 'Desafio', 'computador.\r\nPeça ao usuário para digitar um número e exiba se ele é positivo,\r\nnegativo ou zero.\r\nCrie um código que peça a idade do usuário e exiba se ele é maior ou\r\nmenor de idade.\r\nPeça ao usuário para digitar um número, verifique se ele é par ou ímpar\r\ne exiba uma mensagem personalizada.\r\nCrie um programa que pergunte ao usuário em qual turno ele estuda (\"\"M\"\"\r\npara manhã, \"\"T\"\" para tarde e \"\"N\"\" para noite) e exiba uma mensagem\r\npersonalizada para cada opção.\r\nUse match case para criar um programa que peça ao usuário para digitar\r\num dia da semana e exiba uma mensagem dizendo se é um dia útil ou final\r\nde semana.\r\n**WHILE**', 'exercicio', 5, 5, '2025-08-26 20:54:25'),
(35, 'Introdução ao While', 'enquanto uma condição for verdadeira.\r\nbloco de código deve ser repetido.\r\nwhile contador <= 5:\r\nprint(f\"\"Repetição {contador}\"\")\r\ncontador += 1\r\nO loop vai imprimir os números de 1 a 5.\r\nfor falsa, o loop rodará para sempre!\r\nprint(\"\"Isso nunca para!\"\")\r\nPara evitar isso, sempre tenha uma condição que possa ser falsa em algum\r\nmomento.', 'teoria', 6, 1, '2025-08-26 20:56:52'),
(36, 'Exercícios', 'Qual é a principal função do loop while?\r\n(A) Executar código apenas uma vez.\r\n(B) Repetir código enquanto uma condição for verdadeira.\r\n(C) Comparar valores numéricos.\r\nSe a condição do while nunca for falsa, o código pode entrar em um loop\r\ninfinito.\r\nComplete o código para que o while pare quando x for maior que 3.\r\nx = 0\r\nwhile \\_\\_\\_\\_\\_\\_\\_\\_\\_\\_:\r\nprint(x)\r\nx += 1\r\nnum = 1\r\nwhile num < 4:\r\nprint(num)\r\nnum += 1\r\n(A) 1 2 3\r\n(B) 1 2 3 4\r\n(C) 1 1 1 1\r\ncontinue pedindo até que ele digite um número maior que 10.', 'exercicio', 6, 2, '2025-08-26 20:56:52'),
(37, 'Usando break e continue', 'while\r\nimediatamente, independente da condição ser verdadeira ou falsa.\r\nresposta = input(\"\"Digite sair para parar: \"\")\r\nif resposta == \"\"sair\"\":\r\nbreak\r\nO código só para quando o usuário digita \"\"sair\"\".\r\nloop.\r\nwhile numero < 5:\r\nnumero += 1\r\nif numero == 3:\r\ncontinue\r\nprint(numero)\r\nEsse código imprime 1, 2, 4 e 5, mas pula o 3.', 'teoria', 6, 3, '2025-08-26 20:56:52'),
(38, 'Exercícios', 'O que o break faz em um loop?\r\n(A) Interrompe o loop imediatamente.\r\n(B) Faz o loop repetir para sempre.\r\n(C) Pula a próxima repetição do loop.\r\nO continue faz o loop ignorar o restante do código e começar a próxima\r\nrepetição.\r\nComplete o código para que ele pare quando x for igual a 3.\r\nx = 0\r\nwhile x < 5:\r\nx += 1\r\nif x == 3:\r\n\\_\\_\\_\\_\\_\\_\\_\\_\\_\\_\r\nx = 0\r\nwhile x < 4:\r\nx += 1\r\nif x == 2:\r\ncontinue\r\nprint(x)\r\n(A) 1 2 3 4\r\n(B) 1 3 4\r\n(C) 2 3 4\r\ntodos eles. O programa deve parar quando o usuário digitar 0.', 'exercicio', 6, 4, '2025-08-26 20:56:52'),
(39, 'Desafio', 'computador.\r\nCrie um programa que exiba os números de 1 a 10 usando um loop while.\r\nPeça ao usuário para digitar um número e exiba a contagem regressiva\r\ndesse número até 0 usando while.\r\nCrie um código que peça ao usuário para digitar números até que ele\r\ndigite o número 0. Quando isso acontecer, o programa deve parar.\r\nPeça ao usuário para digitar um número e exiba a soma de todos os\r\nnúmeros de 1 até esse número usando while.\r\nCrie um código que peça a senha ao usuário e continue pedindo até que\r\nele digite a senha correta.', 'exercicio', 6, 5, '2025-08-26 20:56:52'),
(40, 'Introdução ao For', 'percorrer elementos de uma sequência, como listas e strings.\r\nde uma sequência.\r\nfor i in range(5):\r\nprint(f\"\"Repetição {i}\"\")\r\nEsse código imprime os números de 0 a 4.\r\nfrutas = [\"\"maçã\"\", \"\"banana\"\", \"\"uva\"\"]\r\nfor fruta in frutas:\r\nprint(fruta)\r\nCada item da lista é acessado automaticamente pelo for.', 'teoria', 7, 1, '2025-08-26 20:57:45'),
(41, 'Exercícios', '(A) Repete um bloco de código um número fixo de vezes.\r\n(B) Executa código apenas uma vez.\r\n(C) Interrompe a execução do programa.\r\nO for pode ser usado para percorrer listas e strings.\r\nComplete o código para percorrer a lista de números e imprimir cada um.\r\nnumeros = [1, 2, 3, 4]\r\nfor num in \\_\\_\\_\\_\\_\\_\\_\\_\\_\\_:\r\nprint(num)\r\nfor letra in \"\"Python\"\":\r\nprint(letra)\r\n(A) Python\r\n(B) P y t h o n\r\n(C) Erro\r\nexiba apenas os pares.', 'exercicio', 7, 2, '2025-08-26 20:57:45'),
(42, 'Usando Range e Enumerate', 'trabalhar com for.\r\nautomaticamente.\r\nfor i in range(1, 6):\r\nprint(i)\r\nEsse código imprime os números de 1 a 5.\r\nO enumerate() retorna o índice e o valor de uma lista.\r\nnomes = [\"\"Ana\"\", \"\"Bruno\"\", \"\"Carlos\"\"]\r\nfor indice, nome in enumerate(nomes):\r\nprint(indice, nome)\r\nEle exibe a posição e o valor de cada item.', 'teoria', 7, 3, '2025-08-26 20:57:45'),
(43, 'Exercícios', 'O que range(5) faz?\r\n(A) Cria uma lista com os números de 1 a 5.\r\n(B) Gera os números de 0 a 4.\r\n(C) Não faz nada.\r\nO enumerate() pode ser usado para acessar o índice e o valor ao mesmo\r\ntempo.\r\nComplete o código para imprimir os índices e valores da lista.\r\nnomes = [\"\"Alice\"\", \"\"Bob\"\", \"\"Carol\"\"]\r\nfor \\_\\_\\_\\_\\_\\_\\_\\_\\_\\_ in enumerate(nomes):\r\nprint(i, nome)\r\nfor i in range(3):\r\nprint(i)\r\n(A) 0 1 2\r\n(B) 1 2 3\r\n(C) 0 1 2 3\r\nmúltiplos de 3 de 1 a 20.', 'exercicio', 7, 4, '2025-08-26 20:57:45'),
(44, 'Desafio', 'computador.\r\nCrie um código que exiba os números de 1 a 20 usando um loop for.\r\nPeça ao usuário um número e exiba a tabuada desse número de 1 a 10\r\nusando for.\r\nCrie um código que exiba todos os números pares de 1 a 50 usando for.\r\nPeça ao usuário para digitar uma palavra e exiba cada letra da palavra\r\nseparadamente usando for.\r\nCrie um código que peça ao usuário para digitar 5 números e, no final,\r\nexiba a soma de todos eles.', 'exercicio', 7, 5, '2025-08-26 20:57:45'),
(45, 'Introdução às Arrays', 'variável.\r\nvalores organizados em uma sequência.\r\nfrutas = [\"\"maçã\"\", \"\"banana\"\", \"\"uva\"\"]\r\nprint(frutas)\r\nEsse código cria uma lista e exibe os valores.\r\ncomeçando do 0. Ou seja, para acessar o primeiro item, nós usamos o 0,\r\npara acessar o segundo item, nós usamos o item 1 e assim por diante.\r\nprint(frutas[0]) # \"\"maçã\"\"\r\nIsso exibe o primeiro item da lista.', 'teoria', 8, 1, '2025-08-26 20:58:31'),
(46, 'Exercícios', 'Como acessar o terceiro item da lista numeros = [10, 20, 30, 40]?\r\n(A) numeros[2]\r\n(B) numeros[3]\r\n(C) numeros[1]\r\nEm Python, os índices das listas começam no número 1.\r\nComplete o código para exibir \"\"banana\"\".\r\nfrutas = [\"\"maçã\"\", \"\"banana\"\", \"\"uva\"\"]\r\nprint(\\_\\_\\_\\_\\_\\_\\_\\_\\_\\_)\r\nnumeros = [5, 10, 15]\r\nprint(numeros[1])\r\n(A) 5\r\n(B) 10\r\n(C) 15\r\nCrie uma lista com os nomes de 3 amigos e exiba o nome do segundo amigo.', 'exercicio', 8, 2, '2025-08-26 20:58:31'),
(47, 'Modificando Listas', 'adicionar e remover itens.\r\nseu índice.\r\nfrutas = [\"\"maçã\"\", \"\"banana\"\", \"\"uva\"\"]\r\nfrutas[1] = \"\"laranja\"\"\r\nprint(frutas)\r\nIsso substitui \"\"banana\"\" por \"\"laranja\"\".\r\nfinal da lista.\r\nfrutas.append(\"\"manga\"\")\r\nprint(frutas)\r\nespecífico da lista.\r\nfrutas.remove(\"\"uva\"\")\r\nprint(frutas)', 'teoria', 8, 3, '2025-08-26 20:58:31'),
(48, 'Exercícios', 'final da lista?\r\n(A) insert()\r\n(B) append()\r\n(C) pop()\r\nO remove() pode excluir um item da lista pelo seu valor.\r\nComplete o código para adicionar \"\"pera\"\" à lista.\r\nfrutas = [\"\"maçã\"\", \"\"banana\"\"]\r\nfrutas.\\_\\_\\_\\_\\_\\_\\_\\_\\_\\_(\"\"pera\"\")\r\nnumeros = [1, 2, 3]\r\nnumeros.remove(2)\r\nprint(numeros)\r\n(A) [1, 2, 3]\r\n(B) [1, 3]\r\n(C) [2, 3]\r\nCrie uma lista com os números de 1 a 5 e remova o número 3.', 'exercicio', 8, 4, '2025-08-26 20:58:31'),
(49, 'Desafio', 'computador.\r\nCrie uma lista com 5 números e exiba cada um deles na tela usando um\r\nloop for.\r\nPeça ao usuário para digitar 3 nomes e armazene-os em uma lista. Depois,\r\nexiba todos os nomes digitados.\r\nCrie um código que peça ao usuário para digitar números até que ele\r\ndigite 0. Armazene os números em uma lista e depois exiba todos eles.\r\nCrie uma lista com 10 números e exiba apenas os números pares contidos\r\nnela.\r\nPeça ao usuário para digitar 5 números e armazene-os em uma lista.\r\nDepois, exiba o maior e o menor número da lista.', 'exercicio', 8, 5, '2025-08-26 20:58:31'),
(50, 'Introdução às Bibliotecas', 'prontos que facilitam a programação.\r\nmódulos prontos para uso.\r\nimport math\r\nIsso importa a biblioteca math, que tem funções matemáticas.\r\nimport math\r\nresultado = math.sqrt(25)\r\nprint(resultado) # 5.0\r\nresultado2 = math.pow(3, 2)\r\nprint(resultado2) #9\r\nA função sqrt() calcula a raiz quadrada e a função pow() calcula um\r\nnúmero elevado ao outro.', 'teoria', 9, 1, '2025-08-26 20:58:59'),
(51, 'Exercícios', 'Python?\r\n(A) Um programa completo.\r\n(B) Um conjunto de códigos prontos para uso.\r\n(C) Um erro no código.\r\nPara usar uma biblioteca, é necessário importá-la primeiro.\r\nComplete o código para importar a biblioteca random.\r\n\\_\\_\\_\\_\\_\\_\\_\\_ random\r\nimport math\r\nprint(math.pow(2, 3))\r\n(A) 8\r\n(B) 6\r\n(C) 2³\r\ncalcular a raiz quadrada de um número digitado pelo usuário.', 'exercicio', 9, 2, '2025-08-26 20:58:59'),
(52, 'Bibliotecas Úteis', 'import random\r\nnumero = random.randint(1, 10)\r\nprint(numero)\r\nIsso gera um número aleatório entre 1 e 10.\r\nimport datetime\r\nhoje = datetime.date.today()\r\nprint(hoje)\r\nIsso exibe a data atual.\r\nimport os\r\nprint(os.name) # Mostra o nome do sistema', 'teoria', 9, 3, '2025-08-26 20:58:59'),
(53, 'Exercícios', 'O que a biblioteca random faz?\r\n(A) Trabalha com números aleatórios.\r\n(B) Exibe a data atual.\r\n(C) Gerencia arquivos do sistema.\r\nA biblioteca datetime pode ser usada para obter a data atual.\r\nComplete o código para gerar um número aleatório de 1 a 100.\r\nimport random\r\nnumero = random.\\_\\_\\_\\_\\_\\_\\_\\_(1, 100)\r\nprint(numero)\r\nimport datetime\r\nprint(datetime.date.today())\r\n(A) A data atual.\r\n(B) Um número aleatório.\r\n(C) Um erro.\r\nCrie um código que utilize a biblioteca datetime para exibir o ano\r\natual.', 'exercicio', 9, 4, '2025-08-26 20:58:59'),
(54, 'Desafio', 'computador.\r\nUtilize a biblioteca math para calcular e exibir a raiz quadrada de um\r\nnúmero digitado pelo usuário.\r\nUse a biblioteca random para gerar e exibir um número aleatório entre 1\r\ne 100.\r\nPeça ao usuário para digitar um número e utilize a biblioteca math para\r\ncalcular e exibir o fatorial desse número.\r\nUse a biblioteca datetime para exibir a data e a hora atuais.\r\nCrie um código que sorteie um nome aleatório de uma lista de 5 nomes\r\nusando a biblioteca random.', 'exercicio', 9, 5, '2025-08-26 20:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modulos`
--

INSERT INTO `modulos` (`id`, `titulo`, `descricao`) VALUES
(1, 'Algoritmos', 'Introdução ao raciocínio lógico por trás da programação. Você aprende a criar sequências de passos bem definidos para resolver problemas.'),
(2, 'Tipos de dados', 'Explicação sobre os diferentes tipos de informações que o Python pode manipular, como números inteiros, decimais, textos e valores lógicos.'),
(3, 'Print e input', 'Como mostrar mensagens na tela com o print() e como receber informações do usuário com o input().'),
(4, 'Operadores', 'Estudo dos operadores aritméticos, relacionais e lógicos em Python, essenciais para realizar cálculos, comparações e tomadas de decisão.'),
(5, 'Estruturas de seleção', 'Como criar condições nos programas: executar certos blocos de código apenas quando critérios forem atendidos, usando if/else e match case.'),
(6, 'While', 'Introdução ao laço de repetição que executa um bloco de código enquanto uma condição for verdadeira.'),
(7, 'For', 'Exploração do laço de repetição usado para percorrer sequências, listas e intervalos de valores de forma prática.'),
(8, 'Arrays', 'Trabalhando com coleções de dados em Python, organizando e manipulando várias informações dentro de uma única estrutura chamada lista.'),
(9, 'Bibliotecas do Python', 'Uso de módulos prontos que expandem as funcionalidades da linguagem, como matemática, tempo, manipulação de arquivos e muito mais.');

-- --------------------------------------------------------

--
-- Table structure for table `progresso`
--

CREATE TABLE `progresso` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `licao` int(11) NOT NULL,
  `data` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `vidas` int(11) NOT NULL DEFAULT 5,
  `ofensiva` int(11) NOT NULL DEFAULT 0,
  `xp` int(11) NOT NULL DEFAULT 0,
  `modulos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `usuario`, `vidas`, `ofensiva`, `xp`, `modulos`) VALUES
(1, 1, 5, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'buncodefault',
  `cor` varchar(20) NOT NULL DEFAULT 'F2F2F2',
  `link_github` varchar(255) DEFAULT NULL,
  `link_instagram` varchar(255) DEFAULT NULL,
  `link_linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nome`, `email`, `senha`, `foto`, `cor`, `link_github`, `link_instagram`, `link_linkedin`, `created_at`) VALUES
(1, 'administrador', 'Administrador', 'administrador@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncoduolingo', 'F2F2F2', '', '', '', '2025-08-27 18:11:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `licoes`
--
ALTER TABLE `licoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_licoes_modulos` (`modulo`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progresso`
--
ALTER TABLE `progresso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `licao` (`licao`),
  ADD KEY `progresso_ibfk_1` (`usuario`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_ibfk_1` (`usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `licoes`
--
ALTER TABLE `licoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `progresso`
--
ALTER TABLE `progresso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `licoes`
--
ALTER TABLE `licoes`
  ADD CONSTRAINT `fk_licoes_modulos` FOREIGN KEY (`modulo`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `progresso`
--
ALTER TABLE `progresso`
  ADD CONSTRAINT `progresso_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progresso_ibfk_2` FOREIGN KEY (`licao`) REFERENCES `licoes` (`id`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
