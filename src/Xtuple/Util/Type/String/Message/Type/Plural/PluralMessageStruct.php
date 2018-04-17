<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Plural;

use Xtuple\Util\Type\String\Message\Argument\Collection\Map\ArrayMapArgument;
use Xtuple\Util\Type\String\Message\Argument\Collection\Map\MapArgument;
use Xtuple\Util\Type\String\Message\Message\Message;
use Xtuple\Util\Type\String\Message\Type\Number\NumberMessage;

final class PluralMessageStruct
  implements PluralMessage {
  /** @var NumberMessage */
  private $count;
  /** @var Message */
  private $plural;
  /** @var null|Message */
  private $singular;
  /** @var MapArgument */
  private $plurals;
  /** @var MapArgument */
  private $arguments;
  /** @var null|float */
  private $offset;

  public function __construct(NumberMessage $count, Message $plural, ?Message $singular, ?MapArgument $plurals = null,
                              ?MapArgument $arguments = null, ?float $offset = null) {
    $this->count = $count;
    $this->plural = $plural;
    $this->singular = $singular;
    /** @noinspection PhpUnhandledExceptionInspection - no arguments passed */
    $this->plurals = $plurals ?: new ArrayMapArgument();
    /** @noinspection PhpUnhandledExceptionInspection - no arguments passed */
    $this->arguments = $arguments ?: new ArrayMapArgument();
    $this->offset = $offset;
  }

  public function __toString(): string {
    return $this->format('en_US.UTF-8');
  }

  public function format(string $locale): string {
    $formats = [];
    foreach ($this->plurals as $condition => $format) {
      $formats[] = "{$condition}{{$format}}";
    }
    $formats = array_merge(array_filter([
      $this->offset ? "offset:{$this->offset}" : null,
    ]), $formats, array_filter([
      $this->singular ? "one{{$this->singular}}" : '',
      "other{{$this->plural}}",
    ]));
    $arguments = [
      'self' => $this->count->template(),
    ];
    foreach ($this->arguments as $argument) {
      $arguments[$argument->key()] = (string) $argument;
    }
    return \MessageFormatter::formatMessage($locale, strtr('{self, plural, {formats}}', [
      '{formats}' => strtr(implode(' ', $formats), [
        '{count}' => $this->offset
          ? (($offset = $this->arguments->get('offset')) ? $offset->format($locale) : '#')
          : $this->count->format($locale),
      ]),
    ]), $arguments);
  }

  public function template(): string {
    return $this->plural->template();
  }

  public function count(): NumberMessage {
    return $this->count;
  }

  public function plural(): Message {
    return $this->plural;
  }

  public function singular(): ?Message {
    return $this->singular;
  }

  public function plurals(): MapArgument {
    return $this->plurals;
  }

  public function arguments(): MapArgument {
    return $this->arguments;
  }

  public function offset(): ?float {
    return $this->offset;
  }
}
