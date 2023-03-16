<?php
require_once('Config.php');
abstract class Product
{
  protected $sku;
  protected $name;
  protected $price;
  protected $id;
  protected static $con;

  // call this method before using any class that extends this class
  public static function init()
  {
    static::$con = Config::getInstance()->getDbConnection();
  }

  public function __construct($id, $sku, $name, $price)
  {
    $this->id = $id;
    $this->sku = $sku;
    $this->name = $name;
    $this->price = $price;
  }

  public function getSku()
  {
    return $this->sku;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function setSku($sku)
  {
    $this->sku = $sku;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setPrice($price)
  {
    $this->price = $price;
  }

  protected static function p_loadProducts($type)
  {
    $sql = "SELECT $type.*, product.id, product.name, product.price FROM $type inner JOIN product on $type.sku = product.sku ";
    $result = static::$con->query($sql);
    return $result;
  }

  protected function p_saveProduct()
  {
    $sql = "INSERT INTO product (sku, name, price) VALUES ('$this->sku', '$this->name', $this->price)";
    $result = static::$con->query($sql);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public static function deleteProduct($sku)
  {
    $sql = "DELETE FROM product WHERE sku = '$sku'";
    $result = static::$con->query($sql);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public static function massDelete($ids)
  {
    $idsSet = "(";
    $ids = explode(",", $ids);
    foreach ($ids as $id) {
      $idsSet .= "'$id',";
    }
    $idsSet = rtrim($idsSet, ",");
    $idsSet .= ")";
    $sql = "DELETE FROM product WHERE sku IN $idsSet";
    $result = static::$con->query($sql);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

}

?>