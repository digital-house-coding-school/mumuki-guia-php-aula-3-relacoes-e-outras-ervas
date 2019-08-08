public function testFilme(): void {
			$pelicula = new Filme();
		
			$this->assertTrue($pelicula->getTable() === "filmes", "A tabela de filmes deve se chamar 'filmes'");
			
			$this->assertTrue($pelicula->getPrimaryKey() === "id", "A primary key da tabela filmes deve se chamar 'id'"); 
			
			$this->assertTrue($pelicula->getTimestamps() === true, "É necessário declarar que a tabela de filmes tenha timestamps");
			
			$this->assertTrue(is_array($pelicula->getGuarded()), "O atributo guarded deve ser um array");
			
			$this->assertTrue($pelicula->getGuarded() === [], "O atributo guarded deve ser um array vazio para que todas as colunas sejam  escrevíveis");
			
			$this->assertTrue(method_exists("Filme", "recomendado"), "Falta o método recomendado na classe Filme");
			
			$pelicula->rating = 9;
			
			$this->assertTrue($pelicula->recomendado() === true, "Um filme com rating 9 deveria retornar true ao perguntar se é recomendado");
			
			$pelicula->rating = 7.9;
			
			$this->assertTrue($pelicula->recomendado() === false, "Um filme com rating 7.9 deveria retornar false ao perguntar se é recomendado");
			
			$this->assertTrue(method_exists("Filme", "genero"), "Falta o método genero na classe Filme");
			
			$genero = $pelicula->genero();
			
			$this->assertTrue($pelicula->belongsTo, "A função genero deve chmar a belongsTo");
			
			$this->assertTrue(is_array($genero) && count($genero) == 2,"Lembre que o método genero deve retornar o resultado de belongsTo");
			
			$this->assertTrue(is_string($genero[0]), "O primeiro parâmetro enviado a belongsTo deve ser uma string");
			
			$this->assertTrue(is_string($genero[1]), "O segundo parâmetro enviado a belongsTo deve ser umastring");
			
			$this->assertTrue($genero[0] === "App\Genero", "Se espera que o primeiro parâmetro recebido pela belongsTo seja 'App\Genero'");
			
			$this->assertTrue($genero[1] === "genero_id", "Se espera que o segundo parâmetro recebido pela belongsTo seja 'genero_id'");
				
			$this->assertTrue(method_exists("Filme", "atores"), "Falta o método atores na classe Filme");
			
			$actores = $pelicula->atores();
			
			$this->assertTrue($pelicula->belongsToMany, "A função atores deve chamar a belongsToMany");
			
			$this->assertTrue(is_array($actores) && count($actores) == 4,"Lembre-se que o método atores deve retornar o resultado da belongsToMany");
			
			$this->assertTrue(is_string($actores[0]), "O primeiro parâmetro passado para a belongsToMany deve ser uma string");
			
			$this->assertTrue(is_string($actores[1]), "O segundo parâmetro passado para a belongsToMany deve ser uma string");
			
			$this->assertTrue(is_string($actores[2]), "O terceiro parâmetro passado para a belongsToMany deve ser uma string");
			
			$this->assertTrue(is_string($actores[3]), "O quarto parâmetro passado para a belongsToMany deve ser uma string");
			
			$this->assertTrue($actores[0] === "App\Ator", "Se espera que o primeiro parâmetro recebido por belongsToMany seja 'App\Ator'");
			
			$this->assertTrue($actores[1] === "ator_filme", "Se espera que o segundo parâmetro recibido por belongsToMany seja 'ator_filme' fazendo referência à tabela intermediária");
			
			$this->assertTrue($actores[2] === "filme_id", "Se espera que o terceiro parâmetro recibido por belongsToMany seja 'filme_id' fazendo referência a chave estrangeira à classe Filme");
			
			$this->assertTrue($actores[3] === "ator_id", "Se espera que o quarto parâmetro recibido por belongsToMany seja 'ator_id' fazendo referência a chave estrangeira à classe Ator");
		}