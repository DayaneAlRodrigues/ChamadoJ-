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
    São chaves digitais que permitem a autenticação e autorização a usuários ou aplicações á recursos de um sistema. 
    Um exemplo é o JWT (JSON WEB TOKEN) que possui três partes principais:
    - Cabeçalho (Header): contém informações sobre o tipo de token e o algoritmo utilizado para gerar a assinatura.
    - Carga útil (Payload): contém informações (claims), como identificação do usuário, permissões e tempo de expiração.
    - Assinatura (Signature): é utilizada para verificar a integridade e a autenticidade do token, sendo gerada por meio de um algoritmo criptográfico.
    
    Os tokens podem possuir um prazo de validade e ser renovados por meio de mecanismos como Refresh Tokens, aumentando a segurança e reduzindo os riscos associados ao uso de credenciais comprometidas.

    Além disso, quando utilizados em uma arquitetura stateless, não exigem que o servidor mantenha uma sessão para cada usuário. Essa característica facilita a escalabilidade e pode ser bastante útil em sistemas que utilizam microsserviços.


• Para que serve o Laravel Sanctum?
    O Laravel Sanctum é uma ferramenta de autenticação disponibilizada pelo framework Laravel, utilizada em aplicações Single Page Applications (SPA), aplicativos mobile e APIs.

    Possui duas funcionalidades principais:

    1. Personal Access Tokens: permite que os usuários solicitem a geração de tokens de acesso para autenticar requisições a uma API. Esse mecanismo foi inspirado no modelo de tokens de acesso utilizado pelo GitHub. Os tokens podem possuir permissões específicas (abilities), limitando quais operações podem realizar.

    2. Autenticação de Single Page Applications (SPA): permite autenticar usuários por meio de cookies de sessão, utilizando os mecanismos de autenticação do próprio Laravel. Nesse caso, não é necessário utilizar tokens de acesso para cada requisição, pois a autenticação é baseada em sessão e proteção CSRF.
    É uma feature do Laravel para autenticações de sistemas, single page, mobile e APIs. Possui duas funcionalidades principais. Uma é fornecer um personal access token, que foi inspirado no github, onde o usuário pede ao sistema que gere um token de acesso. O outro é para autenticação em sistemas Single Page Aplications.  

• Como uma rota pode exigir um usuário autenticado?
    Uma rota pode exigir que o usuário esteja autenticado por meio de um Middleware de autenticação. No Laravel, podemos utilizar o middleware auth ou auth:sanctum, caso a aplicação utilize o Laravel Sanctum.

    Esse middleware verifica se a requisição possui uma autenticação válida. Caso o usuário não esteja autenticado, o acesso à rota é bloqueado e, em uma API, normalmente é retornado o código HTTP 401 (Unauthorized).

    Também é possível agrupar várias rotas utilizando o middleware, garantindo que todas exijam autenticação.

• Como um token pode ser revogado?
    Um token pode ser revogado por meio da sua invalidação ou remoção, impedindo que continue sendo utilizado para autenticar requisições.

    No Laravel Sanctum, podemos revogar um token excluindo seu registro da tabela personal_access_tokens. Para isso, podemos utilizar o método delete() em conjunto com currentAccessToken(), que identifica o token utilizado na requisição.

    Também é possível revogar todos os tokens de um usuário ou apenas um token específico, permitindo controlar os acessos em diferentes dispositivos.

• Que dados não devem aparecer nas respostas da API?
    Nas respostas de uma API não devem ser expostos dados sensíveis ou informações internas do sistema que possam comprometer a segurança e a privacidade dos usuários.

    Entre essas informações estão senhas, hashes de senhas, tokens de acesso, chaves de API, credenciais, dados pessoais desnecessários e detalhes internos de erros, como consultas SQL e stack traces.

    Para evitar essa exposição, podemos utilizar API Resources no Laravel, que permitem controlar quais atributos serão retornados nas respostas JSON. Também podemos utilizar o atributo `$hidden` nos Models para ocultar informações específicas.

• Que riscos existem ao deixar todos os endpoints públicos?
    Deixar todos os endpoints de uma API públicos representa riscos de segurança, pois permite que qualquer pessoa faça requisições sem precisar estar autenticada.

    Entre os principais riscos estão o acesso não autorizado, vazamento de informações sensíveis, alteração ou exclusão indevida de dados, fraudes e abuso dos recursos da API por meio de um grande volume de requisições.

    Para evitar esses problemas, podemos implementar mecanismos de autenticação e autorização, utilizando ferramentas como Laravel Sanctum, Policies e Gates. Também é importante utilizar validação de dados e limitar a quantidade de requisições por usuário.

    É importante que apenas os endpoints que realmente precisam ser públicos permitam acesso sem autenticação.

1. Funcionalidades que podem ser públicas, são aquelas que não exigem que o usuário esteja autenticado.
| Funcionalidade | Justificativa |
|---|---|
| Cadastro de usuário | Permite que novos usuários criem uma conta. |
| Login | Permite obter as credenciais de acesso. |
| Consulta de saúde da API (`/saude`) | Permite verificar se a API está funcionando. |
| Consulta de categorias | Permite que usuários conheçam as categorias disponíveis |

2. Funcionalidades que devem exigir autenticação por meio do Laravel Sanctum.
| Funcionalidade | Proteção necessária |
|---|---|
| Consultar chamados | Somente usuários autenticados. |
| Consultar um chamado específico | Somente usuários autenticados e autorizados. |
| Criar chamados | Somente usuários autenticados. |
| Atualizar chamados | Usuário autenticado e com permissão. |
| Excluir chamados | Usuário autenticado e com permissão. |
| Criar comentários | Somente usuários autenticados. |
| Consultar comentários | Somente usuários autorizados a visualizar o chamado. |
| Alterar status do chamado | Usuário autenticado e autorizado. |
| Consultar histórico de status | Somente usuários autorizados. |
| Consultar dados dos usuários | Somente usuários autenticados, respeitando as permissões. |
| Atualizar dados do usuário | O usuário só pode alterar seus próprios dados, salvo permissões administrativas. |

3. Funcionalidades que precisam de autorização específica, é necessário verificar se o usuário pode realizar aquela operação.

| Operação | Regra de autorização |
|---|---|
| Editar chamado | Solicitante e administrador |
| Excluir chamado | Administrador |
| Alterar status | Responsável pelo atendimento ou administrador. |
| Adicionar comentário | Usuário com acesso ao chamado. |
| Consultar histórico | Usuário com acesso ao chamado. |
| Alterar dados de outro usuário | Administrador. |

## Referências
<https://www.ibm.com/br-pt/think/topics/authentication-vs-authorization>
<https://dev.to/herlon_costa/por-que-criptografar-senhas-e-fundamental-no-desenvolvimento-de-software-5b97>

<https://bitwarden.com/pt-br/resources/what-is-password-hashing/>

<https://www.sailpoint.com/pt-br/identity-library/access-token>

<https://laravel.com/framework/docs/12.x/sanctum>

<https://laravel.com/framework/docs/13.x/sanctum>

<https://laravel.com/framework/docs/13.x/eloquent-serialization>

<https://laravel.com/framework/docs/13.x/eloquent-resources>

<https://api-security.owasp.org/editions/2023/en/0xa3-broken-object-property-level-authorization/>

<https://laravel.com/framework/docs/13.x/authorization>

<https://laravel.com/framework/docs/13.x/routing>

<https://api-security.owasp.org/>