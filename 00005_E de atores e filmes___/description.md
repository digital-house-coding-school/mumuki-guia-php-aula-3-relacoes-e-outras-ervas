Vamos completar a classe `Ator`, neste caso para indicar a sua relação com a classe`Filme`.

Para isso, pedimos que você adicione um método chamado `filmes` que retornará os filmes associados usando o método`$this->belongsToMany`, já que o relacionamento neste caso é de muitos para muitos.

Não se esqueça que `belongsToMany` recebe quatro parâmetros:

1. O nome da classe para retornar em uma string. Se a classe relacionada fosse chamada `Sarasa`, seria necessário escrever **"App\Sarasa"**
2. O nome da chave da tabela intermediária que compõe o relacionamento.
3. O nome da chave estrangeira que aponta para a classe em que nos encontramos. Neste caso, a chave estrangeira para a tabela de atores
4. O nome do código estrangeiro que aponta para o relacionamento que estamos construindo. Neste caso, a chave estrangeira para a tabela de filmes.


Como lembrança, a tabela intermediária é chamada de **actor_movie** e tem 3 colunas:

1. id
2. actor_id
3. movie_id