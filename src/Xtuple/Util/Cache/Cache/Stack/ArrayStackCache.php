<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Cache\Stack;

use Xtuple\Util\Cache\Cache;
use Xtuple\Util\Cache\Key\Key;
use Xtuple\Util\Cache\Record\Record;

final class ArrayStackCache
  implements StackCache {
  /** @var Cache[] */
  private $caches;

  public function __construct(Cache... $caches) {
    $this->caches = $caches;
  }

  public function serialize() {
    return serialize($this->caches);
  }

  public function unserialize($serialized) {
    $this->caches = unserialize($serialized, ['allowed_classes' => true]);
  }

  public function insert(Record $record) {
    foreach ($this->caches as $cache) {
      $cache->insert($record);
    }
    return $record;
  }

  public function find(Key $key) {
    $lookup = [];
    foreach ($this->caches as $i => $cache) {
      if ($record = $cache->find($key)) {
        foreach (array_reverse($lookup) as $j) {
          $this->caches[$j]->insert($record);
        }
        return $record;
      }
      $lookup[] = $i;
    }
    return null;
  }

  public function delete(Key $key): void {
    foreach ($this->caches as $cache) {
      $cache->delete($key);
    }
  }

  public function clear(): void {
    foreach ($this->caches as $cache) {
      $cache->clear();
    }
  }

  public function isEmpty(): bool {
    foreach ($this->caches as $cache) {
      if (!$cache->isEmpty()) {
        return false;
      }
    }
    return true;
  }
}
