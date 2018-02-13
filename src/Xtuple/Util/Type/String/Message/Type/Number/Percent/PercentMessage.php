<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Percent;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberMessage;

final class PercentMessage
  extends AbstractNumberMessage {
  /** @var float */
  private $value;

  public function __construct(float $value) {
    parent::__construct((string) $value);
    $this->value = $value;
  }

  public function format(string $locale): string {
    $formatter = new \NumberFormatter($locale, \NumberFormatter::PERCENT);
    return $formatter->format($this->value);
  }
}
