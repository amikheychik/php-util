<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\Result;

use Xtuple\Util\HTTP\Response\Response;

final class ResultWithThrowable
  implements Result {
  /** @var string */
  private $key;
  /** @var \Throwable */
  private $exception;

  public function __construct(string $key, \Throwable $exception) {
    $this->key = $key;
    $this->exception = $exception;
  }

  public function key(): string {
    return $this->key;
  }

  public function response(): Response {
    throw $this->exception;
  }
}
