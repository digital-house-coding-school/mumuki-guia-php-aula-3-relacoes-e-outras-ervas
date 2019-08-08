$pasePorView = false;
$pasePorRedirect = false;
$pasePorSave = false;
$pasePorValidate = false;

$id = null;

$request = null;

function view($route, $vac = []) {
  global $pasePorView;
  
  $pasePorView = true;
  
  if ($route == "filmesAceitaveis") {

    
  } else {
    
  }
  
  return $route;
}

function redirect($route) {
  global $pasePorRedirect;
  
  $pasePorRedirect = true;
  
  if ($route == "filmes/listar" || $route === "/filmes/listar") {

    
  } else {
    throw new Exception("Depois de inserir o filme você deve redirecionar para a URL /filmes/listar");
  }
  
  return $route;
}

class Route {
  public static $routesGet = [];
  public static $routesPost = [];

  public static function get($route, $action) {
    $newRoute = [
      "route" => $route,
      "action" => $action
    ];
    
    Route::$routesGet[] = $newRoute;
  }
  
  public static function post($route, $action) {
    $newRoute = [
      "route" => $route,
      "action" => $action
    ];
    
    Route::$routesPost[] = $newRoute;
  }

}

class Controller {
  public function validate(Request $req, Array $reglas, Array $mensajes = []) {
    global $pasePorValidate;
    
    $pasePorValidate = true;
    
    if (count($reglas) != 3) {
      throw new Exception("Lembre que você deve validar 3 campos e, por isso, o array de regras deve ter três posições");
    }
    
    if (!isset($reglas["title"])) {
      throw new Exception("Falta a regra para validar o campo title");
    }
    if (!isset($reglas["rating"])) {
      throw new Exception("Falta a regra para validar o campo rating");
    }
    if (!isset($reglas["awards"])) {
      throw new Exception("Falta a regra para validar o campo awards");
    }
    
    if (!is_string($reglas["title"])) {
      throw new Exception("As regras para validar o title devem estar no formato string");
    }
    if (!is_string($reglas["rating"])) {
      throw new Exception("As regras para validar o rating devem estar no formato string");
    }
    if (!is_string($reglas["awards"])) {
      throw new Exception("As regras para validar o awards devem estar no formato string");
    }
    
    $reglasTitle = explode("|", $reglas["title"]);
    $reglasRating = explode("|", $reglas["rating"]);
    $reglasAwards = explode("|", $reglas["awards"]);
    
    if (count($reglasTitle) != 3) {
      throw new Exception("Seu código deve ter 3 regras para validar o titulo separadas pelo caractere |");
    }
    
    if (count($reglasRating) != 4) {
      throw new Exception("Seu código deve ter 4 regras para validar o rating separadas pelo caractere |");
    }
    
     if (count($reglasAwards) != 3) {
      throw new Exception("Seu código deve ter 3 regras para validar o awards separadas pelo caractere |");
    }
    
    if (!in_array("required", $reglasTitle)) {
      throw new Exception("Falta a regra required para validar o titulo");
    }
    
    if (!in_array("max:255", $reglasTitle)) {
      throw new Exception("Falta a regra max:255 para validar o titulo");
    }
    
    if (!in_array("unique:filmes,title", $reglasTitle)) {
      throw new Exception("Falta a regra unique:filmes,title para validar o titulo");
    }
    
    if (!in_array("required", $reglasRating)) {
      throw new Exception("Falta a regra required para validar o rating");
    }
    
    if (!in_array("numeric", $reglasRating)) {
      throw new Exception("Falta a regra numeric para validar o rating");
    }
    
    if (!in_array("min:0", $reglasRating)) {
      throw new Exception("Falta a regra min:0 para validar o rating");
    }
    
    if (!in_array("max:10", $reglasRating)) {
      throw new Exception("Falta a regra max:10 para validar o rating");
    }
    
    if (!in_array("required", $reglasAwards)) {
      throw new Exception("Falta a regra required para validar os awards");
    }
    
    if (!in_array("integer", $reglasAwards)) {
      throw new Exception("Falta a regra integer para validar os premios");
    }
      
    if (!in_array("min:0", $reglasAwards)) {
      throw new Exception("Falta a regra min:0 para validar os premios");
    }
  }
}

class Model {
  public function getPrimaryKey() {
    if (isset($this->primaryKey)) {
      return $this->primaryKey;
    }
    return 'id';
  }
  
  public function getTable() {
    if (isset($this->table)) {
      return $this->table;
    }
    return null;
  }
  
  public function getTimestamps() {
    if (isset($this->timestamps)) {
      return $this->timestamps;
    }
    return true;
  }
  
  public function getGuarded() {
    if (isset($this->guarded)) {
      return $this->guarded;
    }
    return null;
  }
}

class Filme extends Model {
  public $rating;
  public $title;

  public static function all() {
    $peli1 = new Filme();
    $peli1->id = 1;
    $peli1->title = "Toy Story";
    $peli1->rating = 9.5;
    
    $peli2 = new Filme();
    $peli2->id = 2;
    $peli2->title = "Procurando Nemo";
    $peli2->rating = 8.2;
    
    $peli3 = new Filme();
    $peli3->id = 3;
    $peli3->title = "Carros";
    $peli3->rating = 7.0;
    
    return [$peli1, $peli2, $peli3];
  }
  
  public static function find($id) {
    $peliculas = Filme::all();
    return $peliculas[$id - 1];
  }
  
  public static function where($col, $operador, $value = null) {
    $consulta = new Consulta("filmes");
    $consulta->where($col, $operador, $value);
    
    return $consulta;
  }
  
  public static function orderBy($col, $order = "ASC") {
    $consulta = new Consulta("filmes");
    $consulta->orderBy($col, $order);
    
    return $consulta;
  }
  
  public function save() {
    global $request;
    global $pasePorSave;
    global $pasePorValidate;
    
    if (!$pasePorValidate) {
      throw new Exception("Seu código deve realizar a validação antes de chamar o método save");
    }
    
    $pasePorSave = true;
    
    if (!isset($this->title)) {
      throw new Exception("O filme que está sendo armazenado não tem título");
    }
    if ($this->title !== $request->title) {
      throw new Exception("O filme que está sendo armazenado não tem o título no request.");
    }
    
    if (!isset($this->rating)) {
      throw new Exception("O filme que esta sendo armazenado não não possui rating");
    }
    if ($this->rating !== $request->rating) {
      throw new Exception("O filme que está sendo armazenado não tem o rating no request");
    }
    
    if (!isset($this->awards)) {
      throw new Exception("O filme que está sendo armazenado não tem awards.");
    }
    if ($this->awards !== $request->awards) {
      throw new Exception("O filme que está sendo armazenado não tem os awards no request");
    }
    
    if (!isset($this->poster)) {
      throw new Exception("O filme que está sendo armazenado não tem poster");
    }

    if ($this->poster === "/public/" . $request->posterSecreto) {
	      throw new Exception("Você está atribuindo o caminho inteiro do arquivo na coluna de pôster e não apenas o nome. Não se esqueça de usar o basename antes");
    }
    
    if ($this->poster !== $request->posterSecreto) {
      throw new Exception("O filme que foi armazenado não tem atribuido o poster que foi armazenado");
    }
  }
  
  public function delete() {
  
  }
}

class Consulta {
  public $where = [];
  public $order = [];
  public $table;
  public $get = false;
  
  public function __construct($table) {
    $this->table = $table;
  }
  
  public function where($col, $operador, $value = null) {
    if ($value === null) {
      $value = $operador;
      $operador = "=";
    }
    
    $where = [$col, $operador, $value];
    $this->where[] = $where;
    return $this;
  }

  public function orderBy($col, $order = "ASC") {
    $this->order[] = [$col, $order];
    return $this;
  }
  
  public function get() {
    $this->get = true;
    return $this;
  }
}

class Request implements ArrayAccess {
  public $pasePorFile = false;
  public $pasePorStore = false;
  
  public function offsetExists($offset) {
    return isset($this->$offset);
  }

  public function offsetGet($offset) {
    return $this->$offset;
  }

  public function offsetSet($offset , $value) {
    $this->$offset = $value;
  }

  public function offsetUnset($offset) {
    unset($this->$offset);
  }
  
  public function file($name) {
    $this->pasePorFile = true;
    
    if (!is_string($name)) {
      throw new Exception("O método file deve receber uma string");
    }
    
    if ($name !== "poster") {
      throw new Exception("O input do formulário para enviar o arquivo se chama 'poster'.");
    }
    
    return $this;
  }
  
  public function store($name) {
    $this->pasePorStore = true;
    
    if (!$this->pasePorFile) {
    	throw new Exception("O método store deve ser executado depois do método file");
    }
    
    if (!is_string($name)) {
    	throw new Exception("O método store deve receber uma string");
    }
    
    if ($name !== "public") {
    	throw new Exception("Seu código deveria armazenar o arquivo na pasta public.");
    }
    
    return "/public/" . $this->posterSecreto;
  }
}