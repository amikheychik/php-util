<?php declare(strict_types=1);

namespace Xtuple\Util\Test\Environment\Configuration\Collection\Map;

use Xtuple\Util\Collection\Map\ArrayMap\AbstractArrayMap;
use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\Generics\Type\StrictType;
use Xtuple\Util\Test\Environment\Configuration\Configuration;

final class ArrayMapConfiguration
  extends AbstractArrayMap
  implements MapConfiguration {
  /**
   * @throws Throwable
   *
   * @param iterable $configurations
   */
  public function __construct(iterable $configurations = []) {
    $type = new StrictType(Configuration::class);
    $elements = [];
    foreach ($configurations as $configuration) {
      $key = get_class($configuration);
      if ($interfaces = class_implements($configuration)) {
        $key = array_shift($interfaces);
      }
      $elements[$key] = $type->cast($configuration);
    }
    parent::__construct($elements);
  }
}
