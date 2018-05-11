<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

use Xtuple\Util\HTTP\Request\URI\URI;

/**
 * Interface URL - for absoluteURI type of HTTP request URIs.
 *
 * @see https://www.w3.org/Protocols/rfc2616/rfc2616-sec5.html#sec5.1.2 - HTTP Request-URI: absoluteURI
 */
interface URL
  extends URI {
  public function scheme(): string;

  public function host(): string;

  public function port(): ?int;

  public function user(): string;

  public function password(): string;

  public function path(): string;

  public function query(): string;

  public function fragment(): string;
}
