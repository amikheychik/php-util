<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

final class URLWithQuery
  extends AbstractBaseURL {
  public function __construct(string $url, array $query = [], string $fragment = '') {
    parent::__construct($url, '', $query, $fragment);
  }
}
