$pasePorView = false;
$pasePorRedirect = false;
$pasePorSave = false;
$pasePorDelete = false;

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
    throw new Exception("Depois de remover o filme  você deve redirecionar para a URL /filmes/listar");
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
      throw new Exception("Você precisa validar os três campos, por isso o array deveria ter 3 posições");
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
      throw new Exception("As regras para validar o title devem estar em formato de string");
    }
    if (!is_string($reglas["rating"])) {
      throw new Exception("As regras para validar o rating devem estar em formato de string");
    }
    if (!is_string($reglas["awards"])) {
      throw new Exception("As regras para validar o awards devem estar em formato de string");
    }
    
    $reglasTitle = explode("|", $reglas["title"]);
    $reglasRating = explode("|", $reglas["rating"]);
    $reglasAwards = explode("|", $reglas["awards"]);
    
    if (count($reglasTitle) != 3) {
      throw new Exception("Deveria ter 3 regras para validar o titulo separados pelo caracter |");
    }
    
    if (count($reglasRating) != 4) {
      throw new Exception("Deveria ter 4 regras para validar o rating separados pelo caracter |");
    }
    
     if (count($reglasAwards) != 3) {
      throw new Exception("Deveria ter 3 regras para validar o awards separados pelo caracter |");
    }
    
    if (!in_array("required", $reglasTitle)) {
      throw new Exception("Falta a regra required para validar o titulo");
    }
    
    if (!in_array("max:255", $reglasTitle)) {
      throw new Exception("Falta a regra max:255 para validar o titulo");
    }
    
    if (!in_array("unique:movies,title", $reglasTitle)) {
      throw new Exception("Falta a regra unique:movies,title para validar o titulo");
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
      throw new Exception("Falta a regra integer para validar os awards");
    }
      
    if (!in_array("min:0", $reglasAwards)) {
      throw new Exception("Falta a regra min:0 para validar os awards");
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
    $peli2->title = "Buscando a Nemo";
    $peli2->rating = 8.2;
    
    $peli3 = new Filme();
    $peli3->id = 3;
    $peli3->title = "Cars";
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

  }
  
  public function delete() {
    global $pasePorDelete;
    global $id;
    
    $pasePorDelete = true;
    
    if (!isset($this->id)) {
      throw new Exception("Verifique se você está usando o método find.");
    }
    
    if ($this->id !== $id) {
      throw new Exception("você não está removendo o mesmo filme que está vindo no formulário");
    }
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
}