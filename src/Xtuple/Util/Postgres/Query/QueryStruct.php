<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query;

final class QueryStruct
  implements Query {
  /** @var string */
  private $sql;
  /** @var array */
  private $parameters;

  public function __construct(string $sql, array $parameters = []) {
    $this->sql = $sql;
    $this->parameters = $parameters;
  }

  public function sql(): string {
    return $this->sql;
  }

  public function parameters(): array {
    return $this->parameters;
  }
}
