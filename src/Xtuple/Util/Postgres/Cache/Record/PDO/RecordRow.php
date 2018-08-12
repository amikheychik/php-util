<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Cache\Record\PDO;

use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Cache\Record\Record;
use Xtuple\Util\Cache\Record\RecordStruct;
use Xtuple\Util\Postgres\Cache\Record\Value\ByteaSerialized;
use Xtuple\Util\Postgres\Query\Result\Row\AbstractRow;
use Xtuple\Util\Type\DateTime\DateTimeTimestampSeconds;

final class RecordRow
  extends AbstractRow {
  /**
   * @throws \Throwable
   *
   * @param Key $key
   *
   * @return Record
   */
  public function record(Key $key): Record {
    $data = stream_get_contents($this->get('data'));
    return new RecordStruct(
      $key,
      $this->get('serialized')
        ? (new ByteaSerialized($data))->value()
        : $data,
      $this->get('expire')
        ? new DateTimeTimestampSeconds($this->get('expire'))
        : null
    );
  }
}
