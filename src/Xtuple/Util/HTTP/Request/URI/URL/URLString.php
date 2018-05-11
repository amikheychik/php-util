<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use Xtuple\Util\Exception\Exception;
use Xtuple\Util\Exception\Throwable;

final class URLString
  extends AbstractURL {
  /**
   * @throws Throwable
   *
   * @param string $url
   */
  public function __construct(string $url) {
    if ($url === '') {
      throw new Exception('Empty string is not a URL');
    }
    $parsed = parse_url($url);
    if ($parsed === false) {
      throw new Exception('Failed to parse string {url} into an URL', [
        'url' => $url,
      ]);
    }
    if (empty($parsed['host'])) {
      throw new Exception('Failed to parse string {url} into an URL: host is undefined');
    }
    parent::__construct(new URLComponents($parsed));
  }
}
