<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Options\Header;

use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;

final class HeaderFromSetHeader
  implements Header {
  /** @var string[] */
  private $fields;

  public function __construct(SetHeader $headers) {
    $this->fields = [];
    foreach ($headers as $header) {
      $this->fields[] = (string) $header;
    }
  }

  public function fields(): array {
    return $this->fields;
  }
}
