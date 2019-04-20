<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 7:25 PM
 */

namespace App\Utils;


class EntityUtils
{
  /**
   * Calls all the setters on $a with the values of the getters from $b then returns $a
   * Made this to save time cause there are a lot of fields here
   *
   * @param $a
   * @param $b
   *
   * @return mixed
   */
  public static function copyEntity($a, $b) {
    $methods = get_class_methods($a);

    foreach ($methods as $method) {
      if (strrpos($method, 'set')) {
        $getter = str_replace('set', 'get', $method);
        $a->$method($b->$getter);
      }
    }

    return $a;
  }
}
