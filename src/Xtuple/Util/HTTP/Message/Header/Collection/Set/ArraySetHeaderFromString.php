<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Collection\Set;

use Xtuple\Util\Collection\Set\AbstractSet;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Message\Header\MergeHeader;
use Xtuple\Util\HTTP\Message\Header\RegEx\HeaderFieldsRegEx;

final class ArraySetHeaderFromString
  extends AbstractSet
  implements SetHeader {
  public function __construct(string $fields) {
    $headers = [];
    foreach ((new HeaderFieldsRegEx())->all($fields, true) as $match) {
      $header = new HeaderStruct($match['name'], $match['value']);
      if (isset($headers[$header->name()])) {
        /** @noinspection PhpUnhandledExceptionInspection - header names are matching */
        $headers[$header->name()] = new MergeHeader($headers[$header->name()], $header);
      }
      else {
        $headers[$header->name()] = $header;
      }
    }
    /** @noinspection PhpUnhandledExceptionInspection - $elements types are verified */
    parent::__construct(new ArraySetHeader($headers));
  }
}
