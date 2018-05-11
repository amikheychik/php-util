<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Client\CURL\Configuration\Configuration;
use Xtuple\Util\HTTP\Client\CURL\Exception\CURLException;
use Xtuple\Util\HTTP\Client\CURL\Handle\Options\OptionsForRequest;
use Xtuple\Util\HTTP\Client\Exception\Exception;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\HTTP\Response\Response;
use Xtuple\Util\HTTP\Response\ResponseStreams;
use Xtuple\Util\Type\Stream\Stream;
use Xtuple\Util\Type\Stream\TemporaryStream;

final class BinaryHandle
  implements Handle {
  /** @var string */
  private $key;
  /** @var resource */
  private $handle;
  /** @var Stream */
  private $body;
  /** @var Stream */
  private $header;

  /**
   * @throws Throwable
   *
   * @param string        $key
   * @param Request       $request
   * @param Configuration $configuration
   */
  public function __construct(string $key, Request $request, Configuration $configuration) {
    $this->key = $key;
    $this->handle = curl_init();
    if ($this->handle === false) {
      // @codeCoverageIgnoreStart
      // Unable to reproduce if curl_init() failure
      throw new Exception('cURL initialization failed');
      // @codeCoverageIgnoreEnd
    }
    $this->body = new TemporaryStream();
    $this->header = new TemporaryStream();
    /** @noinspection PhpUnhandledExceptionInspection - $header and $body are verified resources */
    $options = new OptionsForRequest($request, $configuration, $this->header, $this->body);
    if (curl_setopt_array($this->handle, $options->options()) === false) {
      // @codeCoverageIgnoreStart
      // Unable to reproduce if curl_setopt_array() failure
      throw new Exception('Failed to set cURL options');
      // @codeCoverageIgnoreEnd
    }
  }

  /**
   * @see tmpfile() - temporary file is automatically removed when there are no remaining references to the file handle.
   */
  public function __destruct() {
    curl_close($this->handle);
  }

  public function key(): string {
    return $this->key;
  }

  public function handle() {
    return $this->handle;
  }

  public function response(): Response {
    /** @workaround checking total time to know that handle was executed, as it may be executed by multi handles */
    if (curl_getinfo($this->handle, CURLINFO_TOTAL_TIME) === 0.0) {
      if (curl_exec($this->handle) === false) {
        throw new CURLException($this->handle);
      }
    }
    return new ResponseStreams($this->header, $this->body);
  }
}
