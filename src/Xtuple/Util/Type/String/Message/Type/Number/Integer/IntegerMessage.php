<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Number\Integer;

use Xtuple\Util\Type\String\Message\Type\Number\AbstractNumberMessage;

final class IntegerMessage
  extends AbstractNumberMessage {
  /** @var int */
  private $value;

  public function __construct(int $value) {
    parent::__construct((string) $value);
    $this->value = $value;
  }

  public function format(string $locale): string {
    $formatter = new \NumberFormatter($locale, \NumberFormatter::DEFAULT_STYLE);
    return $formatter->format($this->value);
  }
}
