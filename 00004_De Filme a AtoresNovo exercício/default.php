class Filme extends Model {
	protected $table = "filmes";
	protected $guarded = [];
	
	public function recomendado() {
	   return $this->rating > 8;
	}
	
	public function genero() {
	   return $this->belongsTo("App\Genero","genero_id");
	}
}