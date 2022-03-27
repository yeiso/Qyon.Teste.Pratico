## Alterações realizadas

## Backend

- Criada a tabela de movimentações, o arquivo de migrate e foreign key relacionando com a tabela banks.

- Criada todas as rotas de visualização, atualização e delete da tabela de movimentações e a rota que lista todas as transações de uma conta especifica.

- Validações nos metodos de update, create e delete evitando que sejam realizadas transações e atualizações que deixem a conta com saldo negativo.

- Ao realizar update em movimentações, é realizado o processo para desfazer a movimentação anterior, seja na conta atual ou em outra conta envolvida. O mesmo processo é realizado ao apagar as movimentações.   

- Arquivo de ambiente do Insomnia incluso na pasta /backend. (Insomnia_2022-03-27.json).

## Frontend

- Versão do React atualizada para remover vunerabilidades de dependencias.

- Utilização do NextJS, Material UI.

- Criado os Hooks.

- Criada as duas telas para listagem de contas e de movimentações da mesma. (Index: lista todas as contas | transferencias/[id]: lista as movimentações).