<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\Exception;

use Xtuple\Util\Exception\AbstractThrowable;
use Xtuple\Util\Type\String\Message\Type\String\StringMessage;

final class ResponseParsingException
  extends AbstractThrowable {
  public function __construct(?\Throwable $previous = null) {
    parent::__construct(new StringMessage('Failed to parse an HTTP response'), $previous);
  }
}
