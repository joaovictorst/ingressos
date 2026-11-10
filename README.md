# Ingressos

Plataforma de venda de ingressos para eventos, construída do zero como projeto de estudo
na trilha do Comitê de Arquitetura da Ipe Web.

O objetivo é entender cada camada de um sistema web, da requisição HTTP ao deploy,
sem framework na primeira fase e sem ajuda de inteligência artificial.

## Requisitos

- Git
- Docker com Docker Compose

O PHP, o Composer e o PHPUnit rodam dentro do container. Não é preciso instalar nada disso na máquina.

## Como subir
```bash
    docker compose up -d --build
```
Abre em http://localhost:8080.

## para conferir:
```bash
    curl -i localhost:8080/saude
```
## resposta esperada:

```json
    {"status":"ok","versao":"dev"}
```

## Rotas


## Pastas


## Anotações