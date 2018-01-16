<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\XML\Attribute\XMLAttribute;

interface MapXMLAttribute
  extends Map {
  /**
   * @param string $name
   *
   * @return XMLAttribute|null
   */
  public function get(string $name);

  /**
   * @return XMLAttribute|null
   */
  public function current();
}
