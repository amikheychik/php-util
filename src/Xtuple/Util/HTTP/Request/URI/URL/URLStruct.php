<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use Xtuple\Util\Exception\ChainException;
use Xtuple\Util\Exception\Throwable;

final class URLStruct
  extends AbstractURL {
  /**
   * @throws Throwable
   *
   * @param string   $scheme
   * @param string   $host
   * @param int|null $port
   * @param string   $user
   * @param string   $password
   * @param string   $path
   * @param string   $query
   * @param string   $fragment
   */
  public function __construct(string $scheme = '', string $host = '', int $port = null, string $user = '',
                              string $password = '', string $path = '', string $query = '', string $fragment = '') {
    try {
      parent::__construct(new URLString(strtr('{scheme}://{auth}{host}{port}/{path}{query}{fragment}', [
        '{scheme}' => $scheme,
        '{host}' => $host,
        '{auth}' => $user ? "{$user}:{$password}@" : '',
        '{port}' => $port ? ":{$port}" : '',
        '{path}' => $path,
        '{query}' => $query ? "?{$query}" : '',
        '{fragment}' => $fragment ? "#{$fragment}" : '',
      ])));
    }
    catch (Throwable $e) {
      throw new ChainException($e, 'Failed to build a correct URL from the passed arguments');
    }
  }
}
