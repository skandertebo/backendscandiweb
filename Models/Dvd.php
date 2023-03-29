<?php
class Dvd extends Product
{
  private $size;
  public function __construct($id, $sku, $name, $price, $specialProps)
  {
    if(empty($specialProps['size']))
    {
      die("Size is required");
    }
    $size = $specialProps['size'];
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
      $specialProps = array(
        "size" => $row["size"]
      );
      $data[] = get_object_vars(new Dvd($row["id"], $row["sku"], $row["name"], $row["price"], $specialProps));
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