class FilmesController extends Controller {
	public function store(Request $req) {
	  $this->validate($req,[
		"title" => "required|max:255|unique:movies,title",
		"rating" => "required|numeric|min:0|max:10",
		"awards" => "required|integer|min:0"
	  ]);
	  
	  $filme = new Filme();
	  $filme->title = $req["title"];
	  $filme->rating = $req["rating"];
	  $filme->awards = $req["awards"];
	  
	  $filme->save();
	
	  return redirect("filmes/listar");
	}
}