<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Encode;

final class HTMLEncodedString
  implements HTMLEncodedChars {
  /** @var string */
  private $encoded;
  /** @var int */
  private $quotes;
  /** @var null|string */
  private $charset;

  public function __construct(string $encoded, int $quotes = ENT_COMPAT | ENT_HTML401, ?string $encoding = null) {
    $this->encoded = $encoded;
    $this->quotes = $quotes;
    $this->charset = $encoding;
  }

  public function quotes(): int {
    return $this->quotes;
  }

  public function charset(): string {
    return $this->charset ?: ini_get('default_charset');
  }

  public function __toString(): string {
    return $this->encoded;
  }
}
