<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Header\ContentType;

use Xtuple\Util\HTTP\Message\Header\AbstractHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;

final class ContentTypeHeader
  extends AbstractHeader {
  public function __construct(string $type) {
    parent::__construct(new HeaderStruct('Content-Type', $type));
  }
}
