<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query;

abstract class AbstractQuery
  implements Query {
  /** @var Query */
  private $query;

  public function __construct(Query $query) {
    $this->query = $query;
  }

  public final function sql(): string {
    return $this->query->sql();
  }

  public final function parameters(): array {
    return $this->query->parameters();
  }
}
