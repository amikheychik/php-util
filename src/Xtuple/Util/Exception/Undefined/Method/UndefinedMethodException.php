<?php declare(strict_types=1);

namespace Xtuple\Util\Exception\Undefined\Method;

use Xtuple\Util\Exception\AbstractThrowable;
use Xtuple\Util\Generics\Type\StrictType;
use Xtuple\Util\Type\String\Message\Message\MessageWithTokens;

final class UndefinedMethodException
  extends AbstractThrowable {
  public function __construct(string $type, string $method, int $code = 0) {
    parent::__construct(new MessageWithTokens('Method {type}::{method}() is undefined', [
      'type' => (new StrictType($type))->fqn(),
      'method' => $method,
    ]), null, null, $code);
  }
}
