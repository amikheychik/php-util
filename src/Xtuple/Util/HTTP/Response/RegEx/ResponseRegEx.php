<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\RegEx;

use Xtuple\Util\RegEx\AbstractRegEx;
use Xtuple\Util\RegEx\RegExPattern;

final class ResponseRegEx
  extends AbstractRegEx {
  public function __construct() {
    parent::__construct(new RegExPattern('/
      ^(
        (?P<status>                    # Status-Line
          HTTP\/(?P<version>\d\.\d)     # HTTP-Version
          \ (?P<code>\d{3})             # Status-Code
          \ (?P<reason>[[:print:]]+)    # Reason-Phrase
        )\\r\\n   
        (?P<headers>(?:(?:.*):(?:.*)\\r\\n)*)  # Headers
        \\r\\n                          # CRLF
      ){1}?
      (?P<body>(?:[\s\S]*))           # Message Body
    /x'));
  }
}
