class FilmesController extends Controller {
	public function listar() {
		$filmes = Filme::all();
		return view("listarFilmes", compact('filmes'));
	}
}