<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;

final class JSONBodyFromBody
  extends AbstractJSONBody {
  public function __construct(Body $body) {
    parent::__construct(new JSONBodyFromStringBody(
      new StringBodyFromBody($body)
    ));
  }
}
