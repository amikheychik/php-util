<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Configuration;

interface Configuration {
  public function debug(): bool;

  public function timeout(): float;
}
