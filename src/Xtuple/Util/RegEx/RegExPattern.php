<?php declare(strict_types=1);

namespace Xtuple\Util\RegEx;

final class RegExPattern
  implements RegEx {
  /** @var string */
  private $pattern;

  public function __construct(string $pattern) {
    $this->pattern = $pattern;
  }

  public function __toString(): string {
    return $this->pattern;
  }

  public function pattern(): string {
    return $this->pattern;
  }

  public function matches(string $string, bool $capture = false, int $offset = 0): array {
    return preg_match($this->pattern, $string, $matches, $capture ? PREG_OFFSET_CAPTURE : 0, $offset)
      ? $matches
      : [];
  }

  public function all(string $string, bool $set = false, bool $capture = false, int $offset = 0): array {
    $flags = $set ? PREG_SET_ORDER : PREG_PATTERN_ORDER;
    if ($capture) {
      $flags = $flags | PREG_OFFSET_CAPTURE;
    }
    return preg_match_all($this->pattern, $string, $matches, $flags, $offset)
      ? $matches
      : [];
  }

  public function replace(string $replacement, string $string): string {
    return preg_replace($this->pattern, $replacement, $string);
  }

  public function group(string $string, string $group): ?string {
    return (
      ($matches = $this->matches($string))
      && isset($matches[$group])
    ) ? $matches[$group] : null;
  }
}
