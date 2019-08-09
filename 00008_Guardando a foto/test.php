public function testStorage(): void {
		global $pasePorRedirect;
		global $request;
		global $pasePorSave;
		
		$request = new Request();
		
		$this->assertTrue(method_exists("FilmesController",'store'),"Falta o método store dentro da FilmesController");
		$r = new ReflectionMethod("FilmesController", "store");
		$params = $r->getParameters();
		
		$this->assertTrue(count($params) === 1, "O método store deve receber um parâmetro.");
		
		$this->assertTrue($params[0]->getType() !== null && $params[0]->getType()->getName() === "Request", "O parâmetro recebido pelo store deve ser do tipo Request");
		
		$pasePorRedirect = false;
		
		$pc = new FilmesController();
		
		$request->title = "O Rei Leão";
		$request->rating = 9.2;
		$request->awards = 5;
		$request->posterSecreto = "oreileao.jpg";
		
		try {
		  $resul = $pc->store($request);
		} catch(Exception $e) {
		  $this->assertTrue(false, $e->getMessage());
		}
		
		$request->title = "Wall-e";
		$request->rating = 8.1;
		$request->awards = 4;
		$request->posterSecreto = "walle.jpg";
		
		try {
		  $resul = $pc->store($request);
		} catch(Exception $e) {
		  $this->assertTrue(false, $e->getMessage());
		}
		
		$this->assertTrue($pasePorSave, "Parece que não está salvando");
		
		$this->assertTrue($request->pasePorStore, "Parece que não está armazenando a imagem");
		
		$this->assertTrue($pasePorRedirect, "Parece que não está chamando afunção redirect");
		
		$this->assertTrue(is_string($resul), "Verifique se está retornando o resultado da função redirect. Verifique também o nome da view retornada.");
		
		
	}