<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

final class DateTimeStruct
  implements DateTime {
  /** @var \DateTimeImmutable */
  private $date;

  public function __construct(\DateTimeImmutable $date) {
    $this->date = $date->setTimezone(new \DateTimeZone('UTC'));
  }

  public function __toString(): string {
    return $this->date->format('c');
  }

  public function serialize() {
    return $this->utc();
  }

  public function unserialize($serialized) {
    /** @noinspection PhpUnhandledExceptionInspection - data serialized in UTC, which should be parsed correctly */
    $this->date = new \DateTimeImmutable($serialized);
  }

  public function jsonSerialize() {
    return $this->date->format('Y-m-d\TH:i:s.000\Z');
  }

  public function utc(): string {
    return $this->date->format('Y-m-d\TH:i:s\Z');
  }

  public function compare(DateTime $to): int {
    /** @noinspection PhpUnhandledExceptionInspection - UTC format should be parsed without an exception */
    return $this->date <=> new \DateTimeImmutable($to->utc());
  }

  public function equals(DateTime $to): bool {
    return $this->compare($to) === 0;
  }
}
