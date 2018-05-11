<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Result;

use Xtuple\Util\HTTP\Response\Response;

final class ResultWithResponse
  implements Result {
  /** @var string */
  private $key;
  /** @var Response */
  private $response;

  public function __construct(string $key, Response $response) {
    $this->key = $key;
    $this->response = $response;
  }

  public function key(): string {
    return $this->key;
  }

  public function response(): Response {
    return $this->response;
  }
}
