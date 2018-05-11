<?php declare(strict_types=1);

namespace Xtuple\Util\HTTP\Response;

use Xtuple\Util\Exception\Throwable;
use Xtuple\Util\HTTP\Message\Body\BodyStream;
use Xtuple\Util\HTTP\Message\Header\Collection\Set\ArraySetHeaderFromString;
use Xtuple\Util\HTTP\Response\Exception\ResponseParsingException;
use Xtuple\Util\HTTP\Response\RegEx\ResponseRegEx;
use Xtuple\Util\HTTP\Response\Status\StatusString;
use Xtuple\Util\Type\Stream\Stream;
use Xtuple\Util\Type\Stream\String\StringStreamStruct;

final class ResponseStreams
  extends AbstractResponse {
  /**
   * @throws ResponseParsingException
   *
   * @param Stream $header
   * @param Stream $body
   */
  public function __construct(Stream $header, Stream $body) {
    $regex = new ResponseRegEx();
    /** @noinspection PhpUnhandledExceptionInspection - $resource type is verified */
    $matches = $regex->matches(
      (new StringStreamStruct($header))->content()
    );
    if (empty($matches)) {
      throw new ResponseParsingException();
    }
    while ($redirect = $regex->matches($matches['body'])) {
      $matches = $redirect;
    }
    try {
      parent::__construct(new ResponseStruct(
        new StatusString($matches['status']),
        new ArraySetHeaderFromString($matches['headers']),
        new BodyStream($body->resource())
      ));
    }
    catch (Throwable $e) {
      throw new ResponseParsingException($e);
    }
  }
}
