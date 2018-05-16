<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON;

use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\HTTP\Message\Body\String\AbstractStringBody;

abstract class AbstractJSONBody
  extends AbstractStringBody
  implements JSONBody {
  /** @var JSONBody */
  private $body;

  public function __construct(JSONBody $body) {
    parent::__construct($body);
    $this->body = $body;
  }

  public final function jsonSerialize() {
    return $this->body->jsonSerialize();
  }

  public final function data(): Tree {
    return $this->body->data();
  }
}
