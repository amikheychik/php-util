<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Record;

use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Type\DateTime\DateTime;

final class RecordStruct
  implements Record {
  /** @var string */
  private $key;
  /** @var mixed */
  private $value;
  /** @var DateTime|null */
  private $expiresAt;

  public function __construct(Key $key, $value, ?DateTime $expiresAt = null) {
    $this->key = $key;
    $this->value = $value;
    $this->expiresAt = $expiresAt;
  }

  public function key(): Key {
    return $this->key;
  }

  public function value() {
    return $this->value;
  }

  public function expiresAt(): ?DateTime {
    return $this->expiresAt;
  }
}
