<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Message;

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\MapArgument;

final class MessageStruct
  implements Message {
  /** @var string */
  private $template;
  /** @var MapArgument */
  private $arguments;

  public function __construct(string $template, MapArgument $arguments) {
    $this->template = $template;
    $this->arguments = $arguments;
  }

  public function __toString(): string {
    return $this->format('en_US.UTF-8');
  }

  public function format(string $locale): string {
    $arguments = [];
    foreach ($this->arguments() as $argument) {
      $arguments["{{$argument->key()}}"] = (string) $argument;
    }
    return strtr($this->template, $arguments);
  }

  public function template(): string {
    return $this->template;
  }

  public function arguments(): MapArgument {
    return $this->arguments;
  }
}
