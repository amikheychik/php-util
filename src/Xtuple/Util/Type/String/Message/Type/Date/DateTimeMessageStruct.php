<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Message\Type\Date;

use Xtuple\Util\Type\DateTime\DateTime;
use Xtuple\Util\Type\String\Message\Message\AbstractScalarMessage;

final class DateTimeMessageStruct
  extends AbstractScalarMessage
  implements DateTimeMessage {
  /** @var DateTime */
  private $dateTime;
  /** @var string */
  private $format;

  public function __construct(DateTime $dateTime, string $format) {
    parent::__construct($format);
    $this->dateTime = $dateTime;
    $this->format = $format;
  }

  public function format(string $locale): string {
    return (new \DateTimeImmutable($this->dateTime->utc()))->format($this->format);
  }

  public function timezone(?string $timezone = null): string {
    return (new \DateTimeImmutable($this->dateTime->utc()))->setTimezone(
      new \DateTimeZone($timezone ?: ini_get('date.timezone'))
    )->format($this->format);
  }
}
