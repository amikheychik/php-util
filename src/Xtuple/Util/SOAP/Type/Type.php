<?php declare(strict_types=1);

namespace Xtuple\Util\SOAP\Type;

interface Type {
  public function encoding(): int;

  public function name(): string;

  public function namespace(): string;
}
