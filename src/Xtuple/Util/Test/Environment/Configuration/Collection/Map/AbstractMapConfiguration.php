<?php declare(strict_types=1);

namespace Xtuple\Util\Test\Environment\Configuration\Collection\Map;

use Xtuple\Util\Collection\Map\AbstractMap;

abstract class AbstractMapConfiguration
  extends AbstractMap
  implements MapConfiguration {
  public function __construct(MapConfiguration $configuration) {
    parent::__construct($configuration);
  }
}
