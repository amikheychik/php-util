<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch;

use Xtuple\Util\JSON\Patch\Operation\Add;
use Xtuple\Util\JSON\Patch\Operation\Path\PathForKey;
use Xtuple\Util\JSON\Patch\Operation\Remove;
use Xtuple\Util\JSON\Patch\Operation\Replace;

final class JSONPatchArray
  implements JSONPatch {
  /** @var array */
  private $original;
  /** @var array */
  private $updated;
  /** @var string|int */
  private $prefix;

  public function __construct(array $original, array $updated, $prefix = '') {
    $this->original = $original;
    $this->updated = $updated;
    $this->prefix = $prefix;
  }

  public function jsonSerialize() {
    return array_merge(
      $this->add(),
      $this->remove(),
      $this->replace()
    );
  }

  private function add(): array {
    $operations = [];
    foreach (array_diff_key($this->updated, $this->original) as $key => $value) {
      $operations[] = new Add(new PathForKey($key, $this->prefix), $value);
    }
    return $operations;
  }

  private function remove(): array {
    $operations = [];
    foreach (array_keys(array_diff_key($this->original, $this->updated)) as $key) {
      $operations[] = new Remove(new PathForKey($key, $this->prefix));
    }
    return $operations;
  }

  private function replace(): array {
    $operations = [];
    foreach (array_keys(array_intersect_key($this->updated, $this->original)) as $key) {
      if (is_array($this->updated[$key]) && is_array($this->original[$key])) {
        $patch = new JSONPatchArray(
          $this->original[$key],
          $this->updated[$key],
          implode('/', array_filter([$this->prefix, $key]))
        );
        $operations[] = $patch->jsonSerialize();
      }
      elseif ($this->updated[$key] !== $this->original[$key]) {
        $operations[] = [
          new Replace(new PathForKey($key, $this->prefix), $this->updated[$key]),
        ];
      }
    }
    return $operations ? array_merge(...$operations) : [];
  }
}
