<?php declare(strict_types=1);

namespace Xtuple\Util\Type\DateTime;

abstract class AbstractDateTime
  implements DateTime {
  /** @var DateTime */
  private $dateTime;

  public function __construct(DateTime $dateTime) {
    $this->dateTime = $dateTime;
  }

  public final function __toString(): string {
    return $this->dateTime->__toString();
  }

  public final function serialize() {
    return $this->dateTime->serialize();
  }

  public final function unserialize($serialized) {
    /** @noinspection PhpUnhandledExceptionInspection - serialized data must be correct */
    $this->dateTime = new DateTimeStruct(
      new \DateTimeImmutable($serialized)
    );
  }

  public final function jsonSerialize() {
    return $this->dateTime->jsonSerialize();
  }

  public final function utc(): string {
    return $this->dateTime->utc();
  }

  public final function compare(DateTime $to): int {
    return $this->dateTime->compare($to);
  }

  public final function equals(DateTime $to): bool {
    return $this->dateTime->equals($to);
  }
}
