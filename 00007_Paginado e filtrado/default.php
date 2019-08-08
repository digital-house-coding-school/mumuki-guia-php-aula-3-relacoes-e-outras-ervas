class FilmesController extends Controller {
  public function bonsFilmes() {
    $filmes = Filme::where("rating", ">", "8")->get();
    return view("bonsFilmes", compact("filmes"));
  }
}