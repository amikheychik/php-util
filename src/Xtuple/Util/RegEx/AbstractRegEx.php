<?php declare(strict_types=1);

namespace Xtuple\Util\RegEx;

abstract class AbstractRegEx
  implements RegEx {
  /** @var RegEx */
  private $regEx;

  public function __construct(RegEx $regEx) {
    $this->regEx = $regEx;
  }

  public final function __toString(): string {
    return $this->regEx->__toString();
  }

  public final function pattern(): string {
    return $this->regEx->pattern();
  }

  public final function matches(string $string, bool $capture = false, int $offset = 0): array {
    return $this->regEx->matches($string, $capture, $offset);
  }

  public final function all(string $string, bool $set = false, bool $capture = false, int $offset = 0): array {
    return $this->regEx->all($string, $set, $capture, $offset);
  }

  public final function replace(string $replacement, string $string): string {
    return $this->regEx->replace($replacement, $string);
  }

  public final function group(string $string, string $group): ?string {
    return $this->regEx->group($string, $group);
  }
}
