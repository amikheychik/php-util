<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Attribute\XMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;

interface XMLElement {
  public function name(): string;

  public function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute;

  public function attribute(string $name, ?string $ns = null, bool $isPrefix = false): XMLAttribute;

  public function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement;

  public function xml(): string;

  /**
   * @return mixed
   */
  public function value();
}
