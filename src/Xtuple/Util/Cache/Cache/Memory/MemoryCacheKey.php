<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Cache\Memory;

use Xtuple\Util\Cache\Key\AbstractKey;
use Xtuple\Util\Cache\Key\Key;

final class MemoryCacheKey
  extends AbstractKey {
  /** @var string */
  private $bucket;

  public function __construct(string $bucket, Key $key) {
    parent::__construct($key);
    $this->bucket = $bucket;
  }

  public function key(): array {
    return array_merge([$this->bucket], $this->fields());
  }
}
