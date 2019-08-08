public function testPaginado(): void {
		global $pasePorView;
		
		$pasePorView = false;
		
		$pc = new FilmesController();
		
		try {
			$resul = $pc->listar();
		} catch(Exception $e) {
			$this->assertTrue(false, $e->getMessage());
		}
		
		$this->assertTrue($pasePorView, "Você deve chamar a função view");
		$this->assertTrue(is_string($resul), "Verifique se está retornando o resultado da função view? Verifique o nome da view retornada e da variável passada a ela.");
	}