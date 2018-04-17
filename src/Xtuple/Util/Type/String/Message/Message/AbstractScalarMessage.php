<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message;

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Argument\Collection\Map\MapArgument;

abstract class AbstractScalarMessage
  implements Message {
  /** @var string */
  private $template;

  public function __construct(string $template) {
    $this->template = $template;
  }

  public final function __toString(): string {
    return $this->format('en_US.UTF-8');
  }

  public final function template(): string {
    return $this->template;
  }

  public final function arguments(): MapArgument {
    /** @noinspection PhpUnhandledExceptionInspection - no arguments passed */
    return new ArrayMapArgument();
  }
}
