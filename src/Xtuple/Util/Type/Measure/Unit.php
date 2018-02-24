<?php declare(strict_types=1);

namespace Xtuple\Util\Type\Measure;

interface Unit {
  public function symbol(): string;

  public function name(): string;

  /**
   * @return string[]
   */
  public function synonyms(): array;

  public function toSI(float $length): float;

  public function fromSI(float $length): float;
}
