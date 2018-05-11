<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header;

use Xtuple\Util\HTTP\Message\Header\Exception\HeaderMergeException;

final class MergeHeader
  extends AbstractHeader {
  /**
   * @throws HeaderMergeException
   *
   * @param Header   $origin
   * @param Header[] $append
   */
  public function __construct(Header $origin, Header ...$append) {
    $values = [
      $origin->value(),
    ];
    foreach ($append as $header) {
      if ($origin->name() !== $header->name()) {
        throw new HeaderMergeException($origin, $header);
      }
      $values[] = $header->value();
    }
    parent::__construct(new HeaderStruct(
      $origin->name(),
      implode(', ', $values)
    ));
  }
}
