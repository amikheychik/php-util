<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record\Value;

final class ByteaStruct
  implements Bytea {
  /** @var string */
  private $value;

  public function __construct($value) {
    $this->value = $value;
  }

  public function serialized(): string {
    return base64_encode(serialize($this->value));
  }

  public function value() {
    return $this->value;
  }
}
