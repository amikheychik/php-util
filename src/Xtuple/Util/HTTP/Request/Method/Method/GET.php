<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\Method\Method;

use Xtuple\Util\HTTP\Request\Method\AbstractMethod;
use Xtuple\Util\HTTP\Request\Method\MethodString;

final class GET
  extends AbstractMethod {
  public function __construct() {
    parent::__construct(new MethodString('GET'));
  }
}
