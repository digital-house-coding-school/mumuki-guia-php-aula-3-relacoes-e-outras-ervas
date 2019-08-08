public function testValidação(): void {
  global $pasePorRedirect;
  global $request;
  global $pasePorSave;
  
  $request = new Request();
  
  $this->assertTrue(method_exists("FilmesController",'adicionar'),"Está faltando o método adicionar no FilmesController");
  
  $r = new ReflectionMethod("FilmesController", "adicionar");
  $params = $r->getParameters();
  
  $this->assertTrue(count($params) === 1, "O método adicionar deve receber um parâmetro");
  
  $this->assertTrue($params[0]->getType() !== null && $params[0]->getType()->getName() === "Request", "O parâmetro recebido por adicionar deve ser uma Request");
  
  $pasePorRedirect = false;
  
  $pc = new FilmesController();
  
  $request->title = "O rei leão";
  $request->rating = 9.2;
  $request->awards = 5;
  
  try {
    $resul = $pc->adicionar($request);
  } catch(Exception $e) {
    $this->assertTrue(false, $e->getMessage());
  }
  
  $request->title = "Wall-e";
  $request->rating = 8.1;
  $request->awards = 4;
  
  try {
    $resul = $pc->adicionar($request);
  } catch(Exception $e) {
    $this->assertTrue(false, $e->getMessage());
  }
  
  $this->assertTrue($pasePorSave, "Hmm... parece que o método adicionar não está adicionando nada");
  
  $this->assertTrue($pasePorRedirect, "Parece que não está chamando a função redirect");
  
  $this->assertTrue(is_string($resul), "Está retornando o resultado da função redirect?");
  
  
}