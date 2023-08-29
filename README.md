# Teste Evolke

Sistema de teste para a Evolke



## Importante

 - Verifique antes de subir os containers se alguma das portas utilizadas pela aplicação encontram-se em uso 



### Observações



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
sudo make install
```


## Execução

- Insira no arquivo `.env` as credenciais do seu banco de dados se estiver em ambiente de produção ou mantenha como está para ambiente de desenvolvimento

- Suba a plicação com o comando abaixo
```bash
sudo make
```



## Acesso

O acesso pode ser realizado pela url [aqui](http://localhost:8000/) nesse link.



## Parar Execução

Interrompe a execução dos containers
```bash
sudo make down
```



## Desinstalação

Remove a pasta com todos os arquivos do projeto
```bash
sudo make uninstall
```
