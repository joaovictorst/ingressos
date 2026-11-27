O caminho é:

`URL -> DNS -> TCP -> TLS -> HTTP -> RENDER`

## o que é o DNS?

para o usuário acessar um site ele digita a url no navegador, ao digitar o navegador precisa do ip para conectar, a tradução da URL para o IP é trabalho do DNS(DOMAIN NAME SYSTEM),então é meio que uma conversão, a url vira um numero

## O QUE É O TCP?

agora que o meu navegador sabe o numero do site, é só "ligar" pra ele, uma forma de fazer isso é usando o TCP(TRANSMISSION CONTROL PROTOCOL), ele garante que os dados cheguem completos e na ordem correta

TCP começa com 3 pequenas mensagens

- **SYN** (tipo um "quero conversar")
- **SYN-ACK** (o servidor responde dizendo que o ouve e também quer conversar)
- **ACK** (é a confirmação do computador de está tudo ok)

para sites seguros isso acontece na porta 443(HTTPS)

## O QUE É O TLS?

o tls(TRANSPORT LAYER SECURITY) na conversa entre o navegador e o servidor eles decidem um tipo de chave para criptografar a comunicação então o navegador manda uma chave e o servidor retorna com um certificado, o navegador checa se o certificado é real e eles dois batem com o nome do dominio
então o navegador e o servidor irão possuir a chave secreta, e qualquer tentativa de captura entre essa comunicação ficará criptografada

## O QUE É O HTTP?

o navegador manda um tipo de requisição http com uma pequena escrita:

```
  GET / HTTP/1.1
  Host: www.google.com
  Accept: text/html
```

servidor vai lá e responde de volta

```
  HTTP/1.1 200 OK
  content-type: text/html

  <!DOCTYPE html>
    <html>...
```

e por fim renderiza a tela com o que o servidor respondeu

## dig o que é?

dig significa Domain Information Groper, uma ferramenta de linha de comando utilizada para consultar servidores DNS e pegar algumas informações mais detalhadas sobre registros de domínios, como:
mx que busca toda a config de recebimento de email do dominio

### como funciona?

ao executar dig + nome de um domínio meio que o pc envia uma consulta direta a um servidor DNS que o servidor processa a requisição e devolve a resposta bruta exatamente como foi configurada na zona DNS do domínio.

## dig www.google.com

esse informa a versão e o que foi acessado

```
; <<>> DiG 9.18.39-0ubuntu0.24.04.8-Ubuntu <<>> www.google.com
;; global options: +cmd

;; Got answer:
```

significa uma consulta com status NOERROR significa que nao deu erro e o id

```
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 42212
```

algumas flags, com a quantidade de query, chegaram 8 respostas

```
;; flags: qr rd ra; QUERY: 1, ANSWER: 8, AUTHORITY: 0, ADDITIONAL: 1
```

a pergunta feita

```
;; QUESTION SECTION:
;www.google.com.                        IN      A
```

as respostas com o valor consultado

- o ttl que é por quanto tempo fica em cache a resposta
- IN de internet
- A de IPv4
- e o IP

```
;; ANSWER SECTION:
www.google.com.         139     IN      A       142.251.150.119
www.google.com.         139     IN      A       142.251.154.119
www.google.com.         139     IN      A       142.251.151.119
www.google.com.         139     IN      A       142.251.155.119
www.google.com.         139     IN      A       142.251.156.119
www.google.com.         139     IN      A       142.251.153.119
www.google.com.         139     IN      A       142.251.157.119
www.google.com.         139     IN      A       142.251.152.119

;; Query time: 2 msec
;; SERVER: 127.0.0.53#53(127.0.0.53) (UDP)
;; WHEN: Thu Nov 26 16:37:04 -03 2026
;; MSG SIZE  rcvd: 171

```

## openssl s_client -connect www.google.com:443

esse aqui é a parte do TLS que acontece entre a conexão, com sua cadeia de certificados e o seu certificado do servidor

coloquei 3 pontinhos na chave do certificado pra nao ficar tão grande o documento

```
CONNECTED(00000003)
depth=2 C = US, O = Google Trust Services LLC, CN = GTS Root R4
verify return:1
depth=1 C = US, O = Google Trust Services, CN = WE2
verify return:1
depth=0 CN = www.google.com
verify return:1
---
```

S como o titular/ pra quem foi emitido que seria o www.google.com

I foi o emissor que é a autoridade que assinou o certificado (quem assinou)

A é o tipo de algoritmo e a chave publica

V a validade

sendo www.google.com recebeu emitido por google trust services que recebeu de google trust services LLC que recebeu de Global sign nv-sa

```
Certificate chain
 0 s:CN = www.google.com
   i:C = US, O = Google Trust Services, CN = WE2
   a:PKEY: id-ecPublicKey, 256 (bit); sigalg: ecdsa-with-SHA256
   v:NotBefore: Nov  3 08:29:37 2026 GMT; NotAfter: Jan 26 08:29:36 2027 GMT
 1 s:C = US, O = Google Trust Services, CN = WE2
   i:C = US, O = Google Trust Services LLC, CN = GTS Root R4
   a:PKEY: id-ecPublicKey, 256 (bit); sigalg: ecdsa-with-SHA384
   v:NotBefore: Dec 13 09:00:00 2023 GMT; NotAfter: Feb 20 14:00:00 2029 GMT
 2 s:C = US, O = Google Trust Services LLC, CN = GTS Root R4
   i:C = BE, O = GlobalSign nv-sa, OU = Root CA, CN = GlobalSign Root CA
   a:PKEY: id-ecPublicKey, 384 (bit); sigalg: RSA-SHA256
   v:NotBefore: Nov 15 03:43:21 2023 GMT; NotAfter: Jan 28 00:00:42 2028 GMT
---
Server certificate
-----BEGIN CERTIFICATE-----
MIIDezCCAy...
-----END CERTIFICATE-----
subject=CN = www.google.com
issuer=C = US, O = Google Trust Services, CN = WE2
---
No client certificate CA names sent
Peer signing digest: SHA256
Peer signature type: ECDSA
Server Temp Key: X25519, 253 bits
---
```

aqui possui as chaves criadas para esse sessão que garante que nao tenha interceptação do trafego
e a confirmação que o certificado passou em todos os testes de segurança

## curl -v https://www.google,com

```
* Host www.google.com:443 was resolved.
*   Trying [2001:4860:4829:7700::]:443...
* Connected to www.google.com (2001:4860:4829:7700::) port 443
* ALPN: curl offers h2,http/1.1
* SSL connection using TLSv1.3 / TLS_AES_256_GCM_SHA384 / X25519 / id-ecPublicKey
* ALPN: server accepted h2
< HTTP/2 200
< content-type: text/html; charset=ISO-8859-1
< date: Fri, 27 Nov 2026 03:34:53 GMT
< expires: -1
< cache-control: private, max-age=0
< server: gws
...
```

o curl v conecta na porta 443 dele, usa o TLSv1.3 e espera o http e logo a resposta volta com HTTP/2 e status 200, seu content-type que vai ser um html que irá retornar, cache-control que é a regra de cache e quanto tempo tem e o server que indica o servidor HTTP que respondeu

## curl -v http://localhost:8080/saude

```
- Host localhost:8080 was resolved.
- IPv6: ::1
- IPv4: 127.0.0.1
- Trying [::1]:8080...
- Connected to localhost (::1) port 8080
  > GET /saude HTTP/1.1
  > Host: localhost:8080
  > User-Agent: curl/8.5.0
  > Accept: _/_
  >
  > < HTTP/1.1 200 OK
  > < Server: nginx/1.29.3
  > < Date: Fri, 27 Nov 2026 04:12:35 GMT
  > < Content-Type: text/html; charset=UTF-8
  > < Transfer-Encoding: chunked
  > < Connection: keep-alive
  > < X-Powered-By: PHP/8.4.27
  > <
  > {
      "status": "ok",
      "versao": "dev"
  }
```
o curl -v conectou e chegou no nginx bateu no location / usou o fastcgi_pass para o PHP-FPM