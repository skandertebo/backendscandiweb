<?php
class Dvd extends Product
{
  private $size;
  public function __construct($id, $sku, $name, $price, $size)
  {
    parent::__construct($id, $sku, $name, $price);
    $this->size = $size;
  }
  public function getSize()
  {
    return $this->size;
  }
  public function setSize($size)
  {
    $this->size = $size;
  }
  public static function loadProducts()
  {
    $result = parent::p_loadProducts("dvd");
    $data = array();
    while ($result && $row = $result->fetch_assoc()) {
      $data[] = get_object_vars(new Dvd($row["id"], $row["sku"], $row["name"], $row["price"], $row["size"]));
    }
    return $data;
  }

  public function saveProduct()
  {
    $sql = "INSERT INTO dvd (sku, size) VALUES ('$this->sku', $this->size)";
    if (parent::p_saveProduct()) {
      $result = static::$con->query($sql);
      if ($result) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }


}
?>