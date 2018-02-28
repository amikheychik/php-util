<?php declare(strict_types=1);

namespace Xtuple\Util\Type\UUID;

abstract class AbstractUUID
  implements UUID {
  /** @var UUID */
  private $uuid;

  public function __construct(UUID $uuid) {
    $this->uuid = $uuid;
  }

  public final function __toString(): string {
    return $this->uuid->__toString();
  }

  public final function urn(): string {
    return $this->uuid->urn();
  }

  public final function equals(UUID $uuid): bool {
    return $this->uuid->equals($uuid);
  }
}
