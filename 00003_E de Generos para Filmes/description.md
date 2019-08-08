Continuaremos completando a classe `Genero`, neste caso para indicar sua relação com a classe` Filme`.

Para isso, pedimos que você adicione um método chamado `filmes` que retornará os filmes associados usando o método` $this->hasMany`.

Não se esqueça que `hasMany` recebe dois parâmetros:

1. O nome da classe em uma string. Se a classe relacionada foi chamada `Sarasa`, seria necessário escrever **"App\Sarasa"**
2. O nome da chave estrangeira. Neste caso, a chave é **genero_id**