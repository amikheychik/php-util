<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Options;

abstract class AbstractOptions
  implements Options {
  /** @var Options */
  private $options;

  public function __construct(Options $options) {
    $this->options = $options;
  }

  public final function options(): array {
    return $this->options->options();
  }
}
