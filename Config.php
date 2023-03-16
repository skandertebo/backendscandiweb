<?php
class Config
{
  private static $instance;
  private $con;

  public function getDbConnection()
  {
    return $this->con;
  }
  public $mode = 'DEV';

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {

    $mode = "PROD";

    if ($mode == 'DEV') {
      $this->con = new mysqli("localhost", "root", "root", "scandiwebtest");
    } else if ($mode == 'PROD') {
      $this->con = new mysqli("localhost", "id20460491_scandiwebtestdbskandertebo", "ipq=K*?K>pV8_9WJ", "id20460491_scandiwebtestdb");
    } else {
      die("Invalid mode");
    }

    if ($this->con->connect_error) {
      die("Connection failed: " . $this->con->connect_error);
    }
  }
}

?>