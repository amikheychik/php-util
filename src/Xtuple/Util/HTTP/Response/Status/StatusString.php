<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Status;

use Xtuple\Util\HTTP\Response\Status\Exception\StatusLineParsingException;
use Xtuple\Util\HTTP\Response\Status\RegEx\StatusLineRegEx;

final class StatusString
  extends AbstractStatus {
  /**
   * @throws StatusLineParsingException
   *
   * @param string $status
   */
  public function __construct(string $status) {
    $matches = (new StatusLineRegEx())->matches($status);
    if (empty($matches)) {
      throw new StatusLineParsingException();
    }
    parent::__construct(new StatusStruct(
      $matches['version'],
      (int) $matches['code'],
      $matches['reason']
    ));
  }
}
