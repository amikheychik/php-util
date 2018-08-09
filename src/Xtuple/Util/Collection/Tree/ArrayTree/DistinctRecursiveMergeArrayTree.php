<?php declare(strict_types=1);

namespace Xtuple\Util\Collection\Tree\ArrayTree;

final class DistinctRecursiveMergeArrayTree
  extends AbstractArrayTree {
  public function __construct(array... $arrays) {
    $data = $arrays[0];
    for ($i = 1, $size = count($arrays); $i < $size; $i++) {
      foreach ($arrays[$i] as $key => &$value) {
        if (is_array($value)
          && isset($data[$key])
          && is_array($data[$key])
        ) {
          $data[$key] = (new DistinctRecursiveMergeArrayTree($data[$key], $value))->data();
        }
        else {
          $data[$key] = $value;
        }
      }
      unset($value);
    }
    parent::__construct($data);
  }
}
