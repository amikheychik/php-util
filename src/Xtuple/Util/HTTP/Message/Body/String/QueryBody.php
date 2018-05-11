<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Message\Body\String;

final class QueryBody
  extends AbstractStringBody {
  public function __construct(array $query) {
    parent::__construct(new StringBodyFromString(
      http_build_query($query)
    ));
  }
}
