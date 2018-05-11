<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\SetHeader;
use Xtuple\Util\HTTP\Response\Status\Status;

interface Response {
  public function status(): Status;

  public function headers(): SetHeader;

  public function body(): Body;
}
