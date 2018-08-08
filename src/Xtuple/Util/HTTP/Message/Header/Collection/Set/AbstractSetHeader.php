<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use Xtuple\Util\Collection\Set\AbstractSet;

abstract class AbstractSetHeader
  extends AbstractSet
  implements SetHeader {
  public function __construct(SetHeader $headers) {
    parent::__construct($headers);
  }
}
