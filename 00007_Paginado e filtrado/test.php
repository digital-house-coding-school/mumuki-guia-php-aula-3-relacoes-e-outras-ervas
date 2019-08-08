public function testPaginadoEFiltrado(): void {
  global $pasePorView;
  
  $pasePorView = false;
  
  $pc = new FilmesController();
  
  try {
    $resul = $pc->bonsFilmes();
  } catch(Exception $e) {
    $this->assertTrue(false, $e->getMessage());
  }
  
  $this->assertTrue($pasePorView, "Parece que não está chamando a função view");
  
  $this->assertTrue(is_string($resul), "Está retornando a função view?");
}