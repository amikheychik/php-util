<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON;

use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\HTTP\Message\Body\String\JSON\Exception\JSONThrowable;
use Xtuple\Util\HTTP\Message\Body\String\StringBody;

interface JSONBody
  extends StringBody,
          \JsonSerializable {
  /**
   * @throws JSONThrowable
   * @return mixed
   */
  public function jsonSerialize();

  /**
   * @throws JSONThrowable
   * @return Tree
   */
  public function data(): Tree;
}
