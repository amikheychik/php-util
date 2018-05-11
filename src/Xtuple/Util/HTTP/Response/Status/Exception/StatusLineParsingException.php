<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status\Exception;

use Xtuple\Util\Exception\AbstractThrowable;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

final class StatusLineParsingException
  extends AbstractThrowable {
  public function __construct() {
    parent::__construct(new StringMessage('Failed to parse HTTP response status line'));
  }
}
