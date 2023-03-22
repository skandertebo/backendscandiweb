<?php
require_once('Router.php');
class Application
{
  private static $instance;
  private $router = null;

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {


    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Role ,Content-Type,Origin, accept');
    header('Access-Control-Allow-Credentials:true');
    header("Content-Type: application/json");


    function autoloadModel($className)
    {
      $filename = "Models/" . $className . ".php";
      if (is_readable($filename)) {
        require $filename;
      }
    }
    function autoloadController($className)
    {
      $filename = "Controllers/" . $className . ".php";
      if (is_readable($filename)) {
        require $filename;
      }
    }

    function autoLoadFactory($className)
    {
      $filename = "Factory/" . $className . ".php";
      if (is_readable($filename)) {
        require $filename;
      }
    }

    spl_autoload_register('autoloadModel');
    spl_autoload_register('autoloadController');
    spl_autoload_register('autoLoadFactory');

    $this->router = new Router();
  }
  public function run()
  {

    Product::init();

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers: Role ,Content-Type,Origin, accept');
      http_response_code(204);
      exit;
    }

    $productController = new ProductController();

    $this->router->addRoute('GET', '/products', [$productController, 'index']);
    $this->router->addRoute('POST', '/products', [$productController, 'store']);
    $this->router->addRoute('DELETE', '/massDeleteProducts', [$productController, 'massDelete']);
    $this->router->addRoute('DELETE', '/products/:sku', [$productController, 'delete']);
    $this->router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
  }
}
?>