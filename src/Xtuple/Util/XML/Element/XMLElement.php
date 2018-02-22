<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element;

use Xtuple\Util\Type\String\Chars;
use Xtuple\Util\XML\Attribute\Collection\Map\MapXMLAttribute;
use Xtuple\Util\XML\Element\Collection\Sequence\ListXMLElement;

interface XMLElement
  extends Chars {
  public function __toString(): string;

  public function name(): string;

  public function attributes(?string $ns = null, bool $isPrefix = false): MapXMLAttribute;

  public function children(?string $xpath = null, ?string $ns = null, bool $isPrefix = false): ListXMLElement;

  /**
   * @return mixed
   */
  public function value();

  public function isEmpty(): bool;
}
