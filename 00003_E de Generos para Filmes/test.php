public function testGenero(): void {
  $genero = new Genero();
  
  $this->assertTrue($genero->getTable() === "generos", "O \$table da tabela de generos deve chamar 'generos'");
  
  $this->assertTrue($genero->getPrimaryKey() === "id", "A \$primaryKey da tabela de generos deve chamar 'id'"); 
  
  $this->assertTrue($genero->getTimestamps() === false, "É necessário declarar que a tabela de generos não tem os \$timestamps");
  
  $this->assertTrue(is_array($genero->getGuarded()), "O atributo \$guarded deve ser um array");
  
  $this->assertTrue($genero->getGuarded() === [], "O atributo \$guarded deve ser um array vazio para que todas as colunas da tabela devem ser preenchíveis");
  
  $this->assertTrue(method_exists("Genero", "filmes"), "Falta o método filmes na classe Genero");
  
  $filmes = $genero->filmes();
  
  $this->assertTrue($genero->hasMany, "A função filmes deve chamar o método hasMany");
  
  $this->assertTrue(is_array($filmes) && count($filmes) == 2,"Lembra que o método filmes deve retornar o resultado de hasMany");
  
  $this->assertTrue(is_string($filmes[0]), "O primeiro parâmetro enviado a hasMany deve ser uma string");
  
  $this->assertTrue(is_string($filmes[1]), "O segundo parâmetro enviado a hasManny deve ser uma string");
  
  $this->assertTrue($filmes[0] === "App\Filme", "O primeiro parâmetro esperado por hasMany deve ser 'App\Filme'");
  
  $this->assertTrue($filmes[1] === "genero_id", "O segundo parâmetro esperado por hasMany deve ser 'genero_id'");
}