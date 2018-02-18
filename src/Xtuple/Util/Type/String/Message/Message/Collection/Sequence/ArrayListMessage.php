<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message\Collection\Sequence;

use Xtuple\Util\Collection\Sequence\ArrayList\StrictType\AbstractStrictlyTypedArrayList;
use Xtuple\Util\Type\String\Message\Message\Message;

final class ArrayListMessage
  extends AbstractStrictlyTypedArrayList
  implements ListMessage {
  /**
   * @param Message[]|iterable $elements
   */
  public function __construct(iterable $elements = []) {
    parent::__construct(Message::class, $elements);
  }
}
