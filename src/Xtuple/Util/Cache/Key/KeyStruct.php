<?php declare(strict_types=1);

namespace Xtuple\Util\Cache\Key;

final class KeyStruct
  implements Key {
  /** @var string[] */
  private $fields;

  /**
   * @param string[] $fields
   */
  public function __construct(array $fields) {
    $this->fields = $fields;
  }

  public function fields(): array {
    return $this->fields;
  }
}
