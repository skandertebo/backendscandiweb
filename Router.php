<?php
class Router
{
  private $routes;
  private $baseRoute = '/backendTestScandiweb';
  public function __construct()
  {
    $routes = [];
  }
  public function addRoute($route, $method, $action)
  {
    $this->routes[$route][$method] = $action;
  }

  public function handleRequest($method, $fullPath)
  {
    $path = str_replace($this->baseRoute, '', $fullPath);
    $path = explode('?', $path)[0];


    foreach ($this->routes[$method] as $routePath => $action) {
      $pattern = preg_replace('#:([a-zA-Z0-9_]+)#', '([^/]+)', $routePath);
      $pattern = '#^' . $pattern . '$#';

      if (preg_match($pattern, $path, $matches)) {
        array_shift($matches);
        return $action(...$matches);
      }
    }

    header('HTTP/1.1 404 Not Found');
    return json_encode(['error' => 'Not found']);
  }

}
?>