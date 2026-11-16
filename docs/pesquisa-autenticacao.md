# Pesquisa sobre autenticação

• Qual é a diferença entre autenticação e autorização?
    Segundo Matthew Kosinski em um artigo no website da IBM, a autenticação serve para verificar o usuário e precisam de senhas, digitais, códigos para confirmar a identidade.Autorização serve para gerenciar as permissões que um usuário pode fazer no sistema, como ler, editar, atualizar e excluir.

    Um único sistema pode fazer a autenticação e a autorização, mas também, cada um dos recursos podem ser trabalhados separadamente. Mas a autenticação pode ser um pré-requisito para a autorização, para conceder permissões a esse usuário. 

    Ataques cibernéticos, nos quais pessoas tem acesso a autorização de outras podem ser diminuidos na medida que o processo de autenticação seja mais complexo, como senhas fortes e autenticação em duas etapas. Consequentemente as permissões restritas a usuários, pode diminuir o risco de sequestro de dados e danos nos sistemas.

• Por que senhas não devem ser armazenadas em texto puro?
    Não devem ser armazenadas em texto puro, diretamente no banco de dados, pois coloca em risco a segurança dos usuários. No caso de uma invasão no banco de dados a pessoa terá acesso a todas as autenticações dos usuários no sistema. Esse é um exemplo de vazamento de dados como consequência de um erro na programação ao não criptografar dados sensíveis.

• O que é um hash de senha?
    O hash de senha transforma a senha em uma cadeia de caracteres embaralhados que não pode ser decifrável e revertido. O hashing ocorre antes de enviar os dados para o armazenamento no banco.
    Mesmo se harckers tiverem acesso ao sistema, terá um grande desafio para realizar engenharia reversa para decifrar o hash. Para fazer tal atividade, é necessário conhecimento especializado e grande processamento computacional.
    O hash de senha é diferente da criptografia, pois esse pode ser revertido.
        "O hashing funciona como um processo unidirecional, tornando extremamente difícil derivar a senha original a partir do seu hash. A mesma senha sempre gera uma saída de hash idêntica quando processada com os mesmos parâmetros.Algoritmos modernos, como bcrypt, Argon2 e SHA-256, minimizam a possibilidade de senhas diferentes produzirem hashes idênticos."(BITWARDEN)

• O que é um token de acesso?
• Para que serve o Laravel Sanctum?
• Como uma rota pode exigir um usuário autenticado?
• Como um token pode ser revogado?
• Que dados não devem aparecer nas respostas da API?
• Que riscos existem ao deixar todos os endpoints públicos?
A pesquisa deverá citar as fontes consultadas. A equipe também deverá registrar quais
funcionalidades seriam protegidas em uma futura versão:
• cadastro de usuários;
• cadastro de categorias;
• abertura de chamados;
• alteração de status;
• consulta de relatórios

## Referências
<https://www.ibm.com/br-pt/think/topics/authentication-vs-authorization>
<https://dev.to/herlon_costa/por-que-criptografar-senhas-e-fundamental-no-desenvolvimento-de-software-5b97>

<https://bitwarden.com/pt-br/resources/what-is-password-hashing/>
