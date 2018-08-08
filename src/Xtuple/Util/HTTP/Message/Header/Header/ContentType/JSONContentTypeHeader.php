<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Header\Header\ContentType;

use Xtuple\Util\HTTP\Message\Header\AbstractHeader;

final class JSONContentTypeHeader
  extends AbstractHeader {
  public function __construct() {
    parent::__construct(new ContentTypeHeader('application/json'));
  }
}
