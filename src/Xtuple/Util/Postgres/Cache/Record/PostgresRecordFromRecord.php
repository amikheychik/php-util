<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record;

use Xtuple\Util\Cache\Record\AbstractRecord;
use Xtuple\Util\Cache\Record\Record as CacheRecord;
use Xtuple\Util\Postgres\Cache\Key\PostgresKeyFromKey;
use Xtuple\Util\Postgres\Cache\Record\Value\ByteaStruct;
use Xtuple\Util\Type\DateTime\Timestamp\TimestampDateTime;

final class PostgresRecordFromRecord
  extends AbstractRecord
  implements Record {
  /** @var int */
  private $created;

  public function __construct(CacheRecord $record, ?int $created = null) {
    parent::__construct($record);
    $this->created = $created ?: time();
  }

  public function row(): array {
    return [
      ':cid' => (new PostgresKeyFromKey($this->key()))->id(),
      ':data' => !is_scalar($this->value())
        ? (new ByteaStruct($this->value()))->serialized()
        : $this->value(),
      ':expire' => $this->expiresAt()
        ? (new TimestampDateTime($this->expiresAt()))->seconds()
        : 0,
      ':created' => $this->created,
      ':serialized' => (int) !is_scalar($this->value()),
    ];
  }
}
