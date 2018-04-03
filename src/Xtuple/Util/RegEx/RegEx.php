<?php declare(strict_types=1);

namespace Xtuple\Util\RegEx;

use Xtuple\Util\Type\String\Chars;

interface RegEx
  extends Chars {
  public function pattern(): string;

  public function matches(string $string, bool $capture = false, int $offset = 0): array;

  public function all(string $string, bool $set = false, bool $capture = false, int $offset = 0): array;

  public function replace(string $replacement, string $string): string;

  public function group(string $string, string $group): ?string;
}
