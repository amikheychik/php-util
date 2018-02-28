<?php declare(strict_types=1);

namespace Xtuple\Util\Type\UUID;

use Xtuple\Util\Exception\Exception;

final class UUIDString
  implements UUID {
  /** @var string */
  private $uuid;

  /**
   * @throws \Throwable
   *
   * @param string $uuid
   */
  public function __construct(string $uuid) {
    $pattern = '/^(urn:uuid:)?([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})$/';
    if (!preg_match($pattern, strtolower($uuid), $matches)) {
      throw new Exception('String {uuid} is not a valid UUID', [
        'uuid' => $uuid,
      ]);
    }
    $this->uuid = $uuid;
  }

  public function __toString(): string {
    return $this->uuid;
  }

  public function urn(): string {
    return "urn:uuid:{$this->uuid}";
  }

  public function equals(UUID $uuid): bool {
    return (string) $this === (string) $uuid;
  }
}
