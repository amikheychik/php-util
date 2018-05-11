<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Options\Header;

interface Header {
  /**
   * @return string[]
   */
  public function fields(): array;
}
