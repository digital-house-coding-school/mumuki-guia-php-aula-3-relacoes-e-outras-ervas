**Esclarecimento: Neste exercício não é necessário que você adicione a linha `use App\Filme;` Você pode assumir que o arquivo já está incluído**

Mais uma vez recebemos o seguinte formulário para inserir um filme:

``html
<form action="/filmes/adicionar" method="POST">
  {{csrf_field}}
  <input type="text" name="title">
  <input type="text" name="rating">
  <input type="text" name="awards">
</ form>
``

Desta vez, no entanto, também pediremos que você o valide antes de armazená-lo. As regras de validação serão as seguintes:

> 1. Para o campo **title**, queremos que seja obrigatório, com um máximo de 255 caracteres e exclusivo na tabela **filmes** na coluna **title**

> 2. Para a classificação, queremos que seja obrigatória, numérica, com um mínimo de 0 e um máximo de 10

> 3. Os prêmios que queremos ser obrigatórios e um inteiro com um mínimo de 0

Deixamos um link à mão para que você possa revisar as regras de validação do Laravel:

[https://laravel.com/docs/master/validation#available-validation-rulesrtada](https://laravel.com/docs/master/validation#available-validation-rules)