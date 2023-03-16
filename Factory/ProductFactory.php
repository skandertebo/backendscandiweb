<?php
class ProductFactory
{
  public static function create($type, $sku, $name, $price, $specialProps)
  {
    if ($type == 'book') {
      return new Book($sku, $name, $price, $specialProps['weight']);
    } elseif ($type == 'dvd') {
      return new Dvd($sku, $name, $price, $specialProps['size']);
    } else {
      return new Furniture($sku, $name, $price, $specialProps['height'], $specialProps['width'], $specialProps['length']);
    }
  }
}


?>