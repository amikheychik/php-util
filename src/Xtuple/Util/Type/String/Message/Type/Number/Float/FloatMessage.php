<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Float;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberMessage;

final class FloatMessage
  extends AbstractNumberMessage {
  /** @var float */
  private $value;
  /** @var null|string */
  private $format;

  public function __construct(float $value, ?string $format = null) {
    parent::__construct((string) $value);
    $this->value = $value;
    $this->format = $format;
  }

  public function format(string $locale): string {
    $formatter = $this->format
      ? new \NumberFormatter($locale, \NumberFormatter::PATTERN_DECIMAL, $this->format)
      : new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
    return $formatter->format($this->value);
  }
}
