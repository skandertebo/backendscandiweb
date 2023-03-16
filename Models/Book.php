<?php
class Book extends Product
{
  private $weight;
  public function __construct($id, $sku, $name, $price, $weight)
  {
    parent::__construct($id, $sku, $name, $price);
    $this->weight = $weight;
  }
  public function getWeight()
  {
    return $this->weight;
  }

  public function setWeight($weight)
  {
    $this->weight = $weight;
  }

  public static function loadProducts()
  {
    $result = parent::p_loadProducts("book");
    $data = array();
    while ($result && $row = $result->fetch_assoc()) {
      $data[] = get_object_vars(new Book($row["id"], $row["sku"], $row["name"], $row["price"], $row["weight"]));
    }
    return $data;
  }

  public function saveProduct()
  {
    $sql = "INSERT INTO book (sku, weight) VALUES ('$this->sku', $this->weight)";
    if (parent::p_saveProduct()) {
      $result = static::$con->query($sql);
      if ($result) {
        return true;
      } else {
        return false;
      }
    }
  }


}


?>