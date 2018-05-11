<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Request\URI\URL;

final class URLComponents
  implements URL {
  /** @var string[] */
  private $components;

  /**
   * @see parse_url()
   *
   * @param array $components
   */
  public function __construct(array $components) {
    $this->components = $components + [
        'scheme' => '',
        'host' => '',
        'port' => null,
        'user' => '',
        'pass' => '',
        'path' => '',
        'query' => '',
        'fragment' => '',
      ];
  }

  public function __toString(): string {
    return implode('', [
      '{scheme}' => $this->scheme() ? "{$this->scheme()}://" : '',
      '{auth}' => $this->user() ? "{$this->user()}:{$this->password()}@" : '',
      '{host}' => $this->host(),
      '{port}' => $this->port() ? ":{$this->port()}" : '',
      '{path}' => $this->path(),
      '{query}' => $this->query() ? "?{$this->query()}" : '',
      '{fragment}' => $this->fragment() ? "#{$this->fragment()}" : '',
    ]);
  }

  public function scheme(): string {
    return $this->components['scheme'];
  }

  public function host(): string {
    return $this->components['host'];
  }

  public function port(): ?int {
    if ($port = $this->components['port']) {
      return (int) $port;
    }
    return null;
  }

  public function user(): string {
    return $this->components['user'];
  }

  public function password(): string {
    return $this->components['pass'];
  }

  public function path(): string {
    return $this->components['path'];
  }

  public function query(): string {
    return $this->components['query'];
  }

  public function fragment(): string {
    return $this->components['fragment'];
  }
}
