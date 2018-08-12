<?php declare(strict_types=1);

namespace Xtuple\Util\Postgres\Query;

final class QueryWithTokens
  extends AbstractQuery {
  public function __construct(string $sql, array $tokens = [], array $parameters = []) {
    $replacements = [];
    foreach ($tokens as $token => $value) {
      $replacements["{{$token}}"] = $value;
    }
    parent::__construct(new QueryStruct(strtr($sql, $replacements), $parameters));
  }
}
