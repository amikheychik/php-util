<?php declare(strict_types=1);

namespace Xtuple\Util\XML\Element\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\Sequence;
use Xtuple\Util\Type\String\Chars;
use Xtuple\Util\XML\Element\XMLElement;

interface ListXMLElement
  extends Sequence, Chars {
  public function __toString(): string;

  /**
   * @param int $key
   *
   * @return XMLElement|null
   */
  public function get(int $key);

  /**
   * @return XMLElement|null
   */
  public function current();
}
