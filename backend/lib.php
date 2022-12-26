<?php
class DBImg {
  // CONSTRUCTOR - CONNECT TO DATABASE
  protected $pdo = null;
  protected $stmt = null;
  public $error = "";
  function __construct() {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // DESTRUCTOR - CLOSE CONNECTION
  function __destruct() {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // HELPER - RUN SQL QUERY
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // SAVE IMAGE TO DATABASE
  function save ($name, $data) {
    $this->query("REPLACE INTO `images` (`img_name`, `img_data`) VALUES (?,?)", [$name, $data]);
    return true;
  }

  // LOAD IMAGE FROM DATABASE
  // mode 1 = direct output
  // mode 2 = force download
  // mode 3 = base64 encode
  function load ($name, $mode=1) {
    // GET IMAGE
    $this->query("SELECT `img_data` FROM `images` WHERE `img_name`=?", [$name]);
    $img = $this->stmt->fetchColumn();
    if ($img==false) { return false; }

    // OUTPUT IMAGE
    $mime = mime_content_type($name);
    if ($mode==3) {
      echo "data:$mime;base64," . base64_encode($img);
    } else if ($mode==2) {
      header("Content-Type: application/octet-stream");
      header("Content-Transfer-Encoding: Binary"); 
      header("Content-disposition: attachment; filename=\"$name\""); 
      echo $img;
    } else {
      header("Content-type: $mime");
      echo $img;
    }
  }
}


// DATABASE SETTINGS
define("DB_HOST", "localhost");
define("DB_NAME", "pic_story");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

$_DBIMG = new DBImg();