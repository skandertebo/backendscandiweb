<?php
class ProductFactory
{
  public static function create($id, $type, $sku, $name, $price, $specialProps)
  {
    if ($type == 'book') {
      return new Book($id, $sku, $name, $price, $specialProps['weight']);
    } elseif ($type == 'dvd') {
      return new Dvd($id, $sku, $name, $price, $specialProps['size']);
    } else {
      return new Furniture($id, $sku, $name, $price, $specialProps['height'], $specialProps['width'], $specialProps['length']);
    }
  }
}


?>