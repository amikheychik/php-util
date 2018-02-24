<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure;

abstract class AbstractUnit
  implements Unit {
  /** @var string */
  private $symbol;
  /** @var string */
  private $name;
  /** @var string[] */
  private $synonyms;

  /**
   * @param string   $symbol
   * @param string   $name
   * @param string[] $synonyms
   */
  public function __construct(string $symbol, string $name, array $synonyms = []) {
    $this->symbol = $symbol;
    $this->name = $name;
    $synonyms = array_merge([$symbol, $name], $synonyms);
    $this->synonyms = [];
    foreach ($synonyms as $synonym) {
      $this->synonyms[] = strtolower($synonym);
    }
    $this->synonyms = array_unique($this->synonyms);
    sort($this->synonyms);
  }

  public final function symbol(): string {
    return $this->symbol;
  }

  public final function name(): string {
    return $this->name;
  }

  public final function synonyms(): array {
    return $this->synonyms;
  }
}
