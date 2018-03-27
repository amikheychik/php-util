<?php declare(strict_types=1);

namespace Xtuple\Util\RegEx\String;

use Xtuple\Util\RegEx\AbstractRegEx;
use Xtuple\Util\RegEx\RegExPattern;

final class NewLineRegEx
  extends AbstractRegEx {
  public function __construct() {
    parent::__construct(new RegExPattern('/(\r\n?|\n)/'));
  }
}
