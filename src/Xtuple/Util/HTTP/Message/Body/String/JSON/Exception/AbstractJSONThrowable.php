<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON\Exception;

use Xtuple\Util\HTTP\Client\Exception\AbstractThrowable;

abstract class AbstractJSONThrowable
  extends AbstractThrowable
  implements JSONThrowable {
}
