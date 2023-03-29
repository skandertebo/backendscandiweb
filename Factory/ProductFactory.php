<?php
class ProductFactory
{

  private static $product_types = [
    'book' => Book::class,
    'dvd' => Dvd::class,
    'furniture' => Furniture::class
  ];


  public static function create($id, $type, $sku, $name, $price, $specialProps)
  {
    return new ProductFactory::$product_types[$type]($id, $sku, $name, $price, $specialProps);
  }
}


?>