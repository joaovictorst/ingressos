### ADR (Achitecture Decision Record)

#### um modelo de decisões

--

## Ferramentas

### NGINX

sendo uma alternativa dos servidores web, geralmente usado pela sua alta performace e muito fácil de configurar, além de ser bom em lidar com grandes quantidades de tráfego simultâneo

com ele eu consigo fazer aquela forma de utilizar duas aplicações em uma url, como o "/" sendo a index de um projeto e um "/api/" sendo a index da sua api

### DOCKER

sendo uma forma de manter as dependencias sempre atualizadas com o que o projeto precisa sem nenhum tipo de conflito, fui direto com docker devido ser uma máquina virtual, e isso é bom pois não simula o computador inteiro, ele cria um ambiente isolado, isso para manter as configurações separadas direto dentro do conteiner

### PHP-FPM

baseada no protocolo FastCGI, usado para manter processos PHP em execução para responder solicitações recebidas por servidores web como o nginx de forma rapida
utilizando ele devido sua forma de otimizar e organizar o PHP, melhorando e controlando a memória e evitando travamentos, além de acelerar as respostas da aplicação

### PHPUNIT

um Framework para realização dos testes unitários, optei por ele pois consigo utilizar juntamente com o TDD e manter o desenvolvimento guiado