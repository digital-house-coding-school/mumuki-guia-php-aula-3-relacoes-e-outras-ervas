$pasePorView = false;

$id = null;

function view($route, $vac = []) {
  global $pasePorView;
  global $id;
  
  $pasePorView = true;
  
  if ($route == "listarFilmes") {
    if (count($vac) !== 1) {
      throw new Exception('você deve compartilhar uma variável (e somente uma) com a view.');
    }
    
    $consulta = array_shift($vac);
    
    if ($consulta instanceof Consulta == false) {
      
      throw new Exception("Você está utilizando o paginate");
    }
    
    if ($consulta->table != "filmes") {
      throw new Exception("Você está fazendo uma consulta à tabela de filmes?");
    }
    
    if ($consulta->paginate == 0) {
      throw new Exception("Você chamou o método paginate?");
    }
    
    if ($consulta->paginate != 10) {
      throw new Exception("Neste caso queremos que a paginação exiba 10 filmes por vez.");
    }
    
    
  } else {
    throw new Exception("A view a ser retornada deve ser a listarFilmes (listarFilmes.blade.php");
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
  
  public static function paginate($num) {
    $consulta = new Consulta("filmes");
    $consulta->paginate($num);
    
    return $consulta;
  }
}

class Consulta {
  public $where = [];
  public $order = [];
  public $table;
  public $get = false;
  public $paginate = 0;
  
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
  
  public function paginate($num) {
    $this->paginate = $num;
    return $this;
  }
  
  public function get() {
    $this->get = true;
    return $this;
  }
}