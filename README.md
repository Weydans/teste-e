# Teste Evolke

Sistema de teste para a Evolke



## Importante

 - Verifique antes de subir os containers se alguma das portas utilizadas pela aplicação encontram-se em uso 



### Observações

- Foi bem legal desenvolver o projeto. Algumas bibliotecas foram utilizadas no processo como Doctrine, Twig e Guzzle.
- A pasta lib é um "micro-framework" que permite a criação de Rotas, Abstração de Controladores e Trais muito úteis no desenvolvimento.
- O sistema está dockerizado sendo esperado o mesmo comportamento em outras máquinas.
- A aplicação conta com variáveis de ambiente (.env) para facilitar o bootstrap do projeto e esconder secrets.
- Todas as classes presentes na pasta src estão em PHP nativo requisitado.
- SGBD MySQL como requisitado.
- Biblioteca de front end Bootstrap (via CDN) como requisitado.
- Foi utilizado o composer para gerenciar as dependências do projeto.
- O projeto conta com migrações para criação da base e povoar tabelas com dados necessários.
- Foi utilizado um arquivo Makefile para facilitar a instalação, Execução e Exclusão do projeto.
- Não foi necessário o uso de Javascript dada a simplicidade do projeto, contudo se necessário podem me aplicar algum teste ou analisar alguns de meus projetos no meu Github.

  Boa avaliação, espero ter feito um bom trabalho ;)

## Dependências

É necessário ter previamente instalado em sua máquina os seguintes softwares:

- [git](https://git-scm.com/downloads)
- [Docker](https://docs.docker.com/engine/install/)
- [docker-compose](https://docs.docker.com/compose/install/)

Clique nos links acima para acessar a página de instalação de cada um.



## Instalação

- Clone o projeto
```bash
git clone https://github.com/Weydans/teste-evolke.git
```

- Acesse a pasta do projeto
```bash
cd teste-evolke
```

- Rode o comando de instalação dos containers
```bash
make install
```


## Execução

- Insira no arquivo `.env` as credenciais do seu banco de dados se estiver em ambiente de produção ou mantenha como está para ambiente de desenvolvimento

- Suba a plicação com o comando abaixo
```bash
make
```



## Acesso

O acesso pode ser realizado pela url [aqui](http://localhost:8000/) nesse link.



## Parar Execução

Interrompe a execução dos containers
```bash
make down
```



## Desinstalação

Remove a pasta com todos os arquivos do projeto
```bash
sudo make uninstall
```
