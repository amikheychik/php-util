<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\RegEx;

use Xtuple\Util\RegEx\AbstractRegEx;
use Xtuple\Util\RegEx\RegExPattern;

final class HeaderFieldsRegEx
  extends AbstractRegEx {
  public function __construct() {
    parent::__construct(new RegExPattern('/
      (?P<name>.*):   # Name
      \ (?P<value>.*) # Value
      \r\n            # CRLF
    /x'));
  }
}
