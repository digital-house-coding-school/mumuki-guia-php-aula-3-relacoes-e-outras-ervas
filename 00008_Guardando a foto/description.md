**Esclarecimento: Neste exercício não é necessário que você adicione a linha `use App\Movie;`. Você pode assumir que o arquivo já está incluído**

Desta vez, o filme validado e salvo já está armado... nós já fizemos.

Nesse caso, consideraremos que o campo a seguir também está incluído no formulário para inserir um filme:

```html
<input type = "file" name = "poster">
```

Por sua vez, uma coluna, também chamada de poster, foi adicionada à tabela de filmes no banco de dados.

> O seu trabalho é modificar o método `store` para que você também salve a foto na pasta **public** e atribua o nome do arquivo à coluna poster no banco de dados antes de executar o método save.

Sucesso!