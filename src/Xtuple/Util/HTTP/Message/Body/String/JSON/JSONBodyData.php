<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String\JSON;

use Xtuple\Util\Collection\Tree\ArrayTree\ArrayTree;
use Xtuple\Util\Collection\Tree\Tree;
use Xtuple\Util\HTTP\Message\Body\Body;
use Xtuple\Util\HTTP\Message\Body\String\JSON\Exception\JSONException;
use Xtuple\Util\HTTP\Message\Body\String\JSON\Exception\JSONThrowable;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromString;

final class JSONBodyData
  implements JSONBody {
  /** @var array */
  private $data;

  public function __construct(array $data = []) {
    $this->data = $data;
  }

  public function __toString(): string {
    try {
      return $this->content();
    }
    catch (\Throwable $e) {
      return '';
    }
  }

  /**
   * @throws JSONThrowable
   * @return string
   */
  public function content(): string {
    $json = json_encode($this->jsonSerialize());
    if ($json === false) {
      throw new JSONException();
    }
    return $json;
  }

  public function jsonSerialize() {
    return $this->data;
  }

  public function data(): Tree {
    return new ArrayTree($this->data);
  }

  /** @var null|Body */
  private $body;

  public function resource() {
    if ($this->body === null) {
      $this->body = new StringBodyFromString((string) $this);
    }
    return $this->body->resource();
  }
}
