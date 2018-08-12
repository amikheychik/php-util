<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record\Value;

final class ByteaSerialized
  implements Bytea {
  /** @var string */
  private $serialized;

  public function __construct(string $serialized) {
    $this->serialized = $serialized;
  }

  public function serialized(): string {
    return $this->serialized;
  }

  /**
   * @return mixed
   */
  public function value() {
    return unserialize(base64_decode($this->serialized), ['allowed_classes' => true]);
  }
}
