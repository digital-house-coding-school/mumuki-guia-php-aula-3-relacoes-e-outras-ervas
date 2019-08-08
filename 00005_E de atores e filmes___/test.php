public function testAtor(): void {
  $actor = new Ator();
  
  $this->assertTrue($actor->getTable() === "atores", "O \$table da tabela de atores deve chamar 'atores'");
  
  $this->assertTrue($actor->getPrimaryKey() === "id", "A \$primaryKey da tabela de atores deve chamar 'id'"); 
  
  $this->assertTrue($actor->getTimestamps() === true, "É necessário declarar que a tabela de atores não tem os timestamps");
  
  $this->assertTrue(is_array($actor->getGuarded()), "O atributo \$guarded deve ser um array");
  
  $this->assertTrue($actor->getGuarded() === [], "O atributo \$guarded deve ser um array vazio para que todas as colunas da tabela devem ser preenchíveis");
  
  $this->assertTrue(method_exists("Ator", "filmes"), "Falta o método filmes na classe Ator");
  
  $filmes = $actor->filmes();
  
  $this->assertTrue($actor->belongsToMany, "A função filmes deve chamar o método belongsToMany");
  
  $this->assertTrue(is_array($filmes) && count($filmes) == 4,"Lembra que o método filmes deve retornar o resultado de belongsToMany");
  
  $this->assertTrue(is_string($filmes[0]), "O primeiro parâmetro enviado a belongsToMany deve ser uma string");
  
  $this->assertTrue(is_string($filmes[1]), "O segundo parâmetro enviado a belongsToMany deve ser uma string");
  
    $this->assertTrue(is_string($filmes[2]), "O terceiro parâmetro enviado a belongsToMany deve ser uma string");
  
  $this->assertTrue(is_string($filmes[3]), "O quarto parâmetro enviado a belongsToMany deve ser uma string");
  
  $this->assertTrue($filmes[0] === "App\Filme", "Era esperado que o primeiro parâmetro recebido por belongsToMany diga 'App\Filme'");
  
  $this->assertTrue($filmes[1] === "filme_ator", "Era esperado que o segundo parâmetro recibido por belongsToMany diga 'filme_ator' fazendo referência a chave intermediária");
  
  $this->assertTrue($filmes[2] === "ator_id", "Era esperado que o terceiro parâmetro recibido por belongsToMany diga 'ator_id' fazendo referência a chave estrangeira para a classe Ator");
  
  $this->assertTrue($filmes[3] === "filme_id", "Se esperaba que el cuarto parámetro recibido por belongsToMany diga 'movie_id' fazendo referência a chave estrangeira para a classe Filme");
}

