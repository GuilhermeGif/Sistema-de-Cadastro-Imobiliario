# Sistema de Cadastro Imobiliário

Este é um sistema simples desenvolvido em PHP e MySQL para cadastro de imóveis e proprietários. Ele permite adicionar pessoas e imóveis ao banco de dados, consultar os registros existentes, além de possibilitar a edição e exclusão dos dados cadastrados.

# Funcionalidades
- Cadastro de Pessoas: Adiciona pessoas ao banco de dados.
- Cadastro de Imóveis: Adiciona imóveis ao banco de dados e associa cada imóvel a uma pessoa cadastrada como proprietária.
- Consulta de Imóveis e Pessoas: Exibe uma lista de todos os imóveis cadastrados e suas respectivas informações, incluindo o proprietário.
- Edição de Registros: Permite a edição dos dados de pessoas e imóveis já cadastrados.
- Exclusão de Registros: Permite a exclusão de pessoas e imóveis cadastrados.

# Tecnologias Utilizadas
- Backend: PHP 7.4+
- Banco de Dados: MySQL 5.7+

# Requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor Apache (ou outro servidor compatível com PHP)

# Uso

1. Cadastro de Pessoa:
- Navegue até a página de cadastro de pessoas e preencha os campos solicitados (nome, CPF, data de nascimento, email, telefone).

2. Cadastro de Imóvel:
- Para cadastrar um imóvel, é necessário selecionar um proprietário já cadastrado. Informe os dados do imóvel (endereço, cidade, estado, CEP) e associe-o a uma pessoa.

3. Consulta, Edição e Exclusão:
- Acesse a página de consulta, onde serão exibidos todos os imóveis e seus respectivos proprietários. A partir dessa tela, é possível editar ou excluir os registros assim como buscar utilizando critérios como logradouro, nome e CPF.

# Banco de Dados
- O banco de dados da aplicação é exportado para um arquivo cadastro_imoveis.sql, que está disponível no repositório. Este arquivo pode ser utilizado para importar as tabelas e dados necessários para a execução do sistema.

# Licença

Este projeto é licenciado sob a MIT License.

