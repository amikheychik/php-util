<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\JSON;

use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\HTTP\Message\Body\String\JSON\JSONBodyFromStringBody;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\HTTP\Response\AbstractResponse;

final class JSONResponseStruct
  extends AbstractResponse
  implements JSONResponse {
  public function json(): Tree {
    return (new JSONBodyFromStringBody(
      new StringBodyFromBody($this->body())
    ))->data();
  }
}
