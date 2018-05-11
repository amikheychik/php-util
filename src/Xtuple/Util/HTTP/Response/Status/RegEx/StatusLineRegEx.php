<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status\RegEx;

use Xtuple\Util\RegEx\AbstractRegEx;
use Xtuple\Util\RegEx\RegExPattern;

final class StatusLineRegEx
  extends AbstractRegEx {
  public function __construct() {
    parent::__construct(new RegExPattern('/
      ^HTTP\/(?P<version>\d\.\d)   # HTTP-Version
      \ (?P<code>\d{3})            # Status-Code
      \ (?P<reason>[[:print:]]+)   # Reason-Phrase
    /x'));
  }
}
