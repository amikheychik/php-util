<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Attribute\Optional;

use Xtuple\Util\XML\Attribute\XMLAttributeStruct;

final class OptionalXMLAttributeStruct
  extends AbstractOptionalXMLAttribute {
  /**
   * @param string     $name
   * @param null|mixed $value
   */
  public function __construct(string $name, $value = null) {
    parent::__construct(new XMLAttributeStruct($name, $value));
  }
}
