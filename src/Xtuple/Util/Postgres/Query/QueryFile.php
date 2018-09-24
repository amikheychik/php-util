<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query;

use Xtuple\Util\File\File\Regular\Regular;

final class QueryFile
  implements Query {
  /** @var Regular */
  private $file;
  /** @var array */
  private $tokens;
  /** @var array */
  private $parameters;

  public function __construct(Regular $file, array $tokens = [], array $parameters = []) {
    $this->file = $file;
    $this->tokens = $tokens;
    $this->parameters = $parameters;
  }

  public function sql(): string {
    return $this->query()->sql();
  }

  public function parameters(): array {
    return $this->query()->parameters();
  }

  /** @var Query|null $query */
  private $query;

  private function query(): Query {
    if ($this->query === null) {
      $this->query = new QueryWithTokens(
        $this->file->content(),
        $this->tokens,
        $this->parameters
      );
    }
    return $this->query;
  }
}
