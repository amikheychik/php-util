<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Transliteration;

final class ASCIITransliterationString
  implements Transliteration {
  /** @var string */
  private $original;

  public function __construct(string $original) {
    $this->original = $original;
  }

  public function __toString(): string {
    return \Transliterator::create('Latin-ASCII', \Transliterator::FORWARD)->transliterate(
      \Transliterator::create('Any-Latin', \Transliterator::FORWARD)->transliterate($this->original)
    );
  }

  public function original(): string {
    return $this->original;
  }
}
