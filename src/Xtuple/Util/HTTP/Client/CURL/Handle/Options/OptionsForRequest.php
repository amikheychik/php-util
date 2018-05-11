<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Client\CURL\Handle\Options;

use Xtuple\Util\HTTP\Client\CURL\Configuration\Configuration;
use Xtuple\Util\HTTP\Client\CURL\Handle\Options\Header\HeaderFromSetHeader;
use Xtuple\Util\HTTP\Message\Body\String\StringBodyFromBody;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeader;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\MergeSetHeader;
use Xtuple\Util\HTTP\Message\Header\HeaderStruct;
use Xtuple\Util\HTTP\Request\Request;
use Xtuple\Util\Type\Stream\Exception\Throwable;
use Xtuple\Util\Type\Stream\Stream;

final class OptionsForRequest
  extends AbstractOptions {
  /**
   * @throws Throwable
   *
   * @param Request       $request
   * @param Configuration $configuration
   * @param Stream        $header
   * @param Stream        $body
   */
  public function __construct(Request $request, Configuration $configuration, Stream $header, Stream $body) {
    /** @noinspection PhpUnhandledExceptionInspection - $headers types are verified */
    $headers = new HeaderFromSetHeader(new MergeSetHeader(new ArraySetHeader([
      new HeaderStruct('Expect', ''),
    ]), $request->headers()));
    parent::__construct(new OptionsStruct([
      CURLOPT_TIMEOUT => $configuration->timeout(),
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_SSL_VERIFYHOST => !$configuration->debug() ? 2 : 0,
      CURLOPT_SSL_VERIFYPEER => !$configuration->debug(),
      CURLOPT_CUSTOMREQUEST => (string) $request->method(),
      CURLOPT_URL => (string) $request->uri(),
      CURLOPT_POSTFIELDS => (string) new StringBodyFromBody($request->body()),
      CURLOPT_HTTPHEADER => $headers->fields(),
      CURLOPT_RETURNTRANSFER => false,
      CURLOPT_HEADER => false,
      CURLOPT_WRITEHEADER => $header->resource(),
      CURLOPT_FILE => $body->resource(),
    ]));
  }
}
