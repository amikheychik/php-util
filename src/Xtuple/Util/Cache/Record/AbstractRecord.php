<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Record;

use Xtuple\Util\Type\DateTime\DateTime;

abstract class AbstractRecord
  implements Record {
  /** @var Record */
  private $record;

  public function __construct(Record $record) {
    $this->record = $record;
  }

  public final function key() {
    return $this->record->key();
  }

  public final function value() {
    return $this->record->value();
  }

  public final function expiresAt(): ?DateTime {
    return $this->record->expiresAt();
  }
}
