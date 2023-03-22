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
    $specialProps = array();
    if ($_POST['type'] == "dvd") {
      if (empty($_POST['size'])) {
        die("Size is required");
      }
      $specialProps['size'] = $_POST['size'];
    } else if ($_POST['type'] == "book") {
      if (empty($_POST['weight'])) {
        die("Weight is required");
      }
      $specialProps['weight'] = $_POST['weight'];
    } else if ($_POST['type'] == "furniture") {
      if (empty($_POST['height']) || empty($_POST['width']) || empty($_POST['length'])) {
        die("Height, Width and Length are required");
      }
      $specialProps['height'] = $_POST['height'];
      $specialProps['width'] = $_POST['width'];
      $specialProps['length'] = $_POST['length'];
    }
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