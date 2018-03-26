<?php declare(strict_types=1);

namespace Xtuple\Util\Cache;

use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Cache\Record\Record;

interface Cache
  extends \Serializable {
  /**
   * @generic
   *
   * @return Record - inserted record object; may be different (type) from passed into method.
   *
   * @param Record $record
   */
  public function insert(Record $record);

  /**
   * @generic
   *
   * @return Record|null - record object type may be different and depend on cache implementation or null if not found.
   *
   * @param Key $key
   */
  public function find(Key $key);

  public function delete(Key $key): void;

  public function clear(): void;

  public function isEmpty(): bool;
}
