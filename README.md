# API - FastService
Plataforma Ead - API-RESTFul para sistema Ead.

Desenvolvido com as seguintes tecnologias:
- Conceitos de boas práticas e qualidade no código, usando Design Patterns, Clean Architecture, Domain Driven Design (DDD) e Princípios SOLID
- Laravel
- Banco de dados relacional **MySQL**
- Testes de Integração
- **Docker**

 ### Funcionalidades do software
 - Curso
    - Visualizar curso específico
    - Visualizar todos os cursos

- Modulos
    - Visualizar todos os modulos baseado no curso especificado

- Aulas
    - Visualizar aula específico
    - Visualizar todas as aulas baseado no modulo especificado

- Suporte
    - Criar uma mensagem de suporte para aula especificada
    - Criar uma resposta para o suporte especifico
    - Visualizar todos os suportes pela aula e status especificado
    - Visualizar todos meus suportes criados pela aula especificada
      
- Visualização
    - Visualização de aula
      
- Autenticação
    - Login
    - Logout
    - Forgot Password
    - Reset Password
    - Visualizar informações do usuário autenticado 

---
## Como executar o projeto

1. Baixe e instale o Docker Desktop
2. Faça o Download do zip do projeto ou clone o repositório Git e extraia o conteúdo do arquivado compactado
3. Navegue até a pasta do projeto e abra o Prompt de Comando do Windows ou Terminal do GNU/Linux
4. Execuete o comando `mvn clean package -DskipTests`. Ele irá gerar os target jar
5. Execute o comando `docker-compose up -d --build`. Ele irá criar os container.

![Captura de tela 2023-04-12 203236](https://user-images.githubusercontent.com/43589505/231607980-d6ce2108-7ed0-4e8e-b681-4b9d2b0a6603.png)

6.  Abra o VSCode ou IDE de sua preferência.
7.  Importe o projeto baixado: Vá em File > Open Projects from File System. Selecione a pasta pela opção "Directory" e pressione Finish.
8.  O projeto irá ser executado.
9.  Entre com a url http://localhost:8989/; 

### Autor
Feito por Cícero Júnior. 👋🏽 Entre em contato! <br>
<a href="https://www.linkedin.com/in/juniiorsilvadev/" target="_blank"><img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank"></a> 




