<?php declare(strict_types=1);

namespace Xtuple\Util\Type\String\Encoding\HTML\Decode;

final class HTMLDecodedString
  implements HTMLDecodedChars {
  /** @var string */
  private $decoded;
  /** @var int */
  private $quotes;
  /** @var null|string */
  private $charset;

  public function __construct(string $decoded, int $quotes = ENT_COMPAT | ENT_HTML401, ?string $charset = null) {
    $this->decoded = $decoded;
    $this->quotes = $quotes;
    $this->charset = $charset;
  }

  public function quotes(): int {
    return $this->quotes;
  }

  public function charset(): string {
    return (string) ($this->charset ?: ini_get('default_charset'));
  }

  public function __toString(): string {
    return $this->decoded;
  }
}
