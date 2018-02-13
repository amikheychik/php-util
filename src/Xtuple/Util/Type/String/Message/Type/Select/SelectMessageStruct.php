<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Select;

use Xtuple\Util\Type\String\Message\Argument\Collection\Set\ArraySetArgument;
use Xtuple\Util\Type\String\Message\Argument\Collection\Set\SetArgument;
use Xtuple\Util\Type\String\Message\Message\Message;

final class SelectMessageStruct
  implements SelectMessage {
  /** @var string */
  private $value;
  /** @var Message */
  private $default;
  /** @var SetArgument */
  private $options;
  /** @var SetArgument */
  private $arguments;

  public function __construct(string $value, Message $default, SetArgument $options, ?SetArgument $arguments = null) {
    $this->value = $value;
    $this->default = $default;
    $this->options = $options;
    $this->arguments = $arguments ?: new ArraySetArgument();
  }

  public function __toString(): string {
    return $this->format('en_US.UTF-8');
  }

  public function format(string $locale): string {
    $options = [];
    foreach ($this->options as $key => $option) {
      $options[] = "{$key}{{$option}}";
    }
    $options[] = "other{{$this->default}}";
    $arguments = [
      'this' => $this->value,
    ];
    foreach ($this->arguments as $key => $argument) {
      $arguments[$key] = (string) $argument;
    }
    return \MessageFormatter::formatMessage($locale, strtr('{this, select, {options}}', [
      '{options}' => implode(' ', $options),
    ]), $arguments);
  }

  public function template(): string {
    return $this->default->template();
  }

  public function value(): string {
    return $this->value;
  }

  public function default(): Message {
    return $this->default;
  }

  public function options(): SetArgument {
    return $this->options;
  }

  public function arguments(): SetArgument {
    return $this->arguments;
  }
}
