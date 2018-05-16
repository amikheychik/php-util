<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use Xtuple\Util\Exception\Throwable;

abstract class AbstractBaseURL
  extends AbstractURL {
  /**
   * @throws Throwable
   *
   * @param string $base
   * @param string $path
   * @param array  $query
   * @param string $fragment
   */
  public function __construct(string $base, string $path, array $query = [], string $fragment = '') {
    parent::__construct(new URLString(strtr('{base}{path}{query}{fragment}', [
      '{base}' => rtrim($base, '/'),
      '{path}' => ($path = ltrim($path, '/')) ? "/{$path}" : '',
      '{query}' => $query ? strtr('?{query}', [
        '{query}' => http_build_query($query),
      ]) : '',
      '{fragment}' => $fragment ? "#{$fragment}" : '',
    ])));
  }
}
