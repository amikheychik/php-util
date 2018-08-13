<?php declare(strict_types=1);

namespace Xtuple\Util\JSON\Patch;

abstract class AbstractJSONPatch
  implements JSONPatch {
  /** @var JSONPatch */
  private $patch;

  public function __construct(JSONPatch $patch) {
    $this->patch = $patch;
  }

  public final function jsonSerialize() {
    return $this->patch->jsonSerialize();
  }
}
