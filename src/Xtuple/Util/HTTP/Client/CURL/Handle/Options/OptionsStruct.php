<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Options;

final class OptionsStruct
  implements Options {
  /** @var array */
  private $options;

  public function __construct(array $options) {
    $this->options = $options;
  }

  public function options(): array {
    return $this->options;
  }
}
