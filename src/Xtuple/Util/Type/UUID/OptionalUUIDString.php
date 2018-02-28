<?php declare(strict_types=1);

namespace Xtuple\Util\Type\UUID;

final class OptionalUUIDString {
  /** @var null|UUID */
  private $uuid;

  public function __construct(?string $uuid) {
    try {
      $this->uuid = $uuid ? new UUIDString($uuid) : null;
    }
    catch (\Throwable $e) {
      $this->uuid = null;
    }
  }

  public function value(): ?UUID {
    return $this->uuid;
  }

  public function isPresent(): bool {
    return $this->uuid !== null;
  }
}
