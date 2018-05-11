<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON;

use Xtuple\Util\Collection\Tree\ArrayTree\ArrayTree;
use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Body\String\AbstractStringBody;
use Xtuple\Util\HTTP\Message\Body\String\JSON\Exception\JSONException;
use Xtuple\Util\HTTP\Message\Body\String\StringBody;

final class JSONBodyFromStringBody
  extends AbstractStringBody
  implements JSONBody {
  /** @var Body */
  private $body;

  public function __construct(StringBody $body) {
    parent::__construct($body);
    $this->body = $body;
  }

  public function jsonSerialize() {
    return $this->data()->data();
  }

  public function data(): Tree {
    $data = json_decode((string) $this, true);
    if ($data === null) {
      throw new JSONException();
    }
    return new ArrayTree((array) $data);
  }
}
