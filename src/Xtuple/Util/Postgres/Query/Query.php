<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query;

interface Query {
  public function sql(): string;

  public function parameters(): array;
}
