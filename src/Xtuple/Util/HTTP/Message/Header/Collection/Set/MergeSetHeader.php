<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use Xtuple\Util\Collection\Set\ArraySet\AbstractArraySet;
use Xtuple\Util\HTTP\Message\Header\Header;
use Xtuple\Util\HTTP\Message\Header\MergeHeader;

final class MergeSetHeader
  extends AbstractArraySet
  implements SetHeader {
  /**
   * @param SetHeader[] $headers
   */
  public function __construct(SetHeader ...$headers) {
    /** @var Header[] $elements */
    $elements = [];
    foreach ($headers as $set) {
      foreach ($set as $header) {
        if (isset($elements[$header->name()])) {
          /** @noinspection PhpUnhandledExceptionInspection - header names are matching */
          $elements[$header->name()] = new MergeHeader($elements[$header->name()], $header);
        }
        else {
          $elements[$header->name()] = $header;
        }
      }
    }
    /** @noinspection PhpUnhandledExceptionInspection - $elements types are verified */
    parent::__construct($elements);
  }
}
