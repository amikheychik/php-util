<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Exception;

use Xtuple\Util\Exception\AbstractThrowable;
use Xtuple\Util\HTTP\Message\Header\Header;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class HeaderMergeException
  extends AbstractThrowable {
  public function __construct(Header $origin, Header $append) {
    parent::__construct(new MessageWithTokens('Header {origin} can not be merged with header {header}', [
      'origin' => $origin->name(),
      'header' => $append->name(),
    ]));
  }
}
