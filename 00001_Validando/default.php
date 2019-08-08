class FilmesController extends Controller {
  public function adicionar(Request $req) {
    $filme = new Filme();
    $filme->title = $req["title"];
    $filme->rating = $req["rating"];
    $filme->awards = $req["awards"];
    
    $filme->save();
    
    return redirect("filmes/listar");
  }
}