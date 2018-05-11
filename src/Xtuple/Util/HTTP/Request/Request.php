<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Request\Method\Method;
use Xtuple\Util\HTTP\Request\URI\URI;

interface Request {
  public function uri(): URI;

  public function method(): Method;

  public function headers(): SetHeader;

  public function body(): Body;
}
