Continuaremos a completar a classe `Filme`, neste caso para indicar sua relação com a classe `Ator`.
 
Para isso, pedimos que você adicione um método chamado `atores` que retornará os atores associados através do método` $this->belongsToMany`, já que o relacionamento neste caso é de muitos para muitos.

Não se esqueça que `belongsToMany` recebe quatro parâmetros:

1. O nome da classe para retornar em uma string. Se a classe relacionada fosse chamada `Ator`, seria necessário escrever **"App\Ator"**
2. O nome da chave da tabela intermediária que compõe o relacionamento.
3. O nome da chave estrangeira que aponta para a classe em que nos encontramos. Neste caso, a chave estrangeira para a tabela de filmes
4. O nome da chave estrangeira que aponta para o relacionamento que estamos construindo. Neste caso, a chave estrangeira para a tabela de atores.

Lembre-se que a tabela intermediária é chamada de **ator_filme** e tem 3 colunas:

1. id
2. actor_id
3. movie_id