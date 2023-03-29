<?php
class ProductController
{
  public function index()
  {
    $dvd = Dvd::loadProducts();
    $book = Book::loadProducts();
    $furniture = Furniture::loadProducts();
    echo json_encode(array("dvd" => $dvd, "book" => $book, "furniture" => $furniture));
  }

  public function store()
  {
    if (empty($_POST['type']) || empty($_POST['sku']) || empty($_POST['name']) || empty($_POST['price'])) {
      die("Type, sku, name and price are required");
    }
    $specialProps = $_POST;
    $product = ProductFactory::create(-1, $_POST['type'], $_POST['sku'], $_POST['name'], $_POST['price'], $specialProps);
    if ($product->saveProduct()) {
      http_response_code(201);
      echo json_encode(array("message" => "Success"));
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Error"));
    }
  }

  public function delete($sku)
  {
    if (Product::deleteProduct($sku)) {
      http_response_code(200);
      echo json_encode(array("message" => "Success"));
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Error"));
    }
  }

  public function massDelete()
  {
    if (empty($_GET['ids'])) {
      die("Id is required");
    }
    if (Product::massDelete($_GET['ids'])) {
      http_response_code(200);
      echo json_encode(array("message" => "Success"));
    } else {
      http_response_code(400);
      echo json_encode(array("message" => "Error"));
    }
  }

}
?>