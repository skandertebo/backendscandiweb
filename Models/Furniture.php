<?php
//furniture has dimension (length, width, height)
class Furniture extends Product
{

  private $length;
  private $width;
  private $height;
  public function __construct($id, $sku, $name, $price, $length, $width, $height)
  {
    parent::__construct($id, $sku, $name, $price);
    $this->length = $length;
    $this->width = $width;
    $this->height = $height;
  }
  public function getLength()
  {
    return $this->length;
  }
  public function getWidth()
  {
    return $this->width;
  }
  public function getHeight()
  {
    return $this->height;
  }
  public function setLength($length)
  {
    $this->length = $length;
  }
  public function setWidth($width)
  {
    $this->width = $width;
  }
  public function setHeight($height)
  {
    $this->height = $height;
  }

  public static function loadProducts()
  {
    $result = parent::p_loadProducts("furniture");
    $data = array();
    while ($result && $row = $result->fetch_assoc()) {
      $data[] = get_object_vars(new Furniture($row["id"], $row["sku"], $row["name"], $row["price"], $row["length"], $row["width"], $row["height"]));
    }
    return $data;
  }

  public function saveProduct()
  {
    $sql = "INSERT INTO furniture (sku, length, width, height) VALUES ('$this->sku', $this->length, $this->width, $this->height)";
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