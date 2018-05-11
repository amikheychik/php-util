<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

abstract class AbstractURL
  implements URL {
  /** @var URLStruct */
  private $url;

  public function __construct(URL $url) {
    $this->url = $url;
  }

  public final function __toString(): string {
    return $this->url->__toString();
  }

  public final function scheme(): string {
    return $this->url->scheme();
  }

  public final function host(): string {
    return $this->url->host();
  }

  public final function port(): ?int {
    return $this->url->port();
  }

  public final function user(): string {
    return $this->url->user();
  }

  public final function password(): string {
    return $this->url->password();
  }

  public final function path(): string {
    return $this->url->path();
  }

  public final function query(): string {
    return $this->url->query();
  }

  public final function fragment(): string {
    return $this->url->fragment();
  }
}
