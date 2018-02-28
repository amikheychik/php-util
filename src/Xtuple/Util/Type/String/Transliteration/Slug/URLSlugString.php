<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Transliteration\Slug;

use Xtuple\Util\Type\String\Transliteration\ASCIITransliterationString;
use Xtuple\Util\Type\String\Transliteration\Transliteration;

final class URLSlugString
  implements Transliteration {
  /** @var string */
  private $original;

  public function __construct(string $original) {
    $this->original = $original;
  }

  public function __toString(): string {
    return strtolower(preg_replace(
      '/[^A-Za-z0-9_-]/',
      '-',
      (string) new ASCIITransliterationString($this->original)
    ));
  }

  public function original(): string {
    return $this->original;
  }
}
