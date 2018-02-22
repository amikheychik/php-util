<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Collection\Map;

use Xtuple\Util\Collection\Map\Map;
use Xtuple\Util\Type\String\Chars;
use Xtuple\Util\XML\Attribute\XMLAttribute;

interface MapXMLAttribute
  extends Map, Chars {
  public function __toString(): string;

  public function getOptional(XMLAttribute $default): XMLAttribute;

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
