
```markdown
# Sistema de Pedidos para Restaurante

## Descrição

O **Sistema de Pedidos para Restaurante** é um projeto desenvolvido em **PHP** que permite aos clientes de um restaurante fazer pedidos diretamente de suas mesas, através de tablets. O sistema permite que o cliente faça pedidos de pratos e bebidas, visualize a comanda, adicione itens ao carrinho, modifique o carrinho, confirme a compra e solicite a conta para o garçom. 

Este projeto tem como objetivo melhorar a experiência do cliente em restaurantes, facilitando o processo de pedidos e otimizando o atendimento.

## Funcionalidades

- **Chamar o Garçom**: Os clientes podem solicitar a presença do garçom diretamente pelo sistema.
- **Verificar a Comanda**: Visualizar os itens pedidos e o total da conta.
- **Fazer Pedidos**: Adicionar itens ao pedido diretamente no tablet.
- **Modificar Carrinho**: Editar o conteúdo do carrinho de compras antes de finalizar o pedido.
- **Confirmar Compra**: Finalizar o pedido e confirmar a compra.
- **Solicitar a Conta**: Chamar o garçom para trazer a conta.

## Tecnologias Utilizadas

- **PHP**: Backend desenvolvido em PHP puro.
- **MySQL**: Banco de dados utilizado para armazenar os pedidos, produtos, e usuários.
- **PHPUnit**: Para testes unitários.
- **Composer**: Gerenciador de dependências.
- **Dotenv**: Para carregar variáveis de ambiente a partir do arquivo `.env`.

## Requisitos

- **PHP 7.4 ou superior**
- **MySQL**
- **Composer**
- **PHPUnit** (opcional, mas recomendado para rodar os testes)

## Instalação

### 1. Clone o Repositório

Clone o repositório para sua máquina local:

```bash
git clone https://github.com/marcoantonio84/bom_sabor_felipe
```

### 2. Instale as Dependências

Navegue até o diretório do projeto e instale as dependências usando o Composer:

```bash
cd projeto-restaurante
composer install
```

### 3. Configure o Banco de Dados

Crie o banco de dados no MySQL e configure as credenciais no arquivo `.env`. Exemplo:

```ini
DB_HOST=localhost
DB_NAME=restaurante_db
DB_USER=root
DB_PASSWORD=
```

### 4. Rode os Testes (opcional)

Para rodar os testes unitários, use o PHPUnit:

```bash
composer test
```

## Como Usar

O sistema será acessado através de um navegador em dispositivos móveis, como tablets nas mesas do restaurante. A partir daí, os clientes podem interagir com as opções disponíveis para fazer seus pedidos.

## Estrutura de Pastas

Abaixo está a estrutura de pastas do projeto:

```
Projeto Felipe
│
├── config
│   └── database.php
│
├── controllers
│   ├── OrderController.php
│   └── ProductController.php
│
├── models
│   ├── Order.php
│   └── Product.php
│
├── public
│   └── index.php
│
├── routes
│   └── web.php
│
├── tests
│   └── ProductTest.php
│
├── views
│   └── templates
│       └── layout.php
│
├── .env
├── .gitignore
├── composer.json
├── composer.lock
├── phpunit.xml
└── README.md
```

## Contribuição

1. Fork o repositório.
2. Crie uma branch para sua funcionalidade (`git checkout -b feature/nova-funcionalidade`).
3. Faça suas alterações e commit (`git commit -am 'Adiciona nova funcionalidade'`).
4. Push para a branch (`git push origin feature/nova-funcionalidade`).
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
```

### Explicação de cada seção:

- **Descrição**: Explica o objetivo do projeto, destacando as funcionalidades que ele oferece.
- **Funcionalidades**: Lista as principais funcionalidades que o sistema oferece.
- **Tecnologias Utilizadas**: Descreve as tecnologias e bibliotecas usadas no projeto.
- **Requisitos**: Informa as versões mínimas das ferramentas necessárias para rodar o projeto.
- **Instalação**: Passos detalhados para configurar o ambiente e rodar o projeto.
- **Como Usar**: Explica como o sistema será utilizado pelos usuários finais (clientes no restaurante).
- **Estrutura de Pastas**: Mostra a estrutura de pastas do projeto para dar uma visão geral da organização do código.
- **Contribuição**: Guia para quem quiser contribuir com o projeto.
- **Licença**: Informação sobre a licença do projeto (se houver).

### Conclusão

Esse `README.md` serve como um ponto de partida bem organizado para quem for usar ou contribuir no seu projeto. Lembre-se de personalizar as partes conforme necessário (por exemplo, a URL do repositório, detalhes sobre o banco de dados, etc.).

Se precisar de ajustes ou mais detalhes em alguma parte, é só me avisar!