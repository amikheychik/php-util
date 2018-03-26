<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Cache\Memory;

use Xtuple\Util\Cache\Cache;
use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Cache\Record\Record;
use Xtuple\Util\Collection\Tree\ArrayTree\ArrayTree;
use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\Type\DateTime\DateTimeString;

final class MemoryCache
  implements Cache {
  /** @var string */
  private $bucket;
  /** @var DateTimeString */
  private $now;

  public function __construct(string $bucket) {
    $this->bucket = $bucket;
    $this->now = new DateTimeString('now');
  }

  public function serialize() {
    return $this->bucket;
  }

  public function unserialize($serialized) {
    $this->__construct($serialized);
  }

  public function find(Key $key): ?Record {
    if ($record = $this->cache()->get((new MemoryCacheKey($this->bucket, $key))->key())) {
      if ($record instanceof Record) {
        return $record;
      }
    }
    return null;
  }

  public function clear(): void {
    $this->cache()->set([$this->bucket], null);
  }

  public function delete(Key $key): void {
    $this->cache()->remove((new MemoryCacheKey($this->bucket, $key))->key());
  }

  public function insert(Record $record): Record {
    if ($record->expiresAt() === null
      || $record->expiresAt()->compare($this->now) > 0) {
      $this->cache()->set((new MemoryCacheKey($this->bucket, $record->key()))->key(), $record);
    }
    return $record;
  }

  public function isEmpty(): bool {
    return empty($this->cache()->get([$this->bucket]));
  }

  private function cache(): Tree {
    static $cache;
    if ($cache === null) {
      $cache = new ArrayTree();
    }
    return $cache;
  }
}
