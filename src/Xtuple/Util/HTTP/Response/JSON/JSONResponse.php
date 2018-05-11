<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response\JSON;

use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\HTTP\Message\Body\String\JSON\Exception\JSONThrowable;
use Xtuple\Util\HTTP\Response\Response;

interface JSONResponse
  extends Response {
  /**
   * @throws JSONThrowable
   * @return Tree
   */
  public function json(): Tree;
}
